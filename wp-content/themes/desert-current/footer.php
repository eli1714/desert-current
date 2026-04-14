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
		<div class="site-footer__brand">
			<p class="site-footer__eyebrow"><?php esc_html_e( 'Desert Current', 'desert-current' ); ?></p>
			<h2 class="site-footer__title"><?php esc_html_e( 'Local reporting rooted in place.', 'desert-current' ); ?></h2>
			<p class="site-footer__text"><?php esc_html_e( 'Stories about public life, culture, small businesses, and the everyday changes shaping a desert community.', 'desert-current' ); ?></p>
			<a class="button-link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Get in touch', 'desert-current' ); ?></a>
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
			<p class="site-footer__meta"><?php esc_html_e( 'Story tips, event listings, and community updates are always welcome.', 'desert-current' ); ?></p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
