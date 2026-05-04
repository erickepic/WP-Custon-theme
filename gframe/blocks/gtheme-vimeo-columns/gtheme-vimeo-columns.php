<?php

$id = $block['id'];
$classes = '';
if (!empty($block['className'])):
    $classes .= sprintf(' %s', $block['className']);
endif;

$main_title = get_field('main_title');
$vimeo_link = get_field('vimeo_link');
$title_left = get_field('title_left');
$title_right = get_field('title_right');
$text_left = get_field('text_left');
$text_right = get_field('text_right');

// Dynamic video ID or default
if (empty($vimeo_link)) {
    $vimeo_link = "https://player.vimeo.com/video/968320825?h=cd320a8639";
}

preg_match('/\/video\/(\d+)/', $vimeo_link, $matches);
if (isset($matches[1])) {
    $video_id = $matches[1];
} else {
    $video_id = '968320825'; // Fallback
}

?>

<div id="<?php echo esc_attr($id); ?>" class="gtheme-vimeo-columns <?php echo esc_attr($classes); ?>">
    <div class="title-area">
        <h2><?php echo $main_title; ?></h2>
    </div>
    <div class="video-area">
        <iframe src="https://player.vimeo.com/video/<?php echo $video_id; ?>?h=cd320a8639" frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div class="text-area">
        <div class="column">
            <div class="title">
                <h3><?php echo $title_left; ?></h3>
            </div>
            <div class="description">
                <p><?php echo $text_left; ?></p>
            </div>
        </div>
        <div class="column">
            <div class="title">
                <h3><?php echo $title_right; ?></h3>
            </div>
            <div class="description">
                <p><?php echo $text_right; ?></p>
            </div>
        </div>
    </div>
</div>
