<?php

use Wikia\PageHeader\Button;

class ArticleCommentsHooks {
	public static function onRegistration() {
		global $wgAjaxExportList;

		$wgAjaxExportList[] = 'ArticleCommentsHooks::ArticleCommentsAjax';
	}

	public static function ArticleCommentsAjax() {
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

	/**
	 * @param Title $title
	 * @param array $buttons
	 *
	 * @return bool
	 */
	public static function onAfterPageHeaderButtons( \Title $title, array &$buttons ): bool {
		if ( WikiaPageType::isActionPage() ) {
			return true;
		}

		$service = new PageStatsService( $title );
		$comments = $service->getCommentsCount();

		if ( ArticleCommentInit::ArticleCommentCheckTitle( $title ) ) {
			if ( $comments > 0 ) {
				$label = wfMessage( 'article-comments-comments' )
					->params( CommentsLikesController::formatCount( $comments ) )
					->escaped();
			} else {
				$label = wfMessage( 'article-comments-no-comments' )
					->escaped();
			}

			array_unshift(
				$buttons,
				new Button(
					$label, '', ArticleCommentInit::getCommentsLink( $title ), 'wds-is-secondary', ''
				)
			);
		}

		return true;
	}

	public static function onLoadExtensionSchemaUpdates( DatabaseUpdater $updater ) {
		$updater->addExtensionTable( 'article_comments', __DIR__ . '/sql/article_comments.sql' );
	}
}
