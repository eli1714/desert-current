<?php
/**
 * Story card used for archives and homepage sections.
 *
 * @package DesertCurrent
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'story-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="story-card__image-link" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'large', array( 'class' => 'story-card__image' ) ); ?>
		</a>
	<?php endif; ?>

	<div class="story-card__content">
		<p class="story-card__meta"><?php echo esc_html( get_the_date() ); ?></p>
		<h3 class="story-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="story-card__excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>

