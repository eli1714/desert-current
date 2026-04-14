<?php
/**
 * Story card used for archives and homepage sections.
 *
 * @package DesertCurrent
 */

$category_list = get_the_category_list( ', ' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'story-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="story-card__image-link" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'large', array( 'class' => 'story-card__image' ) ); ?>
		</a>
	<?php endif; ?>

	<div class="story-card__content">
		<div class="story-card__meta">
			<?php if ( $category_list ) : ?>
				<span class="story-card__category"><?php echo wp_kses_post( $category_list ); ?></span>
			<?php endif; ?>
			<span class="story-card__date"><?php echo esc_html( get_the_date() ); ?></span>
		</div>
		<h3 class="story-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="story-card__excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>
