<?php
/**
 * Header template
 */
$gtheme_logo = get_field("gtheme_logo", "option");
$gtheme_layout = get_field("gtheme_layout", "option");

$header_width = ($gtheme_layout && $gtheme_layout['header_max_width']) ? $gtheme_layout['header_max_width'] : 1200;
$content_width = ($gtheme_layout && $gtheme_layout['content_max_width']) ? $gtheme_layout['content_max_width'] : 1140;
$footer_width = ($gtheme_layout && $gtheme_layout['footer_max_width']) ? $gtheme_layout['footer_max_width'] : 1200;

$theme_uri = get_template_directory_uri();
?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(''); ?></title>
	
    <!-- Favicon -->
    <?php if ( ! has_site_icon() ) : ?>
        <link rel="shortcut icon" href="<?php echo $theme_uri; ?>/assets/img/favicon.png">
        <link rel="apple-touch-icon" href="<?php echo $theme_uri; ?>/assets/img/favicon.png">
    <?php endif; ?>

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo('description'); ?>">

	<style>
		.gdev-header-container { max-width: <?php echo $header_width; ?>px; }
		.gdev-footer-container { max-width: <?php echo $footer_width; ?>px; }
		.gdev-container, .g-section-inner { max-width: <?php echo $content_width; ?>px; }
	</style>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header id="gdev-header">
		<div class="gdev-header-container">
			<div class="gdev-logo">
				<a href="<?php echo esc_url(home_url('/')); ?>" aria-label="Home">
                    <?php if ($gtheme_logo): ?>
                        <img src="<?php echo esc_url($gtheme_logo['url']); ?>" alt="<?php echo esc_attr($gtheme_logo['alt']); ?>">
                    <?php else: ?>
                        <img src="<?php echo $theme_uri; ?>/assets/img/site-logo.png" alt="<?php bloginfo('name'); ?>">
                    <?php endif; ?>
                </a>
			</div>
			<button class="menu-toggle" aria-controls="mobile-menu" aria-expanded="false">☰</button>

			<nav>
				<?php
				wp_nav_menu(array(
					'theme_location' => 'header-menu',
					'menu_class' => 'menu',
					'container' => 'div',
					'container_class' => 'menu-container',
                    'fallback_cb' => false
				));

				wp_nav_menu(array(
					'theme_location' => 'mobile-menu',
					'menu_class' => 'mobile-menu',
					'container' => 'div',
					'container_class' => 'mobile-menu-container',
                    'fallback_cb' => false
				));
				?>
			</nav>
		</div>
	</header>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			var toggleButton = document.querySelector('.menu-toggle');
			var mobileMenu = document.querySelector('.mobile-menu-container');
			var header = document.querySelector('#gdev-header');

			if (toggleButton && mobileMenu) {
                toggleButton.addEventListener('click', function () {
                    mobileMenu.classList.toggle('active');
                    if (mobileMenu.classList.contains('active')) {
                        header.style.height = '100vh';
                    } else {
                        header.style.height = '';
                    }
                });
            }

			// Submenu togglers handling
			const submenuTogglers = document.querySelectorAll('.menu-item-has-children > a');
			submenuTogglers.forEach(function (toggler) {
				toggler.addEventListener('click', function (event) {
					if (window.innerWidth <= 768) {
                        event.preventDefault();
                        const submenu = this.nextElementSibling;
                        if (submenu) {
                            submenu.classList.toggle('active');
                        }
                    }
				});
			});
		});
	</script>