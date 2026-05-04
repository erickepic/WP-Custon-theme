<footer id="gdev-footer">
    <div class="gdev-footer-container">
        <div class="footer-columns">
            <?php dynamic_sidebar( 'Footer 1' ); ?>
            <?php dynamic_sidebar( 'Footer 2' ); ?>
            <?php dynamic_sidebar( 'Footer 3' ); ?>
            <?php dynamic_sidebar( 'Footer 4' ); ?>
        </div>
        
        <div class="footer-bottom">
            <div class="copy-area">
                <p>©<?php echo date('Y'); ?> <?php echo get_field('gtheme_copyright', 'option') ?: 'My Company. All rights reserved.'; ?></p>
            </div>
            <div class="links-area">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'container' => false,
                    'menu_class' => 'footer-links',
                    'fallback_cb' => false,
                ));
                ?>
            </div>
        </div>
    </div>
</footer>

<?php if (get_field('gtheme_show_modal', 'option')): ?>
    <div id="gtheme-welcome-modal" class="modal">
        <div class="modal-content">
            <div class="close-area-icon">
                <button id="closeModalIcon" class="close-btn" aria-label="Close">×</button>
            </div>
            
            <div class="modal-body">
                <?php if ($logo = get_field('gtheme_logo', 'option')): ?>
                    <div class="logo-area">
                        <img src="<?php echo $logo['url']; ?>" alt="Logo">
                    </div>
                <?php else: ?>
                    <div class="logo-area">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/site-logo.png" alt="Logo">
                    </div>
                <?php endif; ?>

                <div class="title-area">
                    <h2 class="h1"><?php the_field('gtheme_modal_title', 'option'); ?></h2>
                </div>
                
                <div class="description-area">
                    <p><?php the_field('gtheme_modal_text', 'option'); ?></p>
                </div>
            </div>
            
            <div class="modal-footer">
                <button class="btn-primary" id="confirmCloseBtn"><?php the_field('gtheme_modal_btn_text', 'option'); ?></button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('gtheme-welcome-modal');
            var closeBtn = document.getElementById('confirmCloseBtn');
            var closeIcon = document.getElementById('closeModalIcon');

            function closeModal() {
                modal.style.display = 'none';
            }

            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (closeIcon) closeIcon.addEventListener('click', closeModal);
        });
    </script>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
