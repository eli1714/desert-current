<?php
/**
 * Single event content.
 *
 * @package DesertCurrent
 */

$event = desert_current_get_event_details();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry entry-event' ); ?>>
	<header class="entry-header">
		<p class="entry-kicker"><?php esc_html_e( 'Community Event', 'desert-current' ); ?></p>
		<div class="entry-meta">
			<?php if ( $event['formatted'] ) : ?>
				<span><?php echo esc_html( $event['formatted'] ); ?></span>
			<?php endif; ?>

			<?php if ( $event['formatted'] && $event['location'] ) : ?>
				<span aria-hidden="true">•</span>
			<?php endif; ?>

			<?php if ( $event['location'] ) : ?>
				<span><?php echo esc_html( $event['location'] ); ?></span>
			<?php endif; ?>
		</div>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-image">
			<?php the_post_thumbnail( 'large' ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>
