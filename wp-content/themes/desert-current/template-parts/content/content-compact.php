<?php
/**
 * Compact story item for stacked homepage lists.
 *
 * @package DesertCurrent
 */

$category_list = get_the_category_list( ', ' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'story-compact' ); ?>>
	<div class="story-compact__meta">
		<?php if ( $category_list ) : ?>
			<span class="story-compact__category"><?php echo wp_kses_post( $category_list ); ?></span>
		<?php endif; ?>
		<span class="story-compact__date"><?php echo esc_html( get_the_date() ); ?></span>
	</div>

	<h3 class="story-compact__title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h3>

	<div class="story-compact__excerpt">
		<?php the_excerpt(); ?>
	</div>
</article>
