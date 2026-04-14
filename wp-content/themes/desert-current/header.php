<?php
/**
 * Site header.
 *
 * @package DesertCurrent
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main-content"><?php esc_html_e( 'Skip to content', 'desert-current' ); ?></a>

<header class="site-header">
	<div class="site-header__topbar">
		<div class="container site-header__topbar-inner">
			<p class="site-header__edition"><?php esc_html_e( 'Desert Southwest Edition', 'desert-current' ); ?></p>
			<p class="site-header__date"><?php echo esc_html( wp_date( 'l, F j, Y' ) ); ?></p>
		</div>
	</div>

	<div class="container site-header__inner">
		<div class="site-branding">
			<p class="site-branding__eyebrow"><?php esc_html_e( 'Independent Local Media', 'desert-current' ); ?></p>
			<p class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span class="site-title__main"><?php bloginfo( 'name' ); ?></span>
				</a>
			</p>
			<p class="site-tagline"><?php bloginfo( 'description' ); ?></p>
		</div>
	</div>

	<div class="site-header__nav-wrap">
		<div class="container site-header__nav-inner">
			<nav class="primary-nav" aria-label="<?php esc_attr_e( 'Primary menu', 'desert-current' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'menu-list',
						'fallback_cb'    => 'desert_current_menu_fallback',
					)
				);
				?>
			</nav>

			<a class="site-header__cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
				<?php esc_html_e( 'Send a tip', 'desert-current' ); ?>
			</a>
		</div>
	</div>
</header>
