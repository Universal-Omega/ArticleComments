<?php
$messages = array();

$messages['en'] = array(
	'article-comments-desc' => 'Article comments for wiki pages',
	'article-comments-file-page' => '[[$1|Comment from $2]] on [[$3]]',
	'article-blog-comments-file-page' => "[[$1|Comment from $2]] on [[$3|$4]] post on [[$5|$6's]] blog",
	'article-comments-anonymous' => 'Anonymous user',
	'article-comments-comments' => 'Comments ($1)',
	'article-comments-no-comments' => 'Comments',
	'article-comments-post' => 'Post comment',
	'article-comments-cancel' => 'Cancel',
	'article-comments-delete' => 'delete',
	'article-comments-edit' => 'edit',
	'article-comments-history' => 'history',
	'article-comments-error' => 'Comment could not be saved',
	'article-comments-undeleted-comment' => 'Undeleted comment for blog page $1',
	'article-comments-rc-comment' => 'Article comment (<span class="plainlinks">[$1 $2]</span>)',
	'article-comments-rc-comments' => 'Article comments ([[$1]])',
	'article-comments-rc-blog-comment' => '&nbsp;Blog comment (<span class="plainlinks">[$1 $2]</span>)',
	'article-comments-rc-blog-comments' => 'Blog comments ([[$1]])',
	'article-comments-login' => 'Please [[Special:UserLogin|log in]] to post a comment on this wiki.',
	'article-comments-toc-item' => 'Comments',
	'article-comments-comment-cannot-add' => 'You cannot add a comment to the article.',
	'article-comments-reply' => 'Reply',
	'article-comments-show-all' => 'Show all comments',
	'article-comments-prev-page' => 'Prev',
	'article-comments-next-page' => 'Next',
	'article-comments-page-spacer' => '&#160;...&#160;',
	'article-comments-delete-reason' => 'The parent article / parent comment has been deleted.',
	'article-comments-empty-comment' => "You can't post an empty comment. [$1 Delete it instead?]",
	'article-comments-show-more' => 'Show more comments',
	'wikiamobile-article-comments-counter' => '$1 {{PLURAL:$1|Comment|Comments}}',
	'wikiamobile-article-comments-header' => 'Comments',
	'wikiamobile-article-comments-more' => 'Load more',
	'wikiamobile-article-comments-prev' => 'Load previous',
	'wikiamobile-article-comments-none' => 'No comments',
	'wikiamobile-article-comments-view' => 'View replies',
	'wikiamobile-article-comments-replies' => 'replies',
	'wikiamobile-article-comments-post-reply' => 'Post a reply',
	'wikiamobile-article-comments-post' => 'Post',
	'wikiamobile-article-comments-placeholder' => 'Post a comment',
	'wikiamobile-article-comments-login-post' => 'Please log in to post a comment.',
	'wikiamobile-article-comments-post-fail' => 'Failed to save comment, please try again later',
	'enotif_subject_article_comment' => 'Read the latest comments on the $PAGETITLE page on {{SITENAME}}',
	'enotif_body_article_comment' => 'Hi $WATCHINGUSERNAME,
There\'s a new comment at $PAGETITLE on {{SITENAME}}. Use this link to see all of the comments: $PAGETITLE_URL#WikiaArticleComments

- Wikia Community Support

___________________________________________
* Find help and advice on Community Central: https://community.fandom.com
* Want to receive fewer messages from us? You can unsubscribe or change your email preferences here: https://community.fandom.com/Special:Preferences',
	'enotif_body_article_comment-HTML' => 'Hi $WATCHINGUSERNAME,
<br /><br />
There\'s a new comment at $PAGETITLE on {{SITENAME}}. Use this link to see all of the comments: <a href="$PAGETITLE_URL#WikiaArticleComments">$PAGETITLE</a>
<br /><br />
- Wikia Community Support
<br /><hr />
<p>
<ul>
<li>Find help and advice on <a href="https://community.fandom.com">Community Central</a>.</li>
<li>Want to receive fewer messages from us? You can unsubscribe or change your email preferences <a href="https://community.fandom.com/Special:Preferences">here</a>.
</li>
</ul>
</p>',
	'right-commentdelete' => 'Can delete article comments',
	'right-commentedit' => 'Can edit article comments',
	'right-commentmove' => 'Can move article comments',
	'right-commentcreate' => 'Can create article comments',
);

$messages['qqq'] = array(
	'article-comments-desc' => '{{desc}}',
	'article-comments-file-page' => 'Format of the file usage (see [[MediaWiki:Linkstoimage]]) entry on the file page if the file is used in an article comment.
Parameters:
* $1 -Title text of the comment that includes the image.
* $2 - Username of the user who left the comment that includes the image. Supports GENDER
* $3 - Page name of parent article.',
	'article-blog-comments-file-page' => 'Format of the file usage (see [[MediaWiki:Linkstoimage]]) entry on the file page if the file is used in a blog comment.
Parameters:
* $1 - Title text of the comment includes the image.
* $2 - Username of the user who left the comment that includes the image. Supports GENDER
* $3 - Title text of the blog that has the specific comment.
* $4 - Name of the blog post.
* $5 - Title text of the blog page of the author of the blog post (not the blog comment).
* $6 - Username of the author of the blog post (not the blog comment). Supports GENDER.',
	'article-comments-anonymous' => 'Anonymous users are logged out / un-authenticated users.
{{Identical|Anonymous user}}',
	'article-comments-comments' => '{{Identical|Comment}}',
	'article-comments-no-comments' => 'Label on button that links to comments if there is no comments yet',
	'article-comments-post' => 'This is the text of a submit button to post a new article comment.
{{Identical|Post comment}}',
	'article-comments-cancel' => 'Cancel/stop editing an article comment.
{{Identical|Cancel}}',
	'article-comments-delete' => 'Click this button to delete the comment. It will take you to a page where you can confirm the deletion.
{{Identical|Delete}}',
	'article-comments-edit' => 'Click this button to edit the message.  A box will appear to with the message text for editing.
{{Identical|Edit}}',
	'article-comments-history' => '{{Identical|History}}',
	'article-comments-rc-blog-comments' => '{{Identical|Blog comment}}',
	'article-comments-toc-item' => '{{Identical|Comment}}',
	'article-comments-reply' => '{{Identical|Reply}}',
	'article-comments-next-page' => '{{Identical|Next}}',
	'article-comments-show-more' => 'Label for the button that shows more comments',
	'wikiamobile-article-comments-counter' => 'Number of comments + word Comments to display in WM page header',
	'wikiamobile-article-comments-header' => "The header of the Comments section shown in Wikia's mobile skin.
{{Identical|Comment}}",
	'wikiamobile-article-comments-more' => 'Label on a button to load next page of comments.
{{Identical|Load more}}',
	'wikiamobile-article-comments-prev' => 'Label on a button to load previous page of comments',
	'wikiamobile-article-comments-none' => 'Message displayed to user if there are no comments on a page after opening a section with comments',
	'wikiamobile-article-comments-view' => 'Message to open all replies to a comment. Parameters:
* $1 - the number of comments',
	'wikiamobile-article-comments-replies' => 'Message in Top Bar in a modal with all replies to comment.
{{Identical|Reply}}',
	'wikiamobile-article-comments-post-reply' => 'Label on a button to post a reply to comment',
	'wikiamobile-article-comments-post' => 'Label on a button to post a comment.
{{Identical|Post}}',
	'wikiamobile-article-comments-placeholder' => 'This is an input placeholder displayed when no text is in given input.
{{Identical|Post comment}}',
	'wikiamobile-article-comments-login-post' => 'Message shown to a user if he tries to post a comment on a wiki where login is obligatory to edit.
This is shown in small pop up message in red.',
	'wikiamobile-article-comments-post-fail' => 'Message shown to a user when saving his comment failed.
This is shown in small pop up message in red.',
	'enotif_body_article_comment' => '{{doc-singularthey}}
This is an email sent to inform a user that a page they are following has a new comment posted.',
);
