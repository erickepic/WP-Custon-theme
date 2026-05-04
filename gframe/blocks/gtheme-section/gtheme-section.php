<?php

global $gwp_blockdeskstyles, $gwp_blockmobstyles;

$secid = get_field('section_id');
$blockid = ($secid) ? sanitize_title($secid) : $block["id"];

$classes = '';
if (!empty($block['className'])) {
    $classes .= sprintf(' %s', $block['className']);
}
if (!empty($block['align'])) {
    $classes .= sprintf(' align%s', $block['align']);
}

$bgcolor = get_field('bg_color');
$bgimage = get_field('bg_image');
$bgimagepos = get_field('bg_image_pos');
$paddingsides = get_field('padding_sides');
$paddingtop = get_field('padding_top');
$paddingbottom = get_field('padding_bottom');
$paddingtopmob = get_field('padding_top_mobile');
$paddingbottommob = get_field('padding_bottom_mobile');

$bgimagepos = ($bgimagepos) ? $bgimagepos : 'center center';

$classes .= ($paddingsides) ? ' padding-sides' : '';

$gwp_blockdeskstyles .= "#$blockid.g-section{";
$gwp_blockmobstyles .= "#$blockid.g-section{";

$gwp_blockdeskstyles .= ($bgcolor) ? "background-color: $bgcolor;" : "";

// Desktop Padding
if ($paddingtop) {
    $gwp_blockdeskstyles .= "padding-top: $paddingtop;";
}
if ($paddingbottom) {
    $gwp_blockdeskstyles .= "padding-bottom: $paddingbottom;";
}

// Mobile Padding
if ($paddingtopmob) {
    $gwp_blockmobstyles .= "padding-top: $paddingtopmob;";
}
if ($paddingbottommob) {
    $gwp_blockmobstyles .= "padding-bottom: $paddingbottommob;";
}

$gwp_blockdeskstyles .= "}";
$gwp_blockmobstyles .= "}";

if ($bgimage) {
    $bgstyle = "background-position: $bgimagepos;";
    $bgelem = "<div class='g-section-bg g-lazysectionimage' data-bg='" . $bgimage . "' style='$bgstyle' role='presentation'></div>";
    $bgelem .= "<div class='g-section-darkoverlay'></div>";
}
?>

<section id='<?php echo esc_attr($blockid); ?>' class="g-section <?php echo esc_attr($classes); ?>">
    <?php if ($bgimage) {
        echo ($bgelem);
    } ?>
    <div class="g-section-inner">
        <InnerBlocks />
    </div>
</section>
