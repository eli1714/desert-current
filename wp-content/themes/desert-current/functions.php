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
		'desert-current-fonts',
		'https://fonts.googleapis.com/css2?family=Newsreader:opsz,wght@6..72,400;6..72,500;6..72,600;6..72,700&family=Source+Sans+3:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'desert-current-styles',
		get_template_directory_uri() . '/assets/css/site.css',
		array( 'desert-current-fonts' ),
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

function desert_current_register_event_post_type() {
	$labels = array(
		'name'               => __( 'Events', 'desert-current' ),
		'singular_name'      => __( 'Event', 'desert-current' ),
		'menu_name'          => __( 'Events', 'desert-current' ),
		'name_admin_bar'     => __( 'Event', 'desert-current' ),
		'add_new'            => __( 'Add Event', 'desert-current' ),
		'add_new_item'       => __( 'Add New Event', 'desert-current' ),
		'edit_item'          => __( 'Edit Event', 'desert-current' ),
		'new_item'           => __( 'New Event', 'desert-current' ),
		'view_item'          => __( 'View Event', 'desert-current' ),
		'view_items'         => __( 'View Events', 'desert-current' ),
		'search_items'       => __( 'Search Events', 'desert-current' ),
		'not_found'          => __( 'No events found.', 'desert-current' ),
		'not_found_in_trash' => __( 'No events found in Trash.', 'desert-current' ),
		'all_items'          => __( 'All Events', 'desert-current' ),
		'archives'           => __( 'Event Archives', 'desert-current' ),
	);

	register_post_type(
		'event',
		array(
			'labels'       => $labels,
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => 'events' ),
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-calendar-alt',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
		)
	);
}
add_action( 'init', 'desert_current_register_event_post_type' );

function desert_current_add_event_details_meta_box() {
	add_meta_box(
		'desert-current-event-details',
		__( 'Event Details', 'desert-current' ),
		'desert_current_render_event_details_meta_box',
		'event',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'desert_current_add_event_details_meta_box' );

function desert_current_render_event_details_meta_box( $post ) {
	$event_date = get_post_meta( $post->ID, '_desert_current_event_date', true );
	$location   = get_post_meta( $post->ID, '_desert_current_event_location', true );

	wp_nonce_field( 'desert_current_save_event_details', 'desert_current_event_details_nonce' );
	?>
	<p>
		<label for="desert-current-event-date"><strong><?php esc_html_e( 'Event date', 'desert-current' ); ?></strong></label>
		<br>
		<input id="desert-current-event-date" name="desert_current_event_date" type="date" value="<?php echo esc_attr( $event_date ); ?>">
	</p>

	<p>
		<label for="desert-current-event-location"><strong><?php esc_html_e( 'Location', 'desert-current' ); ?></strong></label>
		<br>
		<input id="desert-current-event-location" name="desert_current_event_location" type="text" class="widefat" value="<?php echo esc_attr( $location ); ?>">
	</p>
	<?php
}

function desert_current_save_event_details( $post_id ) {
	if ( ! isset( $_POST['desert_current_event_details_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['desert_current_event_details_nonce'] ) ), 'desert_current_save_event_details' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['desert_current_event_date'] ) ) {
		update_post_meta(
			$post_id,
			'_desert_current_event_date',
			sanitize_text_field( wp_unslash( $_POST['desert_current_event_date'] ) )
		);
	}

	if ( isset( $_POST['desert_current_event_location'] ) ) {
		update_post_meta(
			$post_id,
			'_desert_current_event_location',
			sanitize_text_field( wp_unslash( $_POST['desert_current_event_location'] ) )
		);
	}
}
add_action( 'save_post_event', 'desert_current_save_event_details' );

function desert_current_sort_event_archive( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_post_type_archive( 'event' ) ) {
		return;
	}

	$query->set( 'meta_key', '_desert_current_event_date' );
	$query->set( 'orderby', 'meta_value' );
	$query->set( 'order', 'ASC' );
}
add_action( 'pre_get_posts', 'desert_current_sort_event_archive' );

function desert_current_get_event_date_object( $event_date ) {
	if ( ! $event_date ) {
		return null;
	}

	$timezone = wp_timezone();
	$date     = DateTimeImmutable::createFromFormat( 'Y-m-d', $event_date, $timezone );

	if ( ! $date ) {
		return null;
	}

	return $date->setTime( 12, 0, 0 );
}

function desert_current_format_event_date( $event_date, $format = 'F j, Y' ) {
	$date = desert_current_get_event_date_object( $event_date );

	if ( ! $date ) {
		return '';
	}

	return $date->format( $format );
}

function desert_current_get_event_details( $post_id = 0 ) {
	$post_id    = $post_id ? $post_id : get_the_ID();
	$event_date = get_post_meta( $post_id, '_desert_current_event_date', true );
	$location   = get_post_meta( $post_id, '_desert_current_event_location', true );

	return array(
		'date'      => $event_date,
		'formatted' => desert_current_format_event_date( $event_date ),
		'location'  => $location,
	);
}
