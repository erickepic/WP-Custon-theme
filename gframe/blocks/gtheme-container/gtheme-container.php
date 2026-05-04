<?php
$classes = '';
if (!empty($block['className'])) {
    $classes .= sprintf(' %s', $block['className']);
}
if (!empty($block['align'])) {
    $classes .= sprintf(' align%s', $block['align']);
}

$contid = get_field('container_id');
$contag = get_field('container_tag');
$controle = get_field('container_role');

$id_attr = ($contid) ? " id='" . sanitize_title($contid) . "'" : '';
$classes_attr = ($classes) ? " class='$classes'" : '';
$contag = ($contag) ? $contag : 'div';
$controle_attr = ($controle && $controle != '-') ? " role='$controle'" : '';
?>

<<?php echo esc_attr($contag); ?><?php echo ($id_attr . $classes_attr . $controle_attr); ?>>
    <InnerBlocks />
</<?php echo esc_attr($contag); ?>>
