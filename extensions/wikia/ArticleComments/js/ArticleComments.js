var ArticleComments = {
	processing: false,
	clickedElementSelector: "",
	mostRecentCount: 0,
	messagesLoaded: false,
	miniEditorEnabled: typeof wgEnableMiniEditorExt != 'undefined',
	initCompleted: false,
	
	init: function() {
		if (ArticleComments.miniEditorEnabled) {
			$('#article-comm').bind('focus', function(e) {
				ArticleComments.editorInit(this);
			});
		}

		$('#article-comm-submit').bind('click', {source: '#article-comm'}, ArticleComments.actionProxy(ArticleComments.postComment));
		$('#article-comments').delegate('.article-comm-delete', 'click', ArticleComments.linkDelete);
		$('#article-comments').delegate('.article-comm-edit', 'click', ArticleComments.actionProxy(ArticleComments.edit));
		$('#article-comments').delegate('.article-comm-history', 'click', ArticleComments.linkHistory);
		$('#article-comments').delegate('.article-comm-reply', 'click', ArticleComments.actionProxy(ArticleComments.reply));
		$('#article-comm-order').find('a').bind('click', ArticleComments.actionProxy(ArticleComments.changeOrder));
		
		$('#article-comments-pagination').find('div').css('backgroundColor', $('#wikia_page').css('backgroundColor'));
		/*$('#article-comments').delegate('.SpeechBubble', 'mouseover',  function(){$(this).find('.tools').css('visibility', 'visible');});
		$('#article-comments').delegate('.SpeechBubble', 'mouseout',  function(){$(this).find('.tools').css('visibility', 'hidden');});*/
		$('#article-comm-fbMonit').mouseenter(function() {$('#fbCommentMessage').fadeIn( 'slow' )});
		$('#article-comm-fbMonit').mouseleave(function() {$('#fbCommentMessage').fadeOut( 'slow' )});

		ArticleComments.addHover();
		ArticleComments.showEditLink();
		ArticleComments.initCompleted = true;
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

	actionProxy: function(callback) {
		return function(e) {
			e.preventDefault();
			
			// Prevent the action if MiniEditor is enabled and loading
			if (ArticleComments.miniEditorEnabled && MiniEditor.editorIsLoading) {
				return true;
			}

			callback.apply(this, arguments);
		} 
	},

	showEditLink: function() {
		//hack to display 'edit' link when slave lag caused it to be hidden
		if (wgUserName) {
			$('#article-comments-ul details').find('a:contains("' + wgUserName + '")').closest('details').find('.edit-link').show();
		}
	},

	edit: function(e) {
		ArticleComments.log('begin: edit');
		e.preventDefault();
		ArticleComments.track('edit');
		if (ArticleComments.processing) return;

		// If MiniEditor is enabled, we need to determine the correct content format before making the request
		if (ArticleComments.miniEditorEnabled && !MiniEditor.assetsLoaded) {
			MiniEditor.loadAssets(makeRequest);

		} else {
			makeRequest();
		}

		function makeRequest() {
			var commentId = e.target.id.replace(/^comment/, ''),
				textfield = $('#article-comm-textfield-' + commentId),
				format = ArticleComments.getIncomingFormat(textfield);

			$.getJSON(wgScript, {
				action: 'ajax',
				article: wgArticleId,
				convertToFormat: format,
				id: commentId,
				method: 'axEdit',
				rs: 'ArticleCommentsAjax'

			}, function(json) {
				if (!json.error) {
					var buttons = $(e.target).closest('.buttons').hide(),
						divFormSelector = '#article-comm-div-form-' + json.id,
						textfieldSelector = '#article-comm-textfield-' + json.id,
						commentTextDiv = $('#comm-text-' + json.id).hide(),
						editDivForm = $(divFormSelector),
						blockquote = commentTextDiv.parent(),
						editTemplate = $(json.text).hide(),
						content = editTemplate.find(textfieldSelector).val();

					// editForm has to be added to the DOM the first time we call this function
					if (!editDivForm.length) {
						blockquote.append(editTemplate.attr('id', divFormSelector.substr(1)));
						editDivForm = $(divFormSelector);
					}

					var textfield = $(textfieldSelector);
					if (ArticleComments.miniEditorEnabled) {
						ArticleComments.editorInit(textfield, content, json.edgeCases);

					} else {
						textfield.val(content);
					}

					editDivForm.show();

					$('#article-comm-submit-' + json.id).bind('click', {
						id: json.id,
						emptyMsg: json.emptyMsg
					}, ArticleComments.actionProxy(ArticleComments.saveEdit));

					$('#article-comm-edit-cancel-' + json.id).bind('click', {
						id: json.id,
						target: e.target,
						text: json.text
					}, ArticleComments.actionProxy(ArticleComments.cancelEdit));
				}

				ArticleComments.processing = false;
			});
		}

		ArticleComments.processing = true;
		ArticleComments.log('end: edit');
	},

	cancelEdit: function(e) {
		var commentId = e.data.id;

		ArticleComments.log('begin: cancel edit');
		e.preventDefault();

		if (ArticleComments.miniEditorEnabled) {
			$('#article-comm-textfield-' + commentId).data('wikiaEditor').fire('editorDeactivated');
		}

		$('#article-comm-div-form-' + commentId).hide();
		$(e.data.target).closest('.buttons').show();
		$('#comm-text-' + commentId).show();
		
		ArticleComments.log('end: cancel edit');
	},

	saveEdit: function(e) {
		ArticleComments.log('begin: saveEdit');
		e.preventDefault();
		ArticleComments.track('editSave');
		if (ArticleComments.processing) return;

		var commentId = e.data.id,
			commentFormDiv = $('#article-comm-form-' + commentId);
			
		if (commentFormDiv.length) {
			var throbber =  $(e.target).siblings('.throbber'),
				submitButton = $('#article-comm-submit-' + commentId),
				textfield = $('#article-comm-textfield-' + commentId),
				content = ArticleComments.getContent(textfield);

			submitButton.parent().find('.info').remove();

			if ($.trim(content) == '') {
				submitButton.after($('<span>').addClass('info').html(e.data.emptyMsg));
				return;
			}

			$('#article-comm-info').html('');
			throbber.css('visibility', 'visible');
			textfield.attr('readonly', 'readonly');

			$.postJSON(wgScript, {
				action: 'ajax',
				article: wgArticleId,
				convertToFormat: ArticleComments.getOutgoingFormat(textfield),
				id: commentId,
				method: 'axSave',
				rs: 'ArticleCommentsAjax',
				title: wgPageName,
				wpArticleComment: content

			}, function(json) {
				throbber.css('visibility', 'hidden');

				if (!json.error) {
					if (json.commentId && json.commentId != 0) {
						var comment = $('#comm-' + json.commentId),
							saveTemplate = $(json.text);

						$('#article-comm-div-form-' + json.commentId).hide();

						if (ArticleComments.miniEditorEnabled) {
							textfield.data('wikiaEditor').fire('editorReset');
						}

						// Update DOM with information from saveTemplate
						comment.find('.article-comm-text').html(saveTemplate.find('.article-comm-text').html()).show();
						comment.find('.edited-by').html(saveTemplate.find('.edited-by').html());
					}
				} else {
					$('#article-comm-info').html(json.msg);
				}

				textfield.removeAttr('readonly');

				ArticleComments.processing = false;
			});

			ArticleComments.processing = true;
		}

		ArticleComments.log('end: saveEdit');
	},
	
	reply: function(e) {
		ArticleComments.log('begin: reply');
		e.preventDefault();
		ArticleComments.track('reply');
		if (ArticleComments.processing) return;

		$.getJSON(wgScript, {
			action: 'ajax',
			article: wgArticleId,
			id: $(this).closest('li').attr('id').replace(/^comm-/, ''),
			method: 'axReply',
			rs: 'ArticleCommentsAjax',
			title: wgPageName

		}, function(json) {
			var comment = $('#comm-' + json.id),
				blockquote = $('#comm-text-' + json.id).parent(),
				editbox = blockquote.find('.article-comm-edit-box'),
				buttons = blockquote.find('.buttons');

			blockquote.find('.info').remove();

			if (editbox.length) {
				editbox.show();
				buttons.hide();

			} else if (!json.error) {
				buttons.hide();
				blockquote.append(json.html);

				$('#article-comm-reply-submit-' + json.id).bind('click', {
					source: '#article-comm-reply-textfield-' + json.id,
					parentId: json.id
				}, ArticleComments.actionProxy(ArticleComments.postComment));

			// Login required
			} else if (json.error == 2) {
				blockquote.find('.tools').after($('<span>').addClass('info').html(json.msg));

			// General error. TODO: add caption
			} else {
				$.showModal('', json.msg);
			}

			var textfield = $('#article-comm-reply-textfield-' + json.id);
			if (ArticleComments.miniEditorEnabled) {
				ArticleComments.editorInit(textfield);

			} else {
				textfield.focus();
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

		var source = $(e.data.source),
			target = $(e.target),
			throbber = target.siblings('.throbber'),
			content = ArticleComments.getContent(source),
			showall = $.getUrlVar('showall');

		if ($.trim(content) == '') return;

		throbber.css('visibility', 'visible');
		source.attr('readonly', 'readonly');
		target.attr('disabled', true);

		var data = {
			action: 'ajax',
			article: wgArticleId,
			convertToFormat: ArticleComments.getOutgoingFormat(source),
			method: 'axPost',
			rs: 'ArticleCommentsAjax',
			title: wgPageName,
			wpArticleComment: content
		};

		if (e.data.parentId) {
			data.parentId = e.data.parentId;
			data.page = $('.article-comments-pagination-link-active').eq(0).attr('page');
		}

		if (showall) {
			data.showall = 1;
		}

		function makeRequest() {
			$.postJSON(wgScript, data, function(json) {
				throbber.css('visibility', 'hidden');
				
				if (ArticleComments.miniEditorEnabled) {
					source.data('wikiaEditor').fire('editorReset');

				} else {
					source.val('');
				}

				if (!json.error) {
					var parent,
						subcomments,
						parentId = json.parentId,
						nodes = $(json.text);

					if (parentId) {
						//second level: reply
						parent = $('#comm-' + parentId);
						subcomments = parent.next();

						if(!subcomments.hasClass('sub-comments')){
							parent.after(subcomments = $('<ul class="sub-comments"></ul>'));
						}

						subcomments.append(nodes);

						//remove input field and show buttons
						parent.find('.article-comm-edit-box').hide();
						parent.find('.buttons').show();
					} else {
						//first level: comment
						nodes.prependTo('#article-comments-ul');
					}

					//update counter
					$('#article-comments-counter-header').html($.msg('oasis-comments-header', json.counter));

					if (window.skin == 'oasis') {
						$('#WikiaPageHeader').find('.commentsbubble').html(json.counter);

						if (!parentId) {
							if (!ArticleComments.mostRecentCount) {
								ArticleComments.mostRecentCount = $('#article-comments-ul > li').length;
							} else {
								ArticleComments.mostRecentCount++;
							}

							$('#article-comments-counter-recent').html($.msg('oasis-comments-showing-most-recent', ArticleComments.mostRecentCount));
						}
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

				source.removeAttr('readonly');
				$(e.target).removeAttr('disabled');

				ArticleComments.processing = false;
			});

			ArticleComments.processing = true;
		}

		if (!ArticleComments.messagesLoaded) {
			$.getMessages('ArticleCommentsCounter', function() {
				ArticleComments.messagesLoaded = true;
				makeRequest();
			});
		} else {
			makeRequest();
		}

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

		$.getJSON(wgScript + '?action=ajax&rs=ArticleCommentsAjax&method=axGetComments&article=' + wgArticleId, {
			page: page,
			order: $('#article-comm-order').attr('value')

		}, function(json) {
			if (!json.error) {
				$('#article-comments-ul').html(json.text);
				if ($('.article-comments-pagination').exists()) {
					$('.article-comments-pagination').find('div').html(json.pagination);

					if(ArticleComments.clickedElementSelector == "" || !$(ArticleComments.clickedElementSelector).exists()) {
						ArticleComments.clickedElementSelector = '.article-comments-pagination';
					}
				}
				ArticleComments.addHover();

				if(ArticleComments.clickedElementSelector != "") {
					var docViewTop = $(window).scrollTop();
					var docViewBottom = docViewTop + $(window).height();
					var elemTop = $(ArticleComments.clickedElementSelector).eq(0).offset().top;
					if(elemTop < docViewTop || elemTop > docViewBottom) {
						$('html, body').animate({ scrollTop: elemTop }, 1);
					}
				}
			}
			ArticleComments.clickedElementSelector = "";
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
		$('.article-comments-pagination-link')
			.bind('click', ArticleComments.setPage)
			.not('.article-comments-pagination-link-active, #article-comments-pagination-link-prev, #article-comments-pagination-link-next')
			.hover(function() {
				$(this).addClass('accent');

			}, function() {
				$(this).removeClass('accent');
			});
	},

	changeOrder: function() {
		ArticleComments.log('begin: changeOrder');
		if ($(this).hasClass('desc')) {
			ArticleComments.track('orderSwitch/newestFirst');
		} else {
			ArticleComments.track('orderSwitch/newestLast');
		}
		ArticleComments.log('end: changeOrder');
	},

	// Used to initialize MiniEditor
	editorInit: function(node, content, edgeCases) {
		var element = $(node),
			wikiaEditor = element.data('wikiaEditor'),
			allActions = $('#article-comm-submit, .article-comm-buttons, .speech-bubble-message div.buttons');

		allActions.addClass('loading').attr('disabled', true);

		// Already exists
		if (wikiaEditor) {
			wikiaEditor.fire('editorActivated');

			if (content) {
				wikiaEditor.setContent(content);
			}

		} else {
			element.miniEditor({
				config: {

					// If edge cases were found when loading our content, use source mode
					mode: $.isArray(edgeCases) && edgeCases.length ? 'source' : MiniEditor.config.mode
				},
				events: {
					editorReady: function(event, wikiaEditor) {
						if (content) {
							wikiaEditor.setContent(content);
						}
					},
					editorActivated: function(event, wikiaEditor) {
						allActions.removeClass('loading').removeAttr('disabled');
						var articleComm = wikiaEditor.element.closest('.speech-bubble-message');
						articleComm.find('.edited-by .buttons').hide();
					},
					editorDeactivated: function(event, wikiaEditor) {
						allActions.removeClass('loading').removeAttr('disabled');
						var articleComm = wikiaEditor.element.closest('.speech-bubble-message');
						if (!wikiaEditor.getContent()) {
							articleComm.find('.article-comm-edit-box').hide();
							articleComm.find('.edited-by .buttons').show();
						}
					}
				}
			});
		}
	},

	getContent: function(element) {
		return ArticleComments.miniEditorEnabled ? element.data('wikiaEditor').getContent() : element.val();
	},

	getIncomingFormat: function(element) {
		return ArticleComments.miniEditorEnabled ? MiniEditor.getIncomingFormat(element) : '';
	},

	getOutgoingFormat: function(element) {
		return ArticleComments.miniEditorEnabled ? MiniEditor.getOutgoingFormat(element) : '';
	}
};

//on content ready
wgAfterContentAndJS.push(ArticleComments.init);
