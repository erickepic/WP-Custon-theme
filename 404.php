<?php get_header(); ?>

<main class="g-section-inner error-404-wrapper">
	<section class="error-404 not-found container">
		<header class="page-header">
			<h1 class="h1"><?php _e('404', 'gtheme'); ?></h1>
            <h2 class="h3"><?php _e('Page Not Found', 'gtheme'); ?></h2>
		</header>

		<div class="page-content">
			<p><?php _e('It looks like nothing was found at this location. Maybe try a search?', 'gtheme'); ?></p>
			<?php get_search_form(); ?>
            <div class="back-home">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary"><?php _e('Back to Home', 'gtheme'); ?></a>
            </div>
		</div>
	</section>
</main>

<style>
    .error-404-wrapper {
        padding: 100px 0;
        text-align: center;
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .error-404 h1 {
        color: #234970;
        margin-bottom: 10px;
    }
    .error-404 .page-content {
        margin-top: 30px;
    }
    .back-home {
        margin-top: 40px;
    }
</style>

<?php get_footer(); ?>
