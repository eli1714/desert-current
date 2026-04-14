<?php
/**
 * Event card used for the event archive.
 *
 * @package DesertCurrent
 */

$event = desert_current_get_event_details();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'event-listing-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="event-listing-card__image-link" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'large', array( 'class' => 'event-listing-card__image' ) ); ?>
		</a>
	<?php endif; ?>

	<div class="event-listing-card__content">
		<?php if ( $event['formatted'] ) : ?>
			<p class="event-listing-card__meta"><?php echo esc_html( $event['formatted'] ); ?></p>
		<?php endif; ?>

		<h2 class="event-listing-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>

		<?php if ( $event['location'] ) : ?>
			<p class="event-listing-card__location"><?php echo esc_html( $event['location'] ); ?></p>
		<?php endif; ?>

		<div class="event-listing-card__excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>
