<?php

class ArticleCommentInit {
	public static $enable = null;

	static public function ArticleCommentCheck() {
		global $wgTitle, $wgRequest, $wgUser;
		wfProfileIn( __METHOD__ );

		if (is_null(self::$enable)) {
			self::$enable = self::ArticleCommentCheckTitle($wgTitle);

			//respect diffonly settings for user - see RT#65037
			$diff = $wgRequest->getVal('diff');
			$diffOnly = $wgRequest->getBool('diffonly', $wgUser->getOption('diffonly'));
			if (isset($diff) && $diffOnly) {
				self::$enable = false;
			}

			$action = $wgRequest->getVal('action', 'view');
			if ($action == 'purge' && $wgUser->isAnon() && !$wgRequest->wasPosted()) {
				self::$enable = false;
			}
			if ($action != 'view' && $action != 'purge') {
				self::$enable = false;
			}
		}
		wfProfileOut( __METHOD__ );
		return self::$enable;
	}

	/**
	 * Check whether comments should be enabled for given title
	 */
	static public function ArticleCommentCheckTitle($title) {
		global $wgContentNamespaces, $wgArticleCommentsNamespaces;
		wfProfileIn(__METHOD__);

		//enable comments only on content namespaces (use $wgArticleCommentsNamespaces if defined)
		$enable = self::ArticleCommentCheckNamespace($title);

		//non-existing articles
		if (!$title->exists()) {
			$enable = false;
		}

		//disable on main page (RT#33703)
		if (Title::newMainPage()->getText() == $title->getText()) {
			$enable = false;
		}

		//disable on redirect pages (RT#44315)
		if ($title->isRedirect()) {
			$enable = false;
		}

		//disable on pages that cant be read (RT#49525)
		if (!$title->userCan('read')) {
			$enable = false;
		}

		//blog listing? (eg: User:Name instead of User:Name/Blog_name) - do not show comments
		if (defined('NS_BLOG_ARTICLE') && $title->getNamespace() == NS_BLOG_ARTICLE && strpos($title->getText(), '/') === false) {
			$enable = false;
		}

		wfProfileOut(__METHOD__);
		return $enable;
	}

	/**
	 * Check whether comments should be enabled for namespace of given title
	 */
	static public function ArticleCommentCheckNamespace($title) {
		global $wgContentNamespaces, $wgArticleCommentsNamespaces;
		wfProfileIn(__METHOD__);

		//enable comments only on content namespaces (use $wgArticleCommentsNamespaces if defined)
		$enable = in_array($title->getNamespace(), empty($wgArticleCommentsNamespaces) ? $wgContentNamespaces : $wgArticleCommentsNamespaces);

		wfProfileOut(__METHOD__);
		return $enable;
	}

	//hook used only in Monaco - we want to put comment box in slightly different position, just between article area and the footer
	static public function ArticleCommentEnableMonaco(&$this, &$tpl, &$custom_article_footer) {
		//don't touch $custom_article_footer! we don't want to replace the footer - we just want to echo something just before it
		if (self::ArticleCommentCheck()) {
			global $wgTitle;
			wfLoadExtensionMessages('ArticleComments');
			$page = ArticleCommentList::newFromTitle($wgTitle);
			echo $page->render();
		}
		return true;
	}

	static public function ArticleCommentEnable(&$data) {
		global $wgTitle, $wgUser;

		//use this hook only for skins other than Monaco
		//update: it's actually only MonoBook since Oasis uses its own
		//logic and mobile skins do not show comments-related stuff
		if ( in_array( get_class( $wgUser->getSkin() ), array(
			'SkinMonaco',
			'SkinAnswers',
			'SkinOasis',
			'SkinWikiaphone',
			'SkinWikiaApp'
		) ) ) {
			return true;
		}
		
		wfProfileIn( __METHOD__ );

		if (self::ArticleCommentCheck()) {
			wfLoadExtensionMessages('ArticleComments');
			$page = ArticleCommentList::newFromTitle($wgTitle);
			$data = $page->render();
		}
		
		wfProfileOut( __METHOD__ );
		return true;
	}

	static public function ArticleCommentAddJS(&$out, &$sk) {
		global $wgJsMimeType, $wgExtensionsPath, $wgStyleVersion;
		wfProfileIn( __METHOD__ );

		if (self::ArticleCommentCheck()) {
			global $wgUser;
			if ( !in_array( get_class( $wgUser->getSkin() ), array(
				'SkinMonaco',
				'SkinAnswers',
				'SkinOasis',
				'SkinWikiaphone',
				'SkinWikiaApp'
			) ) ) {
				$out->addScript("<script type=\"{$wgJsMimeType}\" src=\"{$wgExtensionsPath}/wikia/ArticleComments/js/ArticleComments.js?{$wgStyleVersion}\" ></script>\n");
				$out->addExtensionStyle("$wgExtensionsPath/wikia/ArticleComments/css/ArticleComments.css?$wgStyleVersion");
			}
		}
		wfProfileOut( __METHOD__ );
		return true;
	}

	//TODO: not used in oasis - remove
	static public function ArticleCommentHideTab(&$skin, &$content_actions) {
		global $wgArticleCommentsHideDiscussionTab;
		wfProfileIn( __METHOD__ );

		if (!empty($wgArticleCommentsHideDiscussionTab) && self::ArticleCommentCheck()) {
			unset($content_actions['talk']);
		}

		wfProfileOut( __METHOD__ );
		return true;
	}

	/**
	 * Hook
	 *
	 * @param Parser $rc -- instance of Parser class
	 * @param Skin $sk -- instance of Skin class
	 * @param string $toc -- HTML for TOC
	 * @param array $sublevelCount -- last used numbers for each indentation
	 *
	 * @static
	 * @access public
	 * @todo TODO: not working - check
	 *
	 * @return true -- because it's a hook
	 */
	static function InjectTOCitem($parser, $sk, &$toc, &$sublevelCount) {
		if (self::ArticleCommentCheck()) {
			wfLoadExtensionMessages('ArticleComments');
			$tocnumber = ++$sublevelCount[1];
			$toc .= $sk->tocLine('article-comment-header', wfMsg('article-comments-toc-item'), $tocnumber, 1);
		}
		return true;
	}

	/**
	 * Hook handler
	 *
	 * @param Title $title
	 * @param User $fakeUser
	 *
	 * @static
	 * @access public
	 *
	 * @return true -- because it's a hook
	 */
	static function ArticleCommentNotifyUser($title, &$fakeUser) {
		if ($title->getNamespace() == NS_USER_TALK && ArticleComment::isTitleComment($title)) {
			$parts = ArticleComment::explode($title->getText());
			if ($parts['title'] != '') {
				$newUser = User::newFromName($parts['title']);
				if ($newUser instanceof User) {
					$fakeUser = $newUser;
				}
			}
		}
		return true;
	}

	/**
	 * Hook handler
	 */
	public static function userCan( $title, $user, $action, &$result ) {
		$namespace = $title->getNamespace();

		// we only care if this is a talk namespace
		if ( MWNamespace::getSubject( $namespace ) == $namespace ) {
			return true;
		}

		//for blog comments BlogLockdown is checking rights
		if ((defined('NS_BLOG_ARTICLE') && $namespace == NS_BLOG_ARTICLE) ||
			defined('NS_BLOG_ARTICLE_TALK') && $namespace == NS_BLOG_ARTICLE_TALK ) {
			return true;
		}

		$parts = ArticleComment::explode($title->getText());
		//not article comment
		if (count($parts['partsStripped']) == 0) {
			return true;
		}

		$firstRev = $title->getFirstRevision();
		if ($firstRev && $user->getName() == $firstRev->getUserText()) {
			return true;
		}

		// Facebook connection needed
		if ( self::isFbConnectionNeeded() ){
			return false;
		}

		switch ($action) {
			case 'move':
			case 'move-target':
				return $user->isAllowed( 'commentmove' );
				break;
			case 'edit':
				return $user->isAllowed( 'commentedit' );
				break;
			case 'delete':
				return $user->isAllowed( 'commentdelete' );
				break;
		}
		return true;
	}

	/**
	 * isFbConnectionNeeded -- checkes is everything OK with Facebook connection
	 *
	 * @access private
	 * @author Jakub
	 *
	 * @return boolean
	 */
	static public function isFbConnectionNeeded() {
		global $wgRequireFBConnectionToComment, $wgEnableFacebookConnectExt, $wgUser;

		if ( !empty ( $wgRequireFBConnectionToComment ) &&
			!empty ( $wgEnableFacebookConnectExt ) ) {
			$fb = new FBConnectAPI();
			$tmpArrFaceBookId = FBConnectDB::getFacebookIDs($wgUser);
			$isFBConnectionProblem = (
				( $fb->user() == 0 ) ||					// fb id or 0 if none is found.
				!isset( $tmpArrFaceBookId[0] ) ||
				( (int)$fb->user() != (int)$tmpArrFaceBookId[0] )	// current fb id different from fb id of currenty logged user.
			);
			return $isFBConnectionProblem;
		} else {
			return false;
		}
	}
}