<div id="blog-comments" class="clearfix">
<?php
if ( $canEdit ) {
?>
	<div class="blog-comm-input reset clearfix">
	<form action="<?php echo $title->getFullURL() ?>" method="post" id="blog-comm-form-<?=$title->getArticleId()?>">
	<input type="hidden" name="wpArticleId" value="<?= $title->getArticleId() ?>" />
		<div class="blog-comm-input-text" style="margin-left: 5px">
			<textarea name="wpArticleComment" id="blog-comm-textfield-<?=$title->getArticleId()?>"><?=$comment?></textarea><br />
<? if (!$isReadOnly) { ?>
			<a href="<?php echo $title->getFullURL() ?>" name="wpBlogSubmit" id="blog-comm-submit-<?=$title->getArticleId()?>" class="wikia_button"><span><? echo wfMsg("blog-comment-post") ?></span></a>
<? } ?>
			<div class="right" style="font-style: italic;"><?php echo wfMsg("blog-comments-info") ?></div>
		</div>
	</form>
	</div>
<?php
} else {
	echo $comment;
}
?>
<!-- e:<?= __FILE__ ?> -->
