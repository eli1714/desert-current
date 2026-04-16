<?php
/**
 * Site header.
 *
 * @package DesertCurrent
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$header_edition = get_field( 'header_edition_label', 'option' );
$brand_eyebrow  = get_field( 'brand_eyebrow', 'option' );
$tip_link_label = get_field( 'tip_link_label', 'option' );
$tip_link_url   = get_field( 'tip_link_url', 'option' );
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
			<?php if ( $header_edition ) : ?>
				<p class="site-header__edition"><?php echo esc_html( $header_edition ); ?></p>
			<?php endif; ?>
			<p class="site-header__date"><?php echo esc_html( wp_date( 'l, F j, Y' ) ); ?></p>
		</div>
	</div>

	<div class="container site-header__inner">
		<div class="site-branding">
			<?php if ( $brand_eyebrow ) : ?>
				<p class="site-branding__eyebrow"><?php echo esc_html( $brand_eyebrow ); ?></p>
			<?php endif; ?>
			<p class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span class="site-title__main"><?php bloginfo( 'name' ); ?></span>
				</a>
			</p>
			<p class="site-tagline"><?php bloginfo( 'description' ); ?></p>
		</div>
	</div>

	<div class="site-header__nav-wrap">
		<div class="container">
			<div class="site-header__nav-bar">
				<button class="site-header__menu-toggle" type="button" aria-expanded="false" aria-controls="primary-nav-panel">
					<span class="site-header__menu-toggle-label"><?php esc_html_e( 'Menu', 'desert-current' ); ?></span>
					<span class="site-header__menu-toggle-icon" aria-hidden="true"></span>
				</button>
			</div>

			<div class="site-header__nav-panel" id="primary-nav-panel">
				<div class="site-header__nav-inner">
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

					<?php if ( $tip_link_label && $tip_link_url ) : ?>
						<a class="site-header__cta" href="<?php echo esc_url( $tip_link_url ); ?>">
							<?php echo esc_html( $tip_link_label ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</header>
