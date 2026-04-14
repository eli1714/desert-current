<?php
/**
 * Theme setup and asset loading for Desert Current.
 *
 * @package DesertCurrent
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function desert_current_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'search-form',
			'script',
			'style',
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'desert-current' ),
			'footer'  => __( 'Footer Menu', 'desert-current' ),
		)
	);
}
add_action( 'after_setup_theme', 'desert_current_setup' );

function desert_current_enqueue_assets() {
	$theme = wp_get_theme();

	wp_enqueue_style(
		'desert-current-styles',
		get_template_directory_uri() . '/assets/css/site.css',
		array(),
		$theme->get( 'Version' )
	);

	wp_enqueue_script(
		'desert-current-scripts',
		get_template_directory_uri() . '/assets/js/site.js',
		array(),
		$theme->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'desert_current_enqueue_assets' );

function desert_current_menu_fallback() {
	$posts_page_id  = (int) get_option( 'page_for_posts' );
	$stories_url    = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/' );
	$stories_label  = $posts_page_id ? get_the_title( $posts_page_id ) : __( 'Stories', 'desert-current' );

	echo '<ul class="menu-list">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'desert-current' ) . '</a></li>';
	echo '<li><a href="' . esc_url( $stories_url ) . '">' . esc_html( $stories_label ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/about/' ) ) . '">' . esc_html__( 'About', 'desert-current' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">' . esc_html__( 'Contact', 'desert-current' ) . '</a></li>';
	echo '</ul>';
}

function desert_current_footer_menu_fallback() {
	echo '<ul class="footer-menu">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'desert-current' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/about/' ) ) . '">' . esc_html__( 'About', 'desert-current' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">' . esc_html__( 'Contact', 'desert-current' ) . '</a></li>';
	echo '</ul>';
}
