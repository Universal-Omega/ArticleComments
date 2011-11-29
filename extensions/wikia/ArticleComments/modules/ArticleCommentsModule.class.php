<?php
class ArticleCommentsModule extends WikiaService {

	public function executeIndex() {
		wfProfileIn(__METHOD__);

		if (class_exists('ArticleCommentInit') && ArticleCommentInit::ArticleCommentCheck()) {
			
			if ($this->wg->Request->wasPosted()) {
				// for non-JS version !!!
				$sComment = $this->wg->Request->getVal( 'wpArticleComment', false );
				$iArticleId = $this->wg->Request->getVal( 'wpArticleId', false );
				$sSubmit = $this->wg->Request->getVal( 'wpArticleSubmit', false );
				if ( $sSubmit && $sComment && $iArticleId ) {
					$oTitle = Title::newFromID( $iArticleId );
					if ( $oTitle instanceof Title ) {
						$response = ArticleComment::doPost( $this->wg->Request->getVal('wpArticleComment') , $this->wg->User, $oTitle );
						$this->wg->Out->redirect( $oTitle->getLocalURL() );
					}
				}
			}
		
			$this->getCommentsData($this->wg->Title, (int)$this->wg->request->getVal( 'page', 1 ));
		}

		wfProfileOut(__METHOD__);
	}
	
	public function getCommentsData($title, $page, $perPage = null, $filterid = null) {
		wfProfileIn(__METHOD__);

		$commentList = F::build('ArticleCommentList', array(($title)), 'newFromTitle');
		if(!empty($perPage)) {
			$commentList->setMaxPerPage($perPage);			
		}
		
		if(!empty($filterid)) {
			$commentList->setId($filterid);			
		}
		
		$data = $commentList->getData($page);

		if (empty($data)) {
			// Seems like we should always have data, so this is an error.  How to signal?
		}

		// Hm.
		// TODO: don't pass whole instance of Masthead object for author of current comment
		$this->avatar = $data['avatar'];

		$this->title = $this->wg->Title;
		$this->ajaxicon = $this->wg->StylePath.'/common/images/ajax.gif';
		$this->canEdit = $data['canEdit'];
		$this->isBlocked = $data['isBlocked'];
		$this->reason = $data['reason'];
		$this->commentListRaw = $data['commentListRaw'];
		$this->isLoggedIn =  $this->wg->User->isLoggedIn();
		
		$this->isReadOnly = $data['isReadOnly'];
		$this->page = $data['page'];
		$this->pagination = $data['pagination'];

		$this->countComments = $data['countComments'];
		$this->countCommentsNested = $data['countCommentsNested'];
		$this->commentingAllowed = $data['commentingAllowed'];
		$this->commentsPerPage = $data['commentsPerPage'];
		
		wfProfileOut(__METHOD__);
	}
}
