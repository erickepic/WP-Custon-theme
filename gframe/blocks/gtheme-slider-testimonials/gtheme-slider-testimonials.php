<?php

$id = $block['id'];
$classes = '';
if (!empty($block['className'])):
    $classes .= sprintf(' %s', $block['className']);
endif;

$style = get_field('slider_appearance');
$style_class = "";
$slidesPerView = 1; 
$spaceBetween = 20; 

$block_uri = get_template_directory_uri() . '/gframe/blocks/gtheme-slider-testimonials/';

$breakpoints = array(
    768 => array(
        'slidesPerView' => 3,
        'spaceBetween' => 32
    )
);

switch ($style) {
    case 'uno':
        $style_class = "swiper-container-testimonials";
        $slidesPerView = 1;
        $spaceBetween = 20;
        $breakpoints = array(
            768 => array(
                'slidesPerView' => 3,
                'spaceBetween' => 32
            ),
        );
        wp_register_style('testimonials', $block_uri . 'testimonials.css', false, rand(1, 1000));
        wp_enqueue_style('testimonials');
        wp_register_style('testimonials_generals', $block_uri . 'testimonials_generals.css', false, rand(1, 1000));
        wp_enqueue_style('testimonials_generals');
        break;
    case 'dos':
        $style_class = "swiper-container-testimonials2";
        $slidesPerView = 1;
        $spaceBetween = 20;
        $breakpoints = array(
            768 => array(
                'slidesPerView' => 3,
                'spaceBetween' => 64
            ),
        );
        wp_register_style('testimonials_cultura', $block_uri . 'testimonials_cultura.css', false, rand(1, 1000));
        wp_enqueue_style('testimonials_cultura');
        wp_register_style('testimonials_generals', $block_uri . 'testimonials_generals.css', false, rand(1, 1000));
        wp_enqueue_style('testimonials_generals');
        break;
    case 'tres':
        $style_class = "swiper-container-testimonials3";
        $slidesPerView = 1;
        $spaceBetween = 20;
        $breakpoints = array(
            768 => array(
                'slidesPerView' => 1,
                'spaceBetween' => 20
            ),
        );
        wp_register_style('testimonials_recuerdos', $block_uri . 'testimonials_recuerdos.css', false, rand(1, 1000));
        wp_enqueue_style('testimonials_recuerdos');
        wp_register_style('testimonials_generals', $block_uri . 'testimonials_generals.css', false, rand(1, 1000));
        wp_enqueue_style('testimonials_generals');
        break;
}

$breakpoints_json = json_encode($breakpoints);

if (have_rows('testimonials_repeater')):
    $slidesHTML = "";
    while (have_rows('testimonials_repeater')):
        the_row();
        $client_image = get_sub_field('client_image');
        $client_image_url = "";
        $client_image_alt = "";
        if ($client_image) {
            $client_image_url = $client_image['url'];
            $client_image_alt = $client_image['alt'];
        }
        $client_name = get_sub_field('client_name');
        $client_company = get_sub_field('client_company');
        $button = get_sub_field('button');

        $company_html = (!empty($client_company)) ? '<div class="location-area"><p>' . $client_company . '</p></div>' : "";
        $name_html = (!empty($client_name)) ? '<div class="name-area"><h3>' . $client_name . '</h3></div>' : "";
        
        $button_html = ""; 
        if (!empty($button)):
            $btn_url = $button['url'];
            $btn_title = $button['title'];
            $btn_target = !empty($button['target']) ? $button['target'] : '_self';
            $button_html = '<div class="button-area"><a class="btn-primary" href="' . $btn_url . '" target="' . $btn_target . '">' . $btn_title . '</a></div>';
        endif;

        $testimonial_text = get_sub_field('testimonial_text');

        $slidesHTML .= '<div class="swiper-slide"> 
                            <div class="slide-content">
                                <div class="box-area">
                                    <div class="testimonial-head-area">
                                        <div class="img-area">
                                            <img src="' . $client_image_url . '" alt="' . $client_image_alt . '">
                                        </div>
                                        <div class="client-area">
                                            ' . $name_html . '
                                            ' . $company_html . '
                                        </div>
                                    </div>
                                    <div class="testimonial-text-area">
                                        <p>' . $testimonial_text . '</p>
                                    </div>
                                    ' . $button_html . '
                                </div>
                            </div>
                        </div>';
    endwhile;
else:
    echo "<p>No items found</p>";
endif;

$container_id = "swiper-" . $id;
?>

<div id="<?php echo esc_attr($id); ?>" class="gtheme-slider-testimonials <?php echo esc_attr($classes); ?>">
    <div class="<?php echo $style_class; ?> swiper-container-<?php echo $id; ?>">
        <div class="swiper-wrapper">
            <?php echo $slidesHTML; ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next">
            <div class="img-area">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/arrow-left-blue.png" alt="Next">
            </div>
        </div>
        <div class="swiper-button-prev">
            <div class="img-area">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/arrow-left-blue.png" alt="Previous">
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var swiper = new Swiper('.swiper-container-<?php echo $id; ?>', {
        slidesPerView: <?php echo $slidesPerView; ?>,
        spaceBetween: <?php echo $spaceBetween; ?>,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        watchOverflow: true,
        breakpoints: <?php echo $breakpoints_json; ?>,
    });
});
</script>
