<?php get_header(); ?>

<main class="g-section-inner">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</header>

			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
		</article>
	<?php endwhile; 
		the_posts_navigation();
	else : ?>
		<p><?php _e('No se encontraron entradas.', 'gtheme'); ?></p>
	<?php endif; ?>
</main>

<?php get_footer(); ?>