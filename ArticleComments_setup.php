<?php

/**
 * ArticleComments
 *
 * A ArticleComments extension for MediaWiki
 * Adding comment functionality on article pages
 *
 * @author Krzysztof Krzyżaniak <eloy@wikia.inc>
 * @author Maciej Błaszkowski (Marooned) <marooned at wikia-inc.com>
 * @date 2010-07-14
 * @copyright Copyright (C) 2010 Krzysztof Krzyżaniak, Wikia Inc.
 * @copyright Copyright (C) 2010 Maciej Błaszkowski, Wikia Inc.
 * @license https://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 * @package MediaWiki
 *
 * To activate this functionality, place this file in your extensions/
 * subdirectory, and add the following line to LocalSettings.php:
 *     require_once('$IP/extensions/wikia/ArticleComments/ArticleComments_setup.php');
 */


$wgExtensionCredits['other'][] = [
	'name' => 'ArticleComments',
	'version' => '2.0',
	'author' => [ '[http://www.wikia.com/wiki/User:Eloy.wikia Krzysztof Krzyżaniak (eloy)]', '[http://www.wikia.com/wiki/User:Marooned Maciej Błaszkowski (Marooned)]' ],
	'url' => 'https://github.com/Wikia/app/tree/dev/extensions/wikia/ArticleComments',
	'descriptionmsg' => 'article-comments-desc'
];

define( 'ARTICLECOMMENTORDERCOOKIE_NAME', 'articlecommentorder' );
define( 'ARTICLECOMMENTORDERCOOKIE_EXPIRE', 60 * 60 * 24 * 365 );
define( 'ARTICLECOMMENT_PREFIX', '@comment-' );

// autoloaded classes
$wgAutoloadClasses['ArticleCommentInit'] = __DIR__ . '/classes/ArticleCommentInit.class.php';
$wgAutoloadClasses['ArticleComment'] = __DIR__ . '/classes/ArticleComment.class.php';
$wgAutoloadClasses['ArticleCommentList'] = __DIR__ . '/classes/ArticleCommentList.class.php';
$wgAutoloadClasses['ArticleCommentsAjax'] = __DIR__ . '/classes/ArticleCommentsAjax.class.php';
$wgAutoloadClasses['ArticleCommentsTitle'] = __DIR__ . '/classes/ArticleCommentsTitle.class.php';
$wgAutoloadClasses['ArticleCommentsController'] = __DIR__ . '/modules/ArticleCommentsController.class.php';
$wgAutoloadClasses['ArticleCommentsHooks'] = __DIR__ . '/ArticleCommentsHooks.class.php';

$wgExtensionMessagesFiles['ArticleComments'] = __DIR__ . '/ArticleComments.i18n.php';

$wgHooks['ArticleDelete'][] = 'ArticleCommentList::articleDelete';
$wgHooks['ArticleDeleteComplete'][] = 'ArticleCommentList::articleDeleteComplete';
$wgHooks['ArticleRevisionUndeleted'][] = 'ArticleCommentList::undeleteComments';
$wgHooks['RecentChange_save'][] = 'ArticleComment::watchlistNotify';
// recentchanges
$wgHooks['ChangesListMakeSecureName'][] = 'ArticleCommentList::makeChangesListKey';
$wgHooks['ChangesListInsertArticleLink'][] = 'ArticleCommentList::ChangesListInsertArticleLink';
// $wgHooks['WikiaRecentChangesBlockHandlerChangeHeaderBlockGroup'][] = 'ArticleCommentList::setHeaderBlockGroup';
// special::watchlist
$wgHooks['ComposeCommonSubjectMail'][] = 'ArticleComment::ComposeCommonMail';
$wgHooks['ComposeCommonBodyMail'][] = 'ArticleComment::ComposeCommonMail';
// TOC
$wgHooks['Parser::InjectTOCitem'][] = 'ArticleCommentInit::InjectTOCitem';
// omit captcha
$wgHooks['ConfirmEdit::onConfirmEdit'][] = 'ArticleCommentList::onConfirmEdit';
// redirect
$wgHooks['ArticleFromTitle'][] = 'ArticleCommentList::ArticleFromTitle';
// user talk comment and notify
$wgHooks['UserMailer::NotifyUser'][] = 'ArticleCommentInit::ArticleCommentNotifyUser';
// blogs
$wgHooks['UndeleteComplete'][] = 'ArticleCommentList::undeleteComplete';
// prevent editing not own comments
$wgHooks['userCan'][] = 'ArticleComment::userCan';
// HAWelcome
$wgHooks['HAWelcomeGetPrefixText'][] = 'ArticleCommentInit::HAWelcomeGetPrefixText';

// added by Moli
// special::movepage
$wgHooks['SpecialMovepageAfterMove'][] = 'ArticleComment::moveComments';

$wgHooks['ParserFirstCallInit'][] = 'ArticleComment::metadataParserInit';

// $wgHooks['WikiaMobileAssetsPackages'][] = 'ArticleCommentInit::onWikiaMobileAssetsPackages';

$wgHooks['BeforePageDisplay'][] = 'ArticleCommentsController::onBeforePageDisplay';
$wgHooks['SkinAfterContent'][] = 'ArticleCommentsController::onSkinAfterContent';

$wgHooks['FilePageImageUsageSingleLink'][] = 'ArticleCommentInit::onFilePageImageUsageSingleLink';
$wgHooks['AfterPageHeaderButtons'][] = 'ArticleCommentsHooks::onAfterPageHeaderButtons';

// SUS-3433 article comments mapping table
$wgHooks['LoadExtensionSchemaUpdates'][] = 'ArticleCommentsHooks::onLoadExtensionSchemaUpdates';

/*
//JSMEssages setup
JSMessages::registerPackage( 'ArticleCommentsCounter', [
	'oasis-comments-header',
	'oasis-comments-showing-most-recent'
] );

JSMessages::registerPackage( 'WikiaMobileComments', [
	'wikiamobile-article-comments-replies',
	'wikiamobile-article-comments-view',
	'wikiamobile-article-comments-post',
	'wikiamobile-article-comments-post-reply',
	'wikiamobile-article-comments-login-post',
	'wikiamobile-article-comments-post-fail'
] );
*/

// Ajax dispatcher
$wgAjaxExportList[] = 'ArticleCommentsAjax';

function ArticleCommentsAjax() {
	global $wgRequest;
	$method = $wgRequest->getVal( 'method', false );

	if ( method_exists( 'ArticleCommentsAjax', $method ) ) {
		$data = ArticleCommentsAjax::$method();

		if ( is_array( $data ) ) {
			// send array as JSON
			$json = json_encode( $data );
			$response = new AjaxResponse( $json );
			$response->setContentType( 'application/json; charset=utf-8' );
		} else {
			// send text as text/html
			$response = new AjaxResponse( $data );
			$response->setContentType( 'text/html; charset=utf-8' );
		}

		// Don't cache requests made to edit comment, see SOC-788
		if ( $method == 'axEdit' ) {
			$response->setCacheDuration( 0 );
		}

		return $response;
	}
}
