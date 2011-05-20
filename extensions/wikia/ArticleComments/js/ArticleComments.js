var ArticleComments = {
	processing: false,

	init: function() {
		$('#article-comm-submit').bind('click', {source: '#article-comm'}, ArticleComments.postComment);
		$('#article-comm-order').find('a').bind('click', ArticleComments.changeOrder);
		$('#article-comments-pagination').find('div').css('backgroundColor', $('#wikia_page').css('backgroundColor'));
		// Support Monobook which is using jquery 1.3.
		// TODO: remove use of live() if/when monobook version of jquery is upgraded and use delegate() instead
		if (jQuery.delegate == undefined) {
			$('#article-comments').each( function() {
				$('.article-comm-delete', this).live('click', ArticleComments.linkDelete);
				$('.article-comm-edit', this).live('click', ArticleComments.edit);
				$('.article-comm-history', this).live('click', ArticleComments.linkHistory);
				$('.article-comm-reply', this).live('click', ArticleComments.reply);
				$('.article-comments-li', this).live('mouseover', function() {
					$(this).find('.tools').css('visibility', 'visible');
				});
				$('.article-comments-li', this).live('mouseout', function() {
					$(this).find('.tools').css('visibility', 'hidden');
				});
			});
 		} else {
			$('#article-comments').delegate('.article-comm-delete', 'click', ArticleComments.linkDelete);
			$('#article-comments').delegate('.article-comm-edit', 'click', ArticleComments.edit);
			$('#article-comments').delegate('.article-comm-history', 'click', ArticleComments.linkHistory);
			$('#article-comments').delegate('.article-comm-reply', 'click', ArticleComments.reply);
			$('#article-comments').delegate('.article-comments-li', 'mouseover',  function(){$(this).find('.tools').css('visibility', 'visible');});
			$('#article-comments').delegate('.article-comments-li', 'mouseout',  function(){$(this).find('.tools').css('visibility', 'hidden');});
		}
		$('#article-comm-fbMonit').mouseenter( function() {$('#fbCommentMessage').fadeIn( 'slow' )});
		$('#article-comm-fbMonit').mouseleave( function() {$('#fbCommentMessage').fadeOut( 'slow' )});
		ArticleComments.addHover();
		ArticleComments.showEditLink();
	},

	log: function(msg) {
		$().log(msg, 'ArticleComments');
	},

	track: function(fakeUrl) {
		//blogs
		if (wgNamespaceNumber == 500 || wgNamespaceNumber == 501) {
			WET.byStr('comment/blog/' + fakeUrl);
		} else {
			WET.byStr('comment/article/' + fakeUrl);
		}
	},

	showEditLink: function() {
		//hack to display 'edit' link when slave lag caused it to be hidden
		if (wgUserName) {
			$('#article-comments-ul details').find('a:contains("' + wgUserName + '")').closest('details').find('.edit-link').show();
		}
	},

	save: function(e) {
		ArticleComments.log('begin: save');
		e.preventDefault();
		ArticleComments.track('editSave');
		if (ArticleComments.processing) return;

		if ($('#article-comm-form-' + e.data.id)) {

			var textfield = $('#article-comm-textfield-' + e.data.id);
			$('#article-comm-submit-' + e.data.id).parent().find('.info').remove();
			if ($.trim(textfield.val()) == '') {
				$('#article-comm-submit-' + e.data.id).after($('<span class="info">').html(e.data.emptyMsg));
				return;
			}
			textfield.attr('readonly', 'readonly');

			var data = {
				action: 'ajax',
				article: wgArticleId,
				id: e.data.id,
				method: 'axSave',
				rs: 'ArticleCommentsAjax',
				title: wgPageName,
				wpArticleComment: textfield.val()
			};

			var throbber = $(this).next('.throbber').css('visibility', 'visible');
			$.postJSON(wgScript, data, function(json) {
				throbber.css('visibility', 'hidden');
				if (!json.error) {
					if (json.commentId && json.commentId != 0) {
						//replace
						$('#comm-' + json.commentId).html(json.text)
					}
					//clear error box
					$('#article-comm-info').html('');
				} else {
					//fill error box
					$('#article-comm-info').html(json.msg);
					//reenable textarea
					textfield.removeAttr('readonly');
				}
				ArticleComments.processing = false;
			});
			ArticleComments.processing = true;
		}
		ArticleComments.log('end: save');
	},

	edit: function(e) {
		ArticleComments.log('begin: edit');
		e.preventDefault();
		ArticleComments.track('edit');
		if (ArticleComments.processing) return;

		var data = {
			action: 'ajax',
			article: wgArticleId,
			id: e.target.id.replace(/^comment/, ''),
			method: 'axEdit',
			rs: 'ArticleCommentsAjax'
		};

		$.getJSON(wgScript, data, function(json) {
			if (!json.error) {
				var buttons = $(e.target).closest('.buttons');
				buttons.hide();
				
				var commentTextDiv = $('#comm-text-' + json.id),
					blockquote = commentTextDiv.parent(),
					details = $(blockquote).find('details');
				
				commentTextDiv.hide();
				$(details).remove();
				$(json.text).attr('id', 'article-comm-div-form-' + json.id).appendTo(blockquote);
				$(details).appendTo(blockquote);
				
				$('#article-comm-submit-' + json.id).bind('click', {id: json.id, emptyMsg: json.emptyMsg}, ArticleComments.save);
				$('.article-comm-edit-cancel').bind('click', {id: json.id, target: e.target, text: json.text}, ArticleComments.cancelEdit);
			}
			ArticleComments.processing = false;
		});
		ArticleComments.processing = true;
		ArticleComments.log('end: edit');
	},
	
	cancelEdit: function(e) {
		ArticleComments.log('begin: cancel edit');
		e.preventDefault();
		
		$('#article-comm-div-form-' + e.data.id).remove();
		$(e.data.target).closest('.buttons').show();
		$('#comm-text-' + e.data.id).show();
		
		ArticleComments.log('end: cancel edit');
	},
	
	reply: function(e) {
		ArticleComments.log('begin: reply');
		e.preventDefault();
		ArticleComments.track('reply');
		if (ArticleComments.processing) return;

		var data = {
			action: 'ajax',
			article: wgArticleId,
			id: $(this).closest('li').attr('id').replace(/^comm-/, ''),
			method: 'axReply',
			rs: 'ArticleCommentsAjax',
			title: wgPageName
		};

		$.getJSON(wgScript, data, function(json) {
			$('#comm-' + json.id).find('.buttons').find('.info').remove();
			if (!json.error) {
				$(e.target).closest('.buttons').hide();
				$('#comm-text-' + json.id).parent().append(json.html);
				$('#article-comm-submit-' + json.id).bind('click', {source: '#article-comm-textfield-' + json.id, parentId: json.id}, ArticleComments.postComment);
				$('#article-comm-textfield-' + json.id).focus();
			} else if (json.error == 2 /*login require*/) {
				$('#comm-' + json.id).find('.tools').after($('<span class="info">').html(json.msg));
			} else /*general error*/ {
				//TODO: add caption
				$.showModal('', json.msg);
			}
			ArticleComments.processing = false;
		});
		ArticleComments.processing = true;
		ArticleComments.log('end: reply');
	},

	postComment: function(e) {
		ArticleComments.log('begin: postComment');
		e.preventDefault();
		ArticleComments.track('post');
		if (ArticleComments.processing) return;
		if ($.trim($(e.data.source).val()) == '') return;
		$(e.data.source).attr('readonly', 'readonly');
		$(e.target).attr('disabled', true);

		var data = {
			action: 'ajax',
			article: wgArticleId,
			method: 'axPost',
			rs: 'ArticleCommentsAjax',
			title: wgPageName,
			wpArticleComment: $(e.data.source).val()
		};
		if (e.data.parentId) {
			data.parentId = e.data.parentId;
			data.page = $('.article-comments-pagination-link-active').eq(0).attr('page');
		}
		var showall = $.getUrlVar('showall');
		if (showall) {
			data.showall = 1;
		}

		var throbber = $(this).next('.throbber').css('visibility', 'visible');
		$.postJSON(wgScript, data, function(json) {
			throbber.css('visibility', 'hidden');
			if (!json.error) {				
				//FIXME: this is dangerous to do without checking for existence of element
				var topE = $('#' + $(json.text).find('li:first').attr('id'));
				if(!topE.exists()) {
					$(json.text).find('li:first').prependTo('#article-comments-ul');					
				} else {
					if(topE.next().hasClass('sub-comments')) {
						topE.next().append($(json.text).find('li:last'));
						topE.replaceWith($(json.text).find('li:first'));
					} else {
						topE.replaceWith($(json.text).children());
					}				
				}

				//update counter
				if ( window.skin == 'oasis' ){
					$('#article-comments-counter-header').html(json.counter.header);
					$('#article-comments-counter-recent').html(json.counter.recent);
					$('#WikiaUserPagesHeader').find('.commentsbubble').html(json.counter.plain);
				}else{
					$('#article-comments-counter').html(json.counter);
				}
				//readd events
				ArticleComments.addHover();
				//force to show 'edit' links for owners
				ArticleComments.showEditLink();
				//clear error box
				$('#article-comm-info').html('');
			} else {
				//fill error box
				$('#article-comm-info').html(json.msg);
			}
			$(e.data.source).removeAttr('readonly');
			$(e.target).removeAttr('disabled');
			$(e.data.source).val('');
			ArticleComments.processing = false;
			
		});
		ArticleComments.processing = true;
		ArticleComments.log('end: postComment');
	},

	setPage: function(e) {
		ArticleComments.log('begin: setPage');
		e.preventDefault();
		var page = parseInt($(this).attr('page'));

		var trackingPage = page;
		var id = $(this).attr('id');
		if (id == 'article-comments-pagination-link-prev') {
			trackingPage = 'prev';
		} else if (id == 'article-comments-pagination-link-next') {
			trackingPage = 'next';
		}
		ArticleComments.track('pageSwitch/' + trackingPage);
		$('#article-comments-pagination-link-' + trackingPage).blur();

		$.getJSON(wgScript + '?action=ajax&rs=ArticleCommentsAjax&method=axGetComments&article=' + wgArticleId, {page: page, order: $('#article-comm-order').attr('value')}, function(json) {
			if (!json.error) {
				$('#article-comments-ul').replaceWith(json.text);
				// oasis
				if ($('.article-comments-pagination').exists()) {
					$('.article-comments-pagination').find('div').html(json.pagination);
					$('html, body').animate({ scrollTop: $('.article-comments-pagination').eq(0).offset().top }, 1);
				} else {//monaco
					$('#article-comments-pagination').find('div').html(json.pagination);
					$('html, body').animate({scrollTop: $('#article-comment-header').offset().top}, 400);
				}
				ArticleComments.addHover();
			}
			ArticleComments.processing = false;
		});
		ArticleComments.log('end: setPage');
	},

	linkDelete: function() {
		ArticleComments.track('delete');
	},

	linkHistory: function() {
		ArticleComments.track('history');
	},

	addHover: function() {
		$('.article-comments-pagination-link').bind('click', ArticleComments.setPage).not('.article-comments-pagination-link-active, #article-comments-pagination-link-prev, #article-comments-pagination-link-next').hover(function() {$(this).addClass('accent');}, function() {$(this).removeClass('accent');});
	},

	changeOrder: function() {
		ArticleComments.log('begin: changeOrder');
		if ($(this).hasClass('desc')) {
			ArticleComments.track('orderSwitch/newestFirst');
		} else {
			ArticleComments.track('orderSwitch/newestLast');
		}
		ArticleComments.log('end: changeOrder');
	}
};

//on content ready
wgAfterContentAndJS.push(ArticleComments.init);