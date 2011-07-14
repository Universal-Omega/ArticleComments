<?php
class ArticleCommentsModule extends Module {

	var $dataAfterContent;   // fully rendered HTML that comes from skin object

	var $wgTitle;
	var $wgStylePath;
	var $wgArticleCommentsEnableVoting;

	var $avatar;
	var $canEdit;
	var $isBlocked;
	var $reason;
	var $commentListRaw;
	var $isReadOnly;
	var $page;
	var $pagination;
	var $countComments;
	var $countCommentsNested;
	var $commentingAllowed;
	var $commentsPerPage;

	public function executeIndex() {
		wfProfileIn(__METHOD__);

		global $wgTitle;

		if (class_exists('ArticleCommentInit') && ArticleCommentInit::ArticleCommentCheck()) {
			wfLoadExtensionMessages('ArticleComments');

			$commentList = ArticleCommentList::newFromTitle($wgTitle);
			$data = $commentList->getData();
			if (empty($data)) {
				// Seems like we should always have data, so this is an error.  How to signal?
			}

			// Hm.
			// TODO: don't pass whole instance of Masthead object for author of current comment
			$this->avatar = $data['avatar'];

			$this->canEdit = $data['canEdit'];
			$this->isBlocked = $data['isBlocked'];
			$this->reason = $data['reason'];
			$this->commentListRaw = $data['commentListRaw'];
			$this->isReadOnly = $data['isReadOnly'];
			$this->page = $data['page'];
			$this->pagination = $data['pagination'];
			$this->countComments = $data['countComments'];
			$this->countCommentsNested = $data['countCommentsNested'];
			$this->commentingAllowed = $data['commentingAllowed'];
			$this->commentsPerPage = $data['commentsPerPage'];

			//echo "<pre>" . print_r($this->avatar, true) . "</pre>";

		}

		wfProfileOut(__METHOD__);
	}
}
