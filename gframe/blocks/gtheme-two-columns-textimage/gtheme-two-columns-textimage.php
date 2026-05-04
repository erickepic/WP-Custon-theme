<?php

$id = $block['id'];
$classes = '';
if (!empty($block['className'])):
    $classes .= sprintf(' %s', $block['className']);
endif;

$estilo = get_field('block_appearance');
$animacion = get_field('enable_animation');
$animacionAttr = ($animacion) ? 'data-aos="fade-up"' : '';
$estilo_class = "";

$block_uri = get_template_directory_uri() . '/gframe/blocks/gtheme-two-columns-textimage/';

switch ($estilo) {
    case 'uno':
        $estilo_class = "services";
        wp_register_style('two-columns-textImage', $block_uri . 'two-columns-textImage.css', false, rand(1, 1000));
        wp_enqueue_style('two-columns-textImage');
        break;
    case 'dos':
        $estilo_class = "services2";
        wp_register_style('two-columns-service-card', $block_uri . 'two-columns-service-card.css', false, rand(1, 1000));
        wp_enqueue_style('two-columns-service-card');
        break;
    case 'tres':
        $estilo_class = "services3";
        wp_register_style('two-columns-agenda-items', $block_uri . 'two-columns-agenda-items.css', false, rand(1, 1000));
        wp_enqueue_style('two-columns-agenda-items');
        break;
    case 'cuatro':
        $estilo_class = "services4 gdev-row";
        wp_register_style('two-columns-empresa-directivos', $block_uri . 'two-columns-empresa-directivos.css', false, rand(1, 1000));
        wp_enqueue_style('two-columns-empresa-directivos');
        break;
    default:
        $estilo_class = "services";
        wp_register_style('two-columns-empresa-directivos', $block_uri . 'two-columns-empresa-directivos.css', false, rand(1, 1000));
        wp_enqueue_style('two-columns-empresa-directivos');
        break;
}

if (have_rows('rows')):
    $rowsHTML = "";
    while (have_rows('rows')):
        the_row();
        $title = get_sub_field('title');
        $main_content = get_sub_field('main_content');
        $link = get_sub_field('link');
        $link_html = ""; 
        if (!empty($link)):
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = !empty($link['target']) ? $link['target'] : '_self';
            $link_html = '<div class="button-area"><a class="btn-primary" href="' . $link_url . '" target="' . $link_target . '">' . $link_title . '</a></div>';
        endif;
        $image = get_sub_field('image');
        $image_url = "";
        $image_alt = "";
        if ($image):
            $image_url = $image['url'];
            $image_alt = $image['alt'];
        endif;
        $rowsHTML .= '<div class="service-area">
                        <div class="text-column">
                        <div class="service-title"><h3 ' . $animacionAttr . '>' . $title . '</h3></div>
                        <div class="service-description"><p ' . $animacionAttr . '>' . $main_content . '</p></div>
                        ' . $link_html . '
                    </div>
                    <div class="img-column">
                        <div class="img-area"><img ' . $animacionAttr . ' class="lazyload" data-src="' . $image_url . '" alt="' . $image_alt . '"></div>
                    </div>
                </div>';
    endwhile;

    echo "<div id='" . esc_attr($id) . "' class='$estilo_class " . esc_attr($classes) . "'>" . $rowsHTML . "</div>";

else:
    echo "<p> No content loaded.</p>";
endif;
?>
