<?php
/**
 * Featured story card for the homepage hero.
 *
 * @package DesertCurrent
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'featured-story' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="featured-story__image-link" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'large', array( 'class' => 'featured-story__image' ) ); ?>
		</a>
	<?php endif; ?>

	<div class="featured-story__content">
		<p class="featured-story__meta"><?php echo esc_html( get_the_date() ); ?></p>
		<h2 class="featured-story__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<div class="featured-story__excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>
