<?php
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if (have_comments()) : ?>
		<h2 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ('1' === $comments_number) {
				printf(_x('Un comentario en &ldquo;%s&rdquo;', 'comments title', 'gtheme'), get_the_title());
			} else {
				printf(_x('%1$s comentarios en &ldquo;%2$s&rdquo;', 'comments title', 'gtheme'), number_format_i18n($comments_number), get_the_title());
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(array(
				'style'      => 'ol',
				'short_ping' => true,
			));
			?>
		</ol>

		<?php the_comments_navigation(); ?>

	<?php endif; ?>

	<?php
	if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
	?>
		<p class="no-comments"><?php _e('Los comentarios están cerrados.', 'gtheme'); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>
</div>
