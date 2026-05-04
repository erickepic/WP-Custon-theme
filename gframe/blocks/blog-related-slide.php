<div class="blog-posts-list">
    <?php
    // Obtener las entradas fijas
    $sticky = get_option('sticky_posts');

    // Definir los argumentos para WP_Query para obtener todas las entradas excepto las fijas
    $args = array(
        'post_type' => 'post',         // Obtener solo publicaciones de tipo 'post'
        'posts_per_page' => -1,        // Mostrar todas las entradas
    );
    wp_register_style('relatedblog-list', get_template_directory_uri() . '/css/blockstyles/relatedblog-list.css', false, rand(1, 1000));
    wp_enqueue_style('relatedblog-list');

    // La consulta de WP_Query
    $query = new WP_Query($args);

    // Comienza el loop
    if ($query->have_posts()) : ?>
        <div class="swiper-container-relatedblog">
            <div class="swiper-wrapper">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="swiper-slide">
                        <div class="slide-content">
                            <div class="box-area">
                                <div class="entry-head-area">
                                    <div class="infos-slideup img-area">
                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="post-thumbnail">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('full'); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="infos-slideup post-date">
                                        <?php echo get_the_date(); ?>
                                    </div>
                                    <div class="infos-slideup title-area">
                                        <?php the_title(); ?>
                                    </div>
                                </div>
                                <div class="infos-slideup entry-text-area">
                                    <p><?php the_excerpt(); ?></p>
                                </div>
                                <div class="infos-slideup button-area">
                                    <a href="<?php the_permalink(); ?>" target="_self">Leer más</a>
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
    var swiper = new Swiper('.swiper-container-relatedblog', {
        slidesPerView: 1,  // Muestra 3 slides a la vez
        spaceBetween: 20,  // Espacio entre slides
        loop: true,        // Habilitar el loop infinito
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            // Ajustes responsivos para pantallas más pequeñas
            768: {
                slidesPerView: 2,  // En pantallas pequeñas, muestra solo 1
                spaceBetween: 40
            },
            1024: {
                slidesPerView: 2,  // En pantallas medianas, muestra 2
                spaceBetween: 40
            },
            1440: {
                slidesPerView: 3,  // En pantallas grandes, muestra 3
                spaceBetween: 30
            }
        }
    });
});
</script>
