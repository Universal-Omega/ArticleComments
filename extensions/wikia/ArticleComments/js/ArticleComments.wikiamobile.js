/**
 * Article Comments JS code for the WikiaMobile skin
 *
 * @author Federico "Lox" Lucignano <federico(at)wikia-inc.com>
 **/

var ArticleComments = ArticleComments || (function(){
	/** @private **/

	var wrapper,
		loadMore,
		loadPrev,
		totalPages = 0,
		currentPage = 1,
		ajaxUrl = wgServer + "/index.php?action=ajax&rs=ArticleCommentsAjax&method=axGetComments&useskin=" + skin + "&article=" + wgArticleId,
		clickEvent = WikiaMobile.getClickEvent();

	function clickHandler(){
		var elm = $(this),
			forward = (elm.attr('id') == 'commentsLoadMore'),
			pageIndex = (forward) ? currentPage + 1 : currentPage - 1,
			condition = (forward) ? (currentPage < totalPages) : (currentPage > 1);

		if(condition){
			elm.toggleClass('active');
			$.showLoader(elm);

			$.getJSON(ajaxUrl + '&page=' + pageIndex.toString(), function(result){
				var finished;

				currentPage = pageIndex;
				finished = (forward) ? (currentPage == totalPages) : (currentPage == 1);

				$('#article-comments-ul').html(result.text);

				elm.toggleClass('active');
				$.hideLoader(elm);

				if(finished)
					elm.hide();

				((forward) ? loadPrev : loadMore).show();

				window.scrollTo(0, wrapper.offset().top);
			});
		}
	}

	//init
	$(function(){
		wrapper = $('#WikiaArticleComments');
		loadMore = $('#commentsLoadMore');
		loadPrev = $('#commentsLoadPrev');
		totalPages = parseInt($('#WikiaArticleComments').data('pages'));

		if(totalPages > 1 && wgArticleId){
			loadMore.bind(clickEvent, clickHandler);
			loadPrev.bind(clickEvent, clickHandler);
		}
	});

	/** @public **/

	return {};
})();