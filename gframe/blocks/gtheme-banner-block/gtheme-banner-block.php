<?php

$id = $block['id'];
$classes = '';
if (!empty($block['className'])):
    $classes .= sprintf(' %s', $block['className']);
endif;

$block_uri = get_template_directory_uri() . '/gframe/blocks/gtheme-banner-block/';

// Register animation style
wp_register_style('gtheme-banner-animations', $block_uri . 'gtheme-banner-animations.css', false, rand(1, 1000));
wp_enqueue_style('gtheme-banner-animations');

?>
<section class="gtheme-banner <?php echo esc_attr($classes); ?>" id="<?php echo esc_attr($id); ?>">
    <div class="container">
        <div class="gdev-row">
            <div class="gdev-text-column">
                <h1 class="h3"><?php _e('Welcome to Our Site', 'gtheme'); ?></h1>
                <h2><?php _e('We provide innovative solutions for your business.', 'gtheme'); ?></h2>
                <p><?php _e('More than 25 years of experience in the market.', 'gtheme'); ?></p>
                <div class="buttons-area">
                    <a href="#" class="btn-primary"><?php _e('Our Services', 'gtheme'); ?></a>
                    <a href="#" class="btn-secomdary"><?php _e('Contact Us', 'gtheme'); ?></a>
                </div>
            </div>
            <div class="gdev-img-column">
                <!-- Placeholder for banner images -->
                <div class="banner-placeholder-visual">
                    <div class="visual-circle"></div>
                </div>
            </div>
        </div>
    </div>
</section>
