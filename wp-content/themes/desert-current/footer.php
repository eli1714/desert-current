<?php
/**
 * Site footer.
 *
 * @package DesertCurrent
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$footer_title          = get_field( 'footer_title', 'option' );
$footer_description    = get_field( 'footer_description', 'option' );
$footer_button_label   = get_field( 'footer_button_label', 'option' );
$footer_button_url     = get_field( 'footer_button_url', 'option' );
$footer_bottom_message = get_field( 'footer_bottom_message', 'option' );
?>

<footer class="site-footer">
	<div class="container site-footer__inner">
		<div class="site-footer__brand">
			<p class="site-footer__eyebrow"><?php esc_html_e( 'Desert Current', 'desert-current' ); ?></p>
			<?php if ( $footer_title ) : ?>
				<h2 class="site-footer__title"><?php echo esc_html( $footer_title ); ?></h2>
			<?php endif; ?>
			<?php if ( $footer_description ) : ?>
				<div class="site-footer__text"><?php echo wp_kses_post( $footer_description ); ?></div>
			<?php endif; ?>
			<?php if ( $footer_button_label && $footer_button_url ) : ?>
				<a class="button-link" href="<?php echo esc_url( $footer_button_url ); ?>"><?php echo esc_html( $footer_button_label ); ?></a>
			<?php endif; ?>
		</div>

		<div class="site-footer__column">
			<h3 class="site-footer__heading"><?php esc_html_e( 'Coverage', 'desert-current' ); ?></h3>
			<ul class="site-footer__list">
				<li><?php esc_html_e( 'Local news', 'desert-current' ); ?></li>
				<li><?php esc_html_e( 'Arts and culture', 'desert-current' ); ?></li>
				<li><?php esc_html_e( 'Community events', 'desert-current' ); ?></li>
				<li><?php esc_html_e( 'Neighborhood life', 'desert-current' ); ?></li>
			</ul>
		</div>

		<div class="site-footer__column">
			<h3 class="site-footer__heading"><?php esc_html_e( 'Navigate', 'desert-current' ); ?></h3>
			<nav aria-label="<?php esc_attr_e( 'Footer menu', 'desert-current' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'footer-menu',
						'fallback_cb'    => 'desert_current_footer_menu_fallback',
					)
				);
				?>
			</nav>
		</div>
	</div>

	<div class="site-footer__bottom">
		<div class="container site-footer__bottom-inner">
			<p class="site-footer__meta"><?php echo esc_html( '© ' . wp_date( 'Y' ) . ' ' . get_bloginfo( 'name' ) . '.' ); ?></p>
			<?php if ( $footer_bottom_message ) : ?>
				<p class="site-footer__meta"><?php echo esc_html( $footer_bottom_message ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
