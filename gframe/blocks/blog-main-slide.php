<div class="blog-posts-list">
    <?php
    // Definir los argumentos para WP_Query para obtener solo entradas fijas
    $sticky = get_option('sticky_posts');
    $args = array(
        'post_type' => 'post',         // Obtener solo publicaciones de tipo 'post'
        'posts_per_page' => -1,        // Mostrar todas las entradas fijas
        'post__in' => $sticky,         // Solo obtener las entradas fijas
        'ignore_sticky_posts' => 1     // Ignorar las entradas fijas para evitar duplicados
    );
    wp_register_style('mainblog-list', get_template_directory_uri() . '/css/blockstyles/mainblog-list.css', false, rand(1, 1000));
    wp_enqueue_style('mainblog-list');

    // La consulta de WP_Query
    $query = new WP_Query($args);

    // Comienza el loop
    if ($query->have_posts()) : ?>
        <div class="swiper-container-mainblog">
            <div class="swiper-wrapper">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="swiper-slide">
                        <div class="slide-content">
                            <div class="box-area">
                                <div class="infos-slideup testimonial-head-area">
                                    <div class="img-area">
                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="post-thumbnail">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('full'); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="infos-slideup client-area">
                                        <?php the_title(); ?>
                                    </div>
                                </div>
                                <div class="infos-slideup testimonial-text-area">
                                    <p><?php the_excerpt(); ?></p>
                                </div>
                                <div class="infos-slideup button-area">
                                    <a class="btn-primary" href="<?php the_permalink(); ?>" target="_self">Leer más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="infos-slideup swiper-pagination"></div>
            <div class="infos-slideup swiper-button-next">
                <div class="img-area">
                    <img src="/wp-content/themes/developtheme/assets/img/icons/arrow-left-blue.png" alt="Pasa al siguiente testimonio">
                </div>
            </div>
            <div class="infos-slideup swiper-button-prev">
                <div class="img-area">
                    <img src="/wp-content/themes/developtheme/assets/img/icons/arrow-left-blue.png" alt="Regresa al testimonio anterior">
                </div>
            </div>
        </div>

        <?php 
    else : ?>
        <p><?php _e('No posts found.'); ?></p>
    <?php endif;

    // Restablecer la consulta
    wp_reset_postdata(); ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper('.swiper-container-mainblog', {
        slidesPerView: 1,  // Muestra una slide a la vez
        spaceBetween: 30,  // Espacio entre slides
        loop: true,        // Habilitar el loop infinito
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
});

</script>