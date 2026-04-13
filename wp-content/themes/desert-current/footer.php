<?php
/**
 * Site footer.
 *
 * @package DesertCurrent
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<footer class="site-footer">
	<div class="container site-footer__inner">
		<div>
			<p class="site-footer__title"><?php bloginfo( 'name' ); ?></p>
			<p class="site-footer__text"><?php esc_html_e( 'A local media and community publisher built as a custom WordPress portfolio project.', 'desert-current' ); ?></p>
		</div>

		<nav aria-label="<?php esc_attr_e( 'Footer menu', 'desert-current' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'footer-menu',
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

