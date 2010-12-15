<?php

/**
 * ArticleComment is article, this class is used for manipulation on it
 */
class ArticleComment {

	public
		$mProps,	//blogs only
		$mTitle,
		$mLastRevId,
		$mFirstRevId,
		$mLastRevision,  ### for displaying text
		$mFirstRevision, ### for author & time
		$mUser,          ### comment creator
		$mNamespace,
		$mNamespaceTalk;

	public function __construct( $title ) {
		$this->mTitle = $title;
		$this->mNamespace = $title->getNamespace();
		$this->mNamespaceTalk = MWNamespace::getTalk($this->mNamespace);
		$this->mProps = false;
	}

	/**
	 * newFromTitle -- static constructor
	 *
	 * @static
	 * @access public
	 *
	 * @param Title $title -- Title object connected to comment
	 *
	 * @return ArticleComment object
	 */
	static public function newFromTitle( Title $title ) {
		return new ArticleComment( $title );
	}

	/**
	 * newFromTitle -- static constructor
	 *
	 * @static
	 * @access public
	 *
	 * @param Title $title -- Title object connected to comment
	 *
	 * @return ArticleComment object
	 */
	static public function newFromArticle( Article $article ) {
		$title = $article->getTitle();

		$comment = new ArticleComment( $title );
		return $comment;
	}

	/**
	 * newFromId -- static constructor
	 *
	 * @static
	 * @access public
	 *
	 * @param Integer $id -- identifier from page_id
	 *
	 * @return ArticleComment object
	 */
	static public function newFromId( $id ) {
		$title = Title::newFromID( $id );
		if ( ! $title ) {
			/**
			 * maybe from Master?
			 */
			$title = Title::newFromID( $id, GAID_FOR_UPDATE );

			//RT#86385 Why do we get an ID of 0 here sometimes?  Just set it!
			if ($title->getArticleID() == 0) {
				$title->mArticleID = $id;
			}
			if ( ! $title ) {
				return false;
			}
		}
		return new ArticleComment( $title );
	}

	/**
	 * load -- set variables, load data from database
	 */
	public function load($master = false) {
		wfProfileIn( __METHOD__ );

		$result = true;

		if ( $this->mTitle ) {
			/**
			 * if we lucky we got only one revision, we check slave first
			 * then if no answer we check master
			 */
			$this->mFirstRevId = $this->getFirstRevID( $master ? DB_MASTER : DB_SLAVE );
			if ( !$this->mFirstRevId && !$master ) {
				 $this->mFirstRevId = $this->getFirstRevID( DB_MASTER );
			}
			if ( !$this->mLastRevId ) {
				$this->mLastRevId = $this->mTitle->getLatestRevID();
			}
			/**
			 * still not defined?
			 */
			if ( !$this->mLastRevId ) {
				$this->mLastRevId = $this->mTitle->getLatestRevID( GAID_FOR_UPDATE );
			}
			if ( $this->mLastRevId != $this->mFirstRevId ) {
				if ( $this->mLastRevId && $this->mFirstRevId ) {
					$this->mLastRevision = Revision::newFromTitle( $this->mTitle );
					$this->mFirstRevision = Revision::newFromId( $this->mFirstRevId );
				}
				else {
					$this->mFirstRevision = Revision::newFromId( $this->mFirstRevId );
					$this->mLastRevision = $this->mFirstRevision;
					$this->mLastRevId = $this->mFirstRevId;
				}
			}
			else {
				if ( $this->mFirstRevId ) {
					$this->mFirstRevision = Revision::newFromId( $this->mFirstRevId );
					$this->mLastRevision = $this->mFirstRevision;
				}
				else {
					$result = false;
				}
			}

			if ( $this->mFirstRevision ) {
				$this->mUser = User::newFromId( $this->mFirstRevision->getUser() );
				$this->mUser->setName( $this->mFirstRevision->getUserText() );
			}
			else {
				$result = false;
			}
		}
		else {
			$result = false;
		}
		wfProfileOut( __METHOD__ );

		return $result;
	}

	/**
	 * getFirstRevID -- What is id for first revision
	 * @see Title::getLatestRevID
	 *
	 * @return Integer
	 */
	private function getFirstRevID( $db_conn ) {
		wfProfileIn( __METHOD__ );

		$id = false;

		if ( $this->mTitle ) {
			$db = wfGetDB($db_conn);
			$id = $db->selectField(
				'revision',
				'min(rev_id)',
				array( 'rev_page' => $this->mTitle->getArticleID() ),
				__METHOD__
			);
		}

		wfProfileOut( __METHOD__ );

		return $id;
	}
	/**
	 * getTitle -- getter/accessor
	 *
	 */
	public function getTitle() {
		return $this->mTitle;
	}

	public function getData($master = false) {
		global $wgLang, $wgContLang, $wgUser, $wgParser, $wgOut, $wgTitle, $wgBlankImgUrl;

		wfProfileIn( __METHOD__ );

		$comment = false;
		if ( $this->load($master) ) {
			$canDelete = $wgUser->isAllowed( 'delete' );

			$text = $wgOut->parse( $this->mLastRevision->getText() );
			$sig = ( $this->mUser->isAnon() )
				? AvatarService::renderLink( $this->mUser->getName() )
				: Xml::element( 'a', array ( 'href' => $this->mUser->getUserPage()->getFullUrl() ), $this->mUser->getName() );
			$articleId = $this->mTitle->getArticleId();

			$isStaff = (int)in_array('staff', $this->mUser->getEffectiveGroups() );

			$parts = self::explode($this->getTitle());

			$buttons = array();
			$replyButton = '';

			$commentingAllowed = true;
			if (defined('NS_BLOG_ARTICLE') && $wgTitle->getNamespace() == NS_BLOG_ARTICLE) {
				$props = BlogArticle::getProps($wgTitle->getArticleID());
				$commentingAllowed = isset($props['commenting']) ? (bool)$props['commenting'] : true;
			}

			if ( ( count( $parts['partsStripped'] ) == 1 ) && $commentingAllowed && !ArticleCommentInit::isFbConnectionNeeded() ) {
				$replyButton = '<a href="#" class="article-comm-reply wikia-button secondary">' . wfMsg('article-comments-reply') . '</a>';
			}

			if ( $canDelete && !ArticleCommentInit::isFbConnectionNeeded() ) {
				$img = '<img class="remove sprite" alt="" src="'. $wgBlankImgUrl .'" width="16" height="16" />';
				$buttons[] = $img . '<a href="' . $this->mTitle->getLocalUrl('redirect=no&action=delete') . '" class="article-comm-delete">' . wfMsg('article-comments-delete') . '</a>';
			}

			//due to slave lag canEdit() can return false negative - we are hiding it by CSS and force showing by JS
			if ( $wgUser->isLoggedIn() && $commentingAllowed && !ArticleCommentInit::isFbConnectionNeeded() ) {
				$display = ( $this->canEdit() ) ? '' : ' style="display:none"';
				$img = '<img class="edit-pencil sprite" alt="" src="' . $wgBlankImgUrl . '" width="16" height="16" />';
				$buttons[] = "<span class='edit-link'$display>" . $img . '<a href="#comment' . $articleId . '" class="article-comm-edit" id="comment' . $articleId . '">' . wfMsg('article-comments-edit') . '</a></span>';
			}

			if ( !$this->mTitle->isNewPage(GAID_FOR_UPDATE) ) {
				$img = '<img class="history sprite" alt="" src="'. $wgBlankImgUrl .'" width="16" height="16" />';
				$buttons[] = $img . $wgUser->getSkin()->makeKnownLinkObj( $this->mTitle, wfMsgHtml('article-comments-history'), 'action=history', '', '', 'class="article-comm-history"' );
			}

			$commentId = $this->getTitle()->getArticleId();
			$timestamp = "<a href='" . $this->getTitle()->getFullUrl( array( 'permalink' => $commentId ) ) . '#comm-' . $commentId . "' class='permalink'>" . wfTimeFormatAgo($this->mFirstRevision->getTimestamp()) . "</a>";

			$comment = array(
				'id' => $commentId,
				'articleId' => $articleId,
				'author' => $this->mUser,
				'username' => $this->mUser->getName(),
				'avatar' => $this->getAvatarImg($this->mUser),
				'buttons' => $buttons,
				'replyButton' => $replyButton,
				'sig' => $sig,
				'text' => $text,
				'timestamp' => $timestamp,
				'title' => $this->mTitle,
				'isStaff' => $isStaff
			);
		}

		wfProfileOut( __METHOD__ );

		return $comment;
	}

	/**
	 * render -- generate HTML for displaying comment
	 *
	 * @deprecated not used in Oasis
	 * @return String -- generated HTML text
	 */

	/*
	public function render($master = false) {

		wfProfileIn( __METHOD__ );

		$template = new EasyTemplate( dirname( __FILE__ ) . '/../templates/' );
		$template->set_vars(
			array (
				'comment' => $this->getData($master)
			)
		);
		$text = $template->render( 'comment' );

		wfProfileOut( __METHOD__ );

		return $text;
	}
	 */

	/*
	 *
	 * @deprecated use Oasis service
	 */
	function getAvatarImg($user){
		if (class_exists('Masthead')) {
			return Masthead::newFromUser( $user )->display( 50, 50 );
		} else {
			// Answers
			$avatar = new wAvatar($user->getId(), 'ml');
			return $avatar->getAvatarURL();
		}
	}

	/**
	 * get Title object of article page
	 *
	 * @access private
	 */
	public function getArticleTitle() {
		if ( !isset($this->mTitle) ) {
			return null;
		}

		$title = null;
		$parts = self::explode($this->mTitle->getDBkey());
		if ($parts['title'] != '') {
			$title = Title::makeTitle($this->mNamespace, $parts['title']);
		}
		return $title;
	}

	public static function isTitleComment($title) {
		if (!($title instanceof Title)) {
			return false;
		}

		if (defined('NS_BLOG_ARTICLE') && $title->getNamespace() == NS_BLOG_ARTICLE ||
			defined('NS_BLOG_ARTICLE_TALK') && $title->getNamespace() == NS_BLOG_ARTICLE_TALK) {
			return true;
		} else {
			return strpos(end(explode('/', $title->getText())), ARTICLECOMMENT_PREFIX) === 0;
		}
	}

	public static function explode($titleText) {
		$count = 0;
		$titleTextStripped = str_replace(ARTICLECOMMENT_PREFIX, '', $titleText, $count);
		$partsOriginal = explode('/', $titleText);
		$partsStripped = explode('/', $titleTextStripped);

		if ($count) {
			$title = implode('/', array_splice($partsOriginal, 0, -$count));
			array_splice($partsStripped, 0, -$count);
		} else {
			//not a comment - fallback
			$title = $titleText;
			$partsOriginal = $partsStripped = array();
		}

		$result = array(
			'title' => $title,
			'partsOriginal' => $partsOriginal,
			'partsStripped' => $partsStripped
		);
		return $result;
	}

	/**
	 * check if current user can edit comment
	 */
	public function canEdit() {
		global $wgUser;

		$res = false;
		if ( $this->mUser ) {
			$isAuthor = ($this->mUser->getId() == $wgUser->getId()) && (!$wgUser->isAnon());
			$canEdit =
				//prevent infinite loop for blogs - userCan hooked up in BlogLockdown
				defined('NS_BLOG_ARTICLE_TALK') && $this->mTitle->getNamespace() == NS_BLOG_ARTICLE_TALK ||
				$this->mTitle->userCanEdit();

			//TODO: create new permission and remove checking groups below
			$groups = $wgUser->getEffectiveGroups();
			$isAdmin = in_array( 'staff', $groups ) || in_array( 'sysop', $groups );

			$res = ( $isAuthor || $isAdmin ) && $canEdit;
		}

		return $res;
	}

	/**
	 * editPage -- show edit form
	 *
	 * @access public
	 *
	 * @return String
	 */
	public function editPage() {
		global $wgUser, $wgTitle, $wgStylePath;
		wfProfileIn( __METHOD__ );

		$text = '';
		$this->load(true);
		if ( $this->canEdit() && !ArticleCommentInit::isFbConnectionNeeded()) {
			wfLoadExtensionMessages('ArticleComments');
			$vars = array(
				'canEdit'		=> $this->canEdit(),
				'comment'		=> $this->mLastRevision->getText(),
				'isReadOnly'	=> wfReadOnly(),
				'stylePath'		=> $wgStylePath,
				'title'			=> $this->mTitle				
			);
			$text = wfRenderPartial('ArticleComments', 'Edit', $vars);
		}

		wfProfileOut( __METHOD__ );

		return $text;
	}

	/**
	 * doSaveComment -- save comment
	 *
	 * @access public
	 *
	 * @return String
	 */
	public function doSaveComment( $request, $user, $title ) {
		global $wgMemc, $wgTitle;
		wfProfileIn( __METHOD__ );

		$res = array();
		$this->load(true);
		if ( $this->canEdit() && !ArticleCommentInit::isFbConnectionNeeded() ) {

			if ( wfReadOnly() ) {
				wfProfileOut( __METHOD__ );
				return false;
			}

			$text = $request->getText('wpArticleComment', false);
			$commentId = $request->getText('id', false);
			if ( !$text || !strlen( $text ) ) {
				wfProfileOut( __METHOD__ );
				return false;
			}

			if ( !$commentId ) {
				wfProfileOut( __METHOD__ );
				return false;
			}

			$commentTitle = $this->mTitle ? $this->mTitle : Title::newFromId($commentId);

			/**
			 * because we save different title via Ajax request
			 */
			$wgTitle = $commentTitle;

			/**
			 * add article using EditPage class (for hooks)
			 */
			$result   = null;
			$article  = new Article( $commentTitle, intval($this->mLastRevId) );
			$editPage = new EditPage( $article );
			$editPage->edittime = $article->getTimestamp();
			$editPage->textbox1 = $text;
			$bot = $user->isAllowed('bot');
			//this function calls Article::onArticleCreate which clears cache for article and it's talk page
			$retval = $editPage->internalAttemptSave( $result, $bot );

			$key = $title->getPrefixedDBkey();
			$wgMemc->delete( wfMemcKey( 'articlecomment', 'comm', $title->getArticleID(), 'v1' ) );

			$res = array( $retval, $article );
		} else {
			$res = false;
		}

		wfProfileOut( __METHOD__ );

		return $res;
	}

	/**
	 * doPost -- static hook/entry for normal request post
	 *
	 * @static
	 * @access public
	 *
	 * @param WebRequest $request -- instance of WebRequest
	 * @param User       $user    -- instance of User
	 * @param Title      $title   -- instance of Title
	 *
	 * @return Article -- newly created article
	 */
	static public function doPost( &$request, &$user, &$title, $parentId = false ) {
		global $wgMemc, $wgTitle;
		wfProfileIn( __METHOD__ );

		$text = $request->getText('wpArticleComment', false);

		if ( !$text || !strlen( $text ) ) {
			wfProfileOut( __METHOD__ );
			return false;
		}

		if ( wfReadOnly() ) {
			wfProfileOut( __METHOD__ );
			return false;
		}

		/**
		 * title for comment is combination of article title and some 'random' data
		 */
		if ($parentId == false) {
			//1st level comment
			$commentTitle = sprintf('%s/%s%s-%s', $title->getText(), ARTICLECOMMENT_PREFIX, $user->getName(), wfTimestampNow());
		} else {
			$parentArticle = Article::newFromID($parentId);
			$parentTitle = $parentArticle->getTitle();
			//nested comment
			$commentTitle = sprintf('%s/%s%s-%s', $parentTitle->getText(), ARTICLECOMMENT_PREFIX, $user->getName(), wfTimestampNow());
		}

		$commentTitle = Title::newFromText($commentTitle, MWNamespace::getTalk($title->getNamespace()));
		/**
		 * because we save different tile via Ajax request
		 */
		$wgTitle = $commentTitle;

		/**
		 * add article using EditPage class (for hooks)
		 */
		$result   = null;
		$article  = new Article( $commentTitle, 0 );
		$editPage = new EditPage( $article );
		$editPage->edittime = $article->getTimestamp();
		$editPage->textbox1 = $text;
		$bot = $user->isAllowed('bot');
		//this function calls Article::onArticleCreate which clears cache for article and it's talk page
		$retval = $editPage->internalAttemptSave( $result, $bot );

		$key = $title->getPrefixedDBkey();

		wfProfileOut( __METHOD__ );

		return array( $retval, $article );
	}

	static public function doAfterPost($status, $article, $commentId = 0) {
		global $wgUser, $wgDBname;
		global $wgDevelEnvironment;

		$error = false; $id = 0;
		switch( $status ) {
			case EditPage::AS_SUCCESS_UPDATE:
			case EditPage::AS_SUCCESS_NEW_ARTICLE:
				$comment = ArticleComment::newFromArticle( $article );
				$text = wfRenderPartial('ArticleComments', 'Comment', array('comment' => $comment->getData(true), 'commentId' => $commentId, 'rowClass' => ''));
				if ( !is_null($comment->mTitle) ) {
					$id = $comment->mTitle->getArticleID();
				}
				if ( empty( $commentId ) && !empty($comment->mTitle) ) {
					$ok = self::addArticlePageToWatchlist($comment, $commentId) ;
				}
				$message = false;

				//commit before purging
				wfGetDB(DB_MASTER)->commit();
				break;
			default:
				//TODO: review - why using wgDevelEnvironment?
				$wgDevelEnvironment = true;
				$userId = $wgUser->getId();
				Wikia::log( __METHOD__, 'error', "No article created. Status: {$status}; DB: {$wgDBname}; User: {$userId}" );
				$text  = false;
				$error = true;
				$message = wfMsg('article-comments-error');
				$wgDevelEnvironment = false; // TODO: FIXME: is this right or do we want to set this to the original value?
		}

		$res = array(
			'commentId' => $commentId,
			'error'  	=> $error,
			'id'		=> $id,
			'msg'    	=> $message,
			'status' 	=> $status,
			'text'   	=> $text
		);

		return $res;
	}

	static public function addArticlePageToWatchlist($comment, $commentId) {
		global $wgUser, $wgEnableArticleWatchlist, $wgBlogsEnableStaffAutoFollow;

		$watchthis = false;
		if ( empty($wgEnableArticleWatchlist) ) {
			return $watchthis;
		}

		if ( !$wgUser->isAnon() ) {
			if ( $wgUser->getOption( 'watchdefault' ) ) {
				$watchthis = true;
			} elseif ( $wgUser->getOption( 'watchcreations' ) && empty($commentId) /* new comment */ ) {
				$watchthis = true;
			}
		}

		$oArticlePage = $comment->getArticleTitle();
		if ( !is_null($oArticlePage) ) {
			$dbw = wfGetDB(DB_MASTER);
			$dbw->begin();
			if ( !$comment->mTitle->userIsWatching() ) {
				# comment
				$dbw->insert(
					'watchlist',
					array(
					'wl_user' => $wgUser->getId(),
					'wl_namespace' => MWNamespace::getTalk($comment->mTitle->getNamespace()),
					'wl_title' => $comment->mTitle->getDBkey(),
					'wl_notificationtimestamp' => wfTimestampNow()
					), __METHOD__, 'IGNORE'
				);
			}

			if ( !$oArticlePage->userIsWatching() ) {
				# and article page
				$dbw->insert(
					'watchlist',
					array(
					'wl_user' => $wgUser->getId(),
					'wl_namespace' => $comment->mTitle->getNamespace(),
					'wl_title' => $oArticlePage->getDBkey(),
					'wl_notificationtimestamp' => NULL
					), __METHOD__, 'IGNORE'
				);
			}

			if ( !empty($wgBlogsEnableStaffAutoFollow) && defined('NS_BLOG_ARTICLE') && $comment->mTitle->getNamespace() == NS_BLOG_ARTICLE ) {
				$owner = BlogArticle::getOwner($oArticlePage);
				$oUser = User::newFromName($owner);
				if ( $oUser instanceof User ) {
					$groups = $oUser->getEffectiveGroups();
					if ( is_array($groups) && in_array( 'staff', $groups ) ) {
						$dbw->insert(
							'watchlist',
							array(
							'wl_user' => $wgUser->getId(),
							'wl_namespace' => NS_BLOG_ARTICLE,
							'wl_title' => $oUser->getName(),
							'wl_notificationtimestamp' => NULL
							), __METHOD__, 'IGNORE'
						);
					}
				}
			}

			$dbw->commit();
		}

		return $watchthis;
	}

	/**
	 * Hook
	 *
	 * @param RecentChange $oRC -- instance of RecentChange class
	 *
	 * @static
	 * @access public
	 *
	 * @return true -- because it's a hook
	 */
	static public function watchlistNotify(RecentChange &$oRC) {
		global $wgEnableGroupedArticleCommentsRC;
		wfProfileIn( __METHOD__ );

		if ( !empty($wgEnableGroupedArticleCommentsRC) && ( $oRC instanceof RecentChange ) ) {
			$title = $oRC->getAttribute('rc_title');
			$namespace = $oRC->getAttribute('rc_namespace');
			$article_id = $oRC->getAttribute('rc_cur_id');
			$title = Title::newFromText($title, $namespace);

			//TODO: review
			if (MWNamespace::isTalk($namespace) &&
				ArticleComment::isTitleComment($title) &&
				!empty($article_id)) {

				$comment = ArticleComment::newFromId( $article_id );
				if ( !is_null($comment) ) {
					$oArticlePage = $comment->getArticleTitle();
					$mAttribs = $oRC->mAttribs;
					$mAttribs['rc_title'] = $oArticlePage->getDBkey();
					$mAttribs['rc_namespace'] = MWNamespace::getSubject($oArticlePage->getNamespace());
					$mAttribs['rc_log_action'] = 'article_comment';
					$oRC->setAttribs($mAttribs);
				}
			}
		}

		wfProfileOut( __METHOD__ );
		return true;
	}

	/**
	 * Hook
	 *
	 * @param Title $title -- instance of EmailNotification class
	 * @param Array $keys -- array of all special variables like $PAGETITLE etc
	 * @param String $message (subject or body)
	 *
	 * @static
	 * @access public
	 *
	 * @return true -- because it's a hook
	 */
	static public function ComposeCommonMail( $title, &$keys, &$message, $editor ) {
		global $wgEnotifUseRealName;

		if (MWNamespace::isTalk($title->getNamespace()) && ArticleComment::isTitleComment($title)) {
			if ( !is_array($keys) ) {
				$keys = array();
			}

			$name = $wgEnotifUseRealName ? $editor->getRealName() : $editor->getName();
			if ( $editor->isIP( $name ) ) {
				$utext = trim(wfMsgForContent('enotif_anon_editor', ''));
				$message = str_replace('$PAGEEDITOR', $utext, $message);
				$keys['$PAGEEDITOR'] = $utext;
			}
		}
		return true;
	}

	/**
	 * create task to move comment
	 *
	 * @access public
	 * @static
	 */
	static private function addMoveTask( $oCommentTitle, &$oNewTitle, $taskParams ) {
		wfProfileIn( __METHOD__ );

		if ( !is_object( $oCommentTitle ) ) {
			wfProfileOut( __METHOD__ );
			return false;
		}

		$parts = self::explode($oCommentTitle->getDBkey());
		$commentTitleText = implode('/', $parts['partsOriginal']);

		$newCommentTitle = Title::newFromText(
			sprintf( '%s/%s', $oNewTitle->getText(), $commentTitleText ),
			MWNamespace::getTalk($oNewTitle->getNamespace()) );

		$taskParams['page'] = $oCommentTitle->getFullText();
		$taskParams['newpage'] = $newCommentTitle->getFullText();
		$thisTask = new MultiMoveTask( $taskParams );
		$submit_id = $thisTask->submitForm();
		Wikia::log( __METHOD__, 'deletecomment', "Added move task ($submit_id) for {$taskParams['page']} page" );

		wfProfileOut( __METHOD__ );
		return true;
	}

	/**
	 * move one comment
	 *
	 * @access public
	 * @static
	 */
	static private function moveComment( $oCommentTitle, &$oNewTitle, $reason = '' ) {
		wfProfileIn( __METHOD__ );

		if ( !is_object( $oCommentTitle ) ) {
			wfProfileOut( __METHOD__ );
			return array('invalid title');
		}

		$parts = self::explode($oCommentTitle->getDBkey());
		$commentTitleText = implode('/', $parts['partsOriginal']);

		$newCommentTitle = Title::newFromText(
			sprintf( '%s/%s', $oNewTitle->getText(), $commentTitleText ),
			MWNamespace::getTalk($oNewTitle->getNamespace()) );

		$error = $oCommentTitle->moveTo( $newCommentTitle, false, $reason, false );

		wfProfileOut( __METHOD__ );
		return $error;
	}

	/**
	 * hook
	 *
	 * @access public
	 * @static
	 */
	static public function moveComments( /*MovePageForm*/ &$form , /*Title*/ &$oOldTitle , /*Title*/ &$oNewTitle ) {
		global $wgUser, $wgRC2UDPEnabled, $wgMaxCommentsToMove, $wgEnableMultiDeleteExt, $wgCityId;
		wfProfileIn( __METHOD__ );

		$commentList = ArticleCommentList::newFromTitle( $oOldTitle );
		$comments = $commentList->getCommentPages(true, false);

		if (count($comments)) {
			$mAllowTaskMove = false;
			if ( isset($wgMaxCommentsToMove) && ( $wgMaxCommentsToMove > 0) && ( !empty($wgEnableMultiDeleteExt) ) ) {
				$mAllowTaskMove = true;
			}

			$irc_backup = $wgRC2UDPEnabled;	//backup
			$wgRC2UDPEnabled = false; //turn off
			$finish = $moved = 0;
			$comments = array_values($comments);
			foreach ($comments as $id => $aCommentArr) {
				$oCommentTitle = $aCommentArr['level1']->getTitle();

				# move comment level #1
				$error = self::moveComment( $oCommentTitle, $oNewTitle, $form->reason );
				if ( $error !== true ) {
					Wikia::log( __METHOD__, 'movepage',
						'cannot move blog comments: old comment: ' . $oCommentTitle->getPrefixedText() . ', ' .
						'new comment: ' . $newCommentTitle->getPrefixedText() . ', error: ' . @implode(', ', $error)
					);
				} else {
					$moved++;
				}

				if (isset($aCommentArr['level2'])) {
					foreach ($aCommentArr['level2'] as $oComment) {
						$oCommentTitle = $oComment->getTitle();

						# move comment level #2
						$error = self::moveComment( $oCommentTitle, $oNewTitle, $form->reason );
						if ( $error !== true ) {
							Wikia::log( __METHOD__, 'movepage',
								'cannot move blog comments: old comment: ' . $oCommentTitle->getPrefixedText() . ', ' .
								'new comment: ' . $newCommentTitle->getPrefixedText() . ', error: ' . @implode(', ', $error)
							);
						} else {
							$moved++;
						}
					}
				}

				if ( $mAllowTaskMove && $wgMaxCommentsToMove < $moved ) {
					$finish = $id;
					break;
				}
			}

			# rest comments move to task
			if ( $finish > 0 && $finish < count($comments) ) {
				$taskParams= array(
					'wikis'		=> '',
					'reason' 	=> $form->reason,
					'lang'		=> '',
					'cat'		=> '',
					'selwikia'	=> $wgCityId,
					'user'		=> $wgUser->getName()
				);

				for ( $i = $finish + 1; $i < count($comments); $i++ ) {
					$aCommentArr = $comments[$i];
					$oCommentTitle = $aCommentArr['level1']->getTitle();
					self::addMoveTask( $oCommentTitle, $oNewTitle, $taskParams );
					if (isset($aCommentArr['level2'])) {
						foreach ($aCommentArr['level2'] as $oComment) {
							$oCommentTitle = $oComment->getTitle();
							self::addMoveTask( $oCommentTitle, $oNewTitle, $taskParams );
						}
					}
				}
			}

			$wgRC2UDPEnabled = $irc_backup; //restore to whatever it was
			$listing = ArticleCommentList::newFromTitle($oNewTitle);
			$listing->purge();
		} else {
			Wikia::log( __METHOD__, 'movepage', 'cannot move article comments, because no comments: ' . $oOldTitle->getPrefixedText());
		}

		wfProfileOut( __METHOD__ );
		return true;
	}

	//Blogs only functions
	/**
	 * setProps -- change props for comment article
	 *
	 */
	public function setProps( $props, $update = false ) {
		wfProfileIn( __METHOD__ );

		if ( $update && class_exists('BlogArticle') ) {
			BlogArticle::setProps( $this->mTitle->getArticleID(), $props );
		}
		$this->mProps = $props;

		wfProfileOut( __METHOD__ );
	}

	/**
	 * getProps -- get props for comment article
	 *
	 */
	public function getProps() {
		if ( (!$this->mProps || !is_array( $this->mProps )) && class_exists('BlogArticle') ) {
			$this->mProps = BlogArticle::getProps( $this->mTitle->getArticleID() );
		}
		return $this->mProps;
	}
}