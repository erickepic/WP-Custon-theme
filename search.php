<?php get_header(); ?>

<main class="g-section-inner">
	<header class="search-header">
		<h1><?php printf(__('Resultados de búsqueda para: %s', 'gtheme'), '<span>' . get_search_query() . '</span>'); ?></h1>
	</header>

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
		<p><?php _e('Lo sentimos, pero nada coincidió con tus términos de búsqueda. Por favor, intenta de nuevo con algunas palabras clave diferentes.', 'gtheme'); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
