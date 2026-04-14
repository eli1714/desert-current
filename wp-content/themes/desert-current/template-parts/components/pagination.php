<?php
/**
 * Pagination for archive-style templates.
 *
 * @package DesertCurrent
 */

$pagination = get_the_posts_pagination(
	array(
		'mid_size'  => 1,
		'prev_text' => __( 'Previous', 'desert-current' ),
		'next_text' => __( 'Next', 'desert-current' ),
	)
);

if ( ! $pagination ) {
	return;
}
?>

<nav class="pagination-nav" aria-label="<?php esc_attr_e( 'Posts', 'desert-current' ); ?>">
	<?php echo wp_kses_post( $pagination ); ?>
</nav>
