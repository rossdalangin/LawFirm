<?php
/**
 * The template for displaying the footer
 *
 * @package Legacy_Pro_Max
 */

?>
	</div><!-- #content -->
	<footer id="colophon" class="site-footer">
		<div class="site-footer-inner">
            <div class="footer-widgets columns-<?php echo esc_attr(get_theme_mod('legacy_pro_max_footer_columns', 4)); ?>">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                <?php endif; ?>
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                <?php endif; ?>
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                <?php endif; ?>
                <?php if (is_active_sidebar('footer-4')) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer-4'); ?>
                    </div>
                <?php endif; ?>
            </div>
			<div class="site-info">
				&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
			</div><!-- .site-info -->
            <?php legacy_pro_max_attorney_advertising_notice(); ?>
		</div><!-- .site-footer-inner -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
