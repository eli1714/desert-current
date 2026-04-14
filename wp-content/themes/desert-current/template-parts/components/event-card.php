<?php
/**
 * Placeholder event card for the homepage.
 *
 * @package DesertCurrent
 */

$month       = $args['month'] ?? '';
$day         = $args['day'] ?? '';
$title       = $args['title'] ?? '';
$schedule    = $args['schedule'] ?? '';
$location    = $args['location'] ?? '';
$description = $args['description'] ?? '';
$link_label  = $args['link_label'] ?? '';
$link_url    = $args['link_url'] ?? '';
?>

<article class="event-card">
	<div class="event-card__date" aria-hidden="true">
		<span class="event-card__month"><?php echo esc_html( $month ); ?></span>
		<span class="event-card__day"><?php echo esc_html( $day ); ?></span>
	</div>

	<div class="event-card__content">
		<p class="event-card__meta"><?php echo esc_html( $schedule ); ?></p>
		<h3 class="event-card__title">
			<?php if ( $link_label && $link_url ) : ?>
				<a class="event-card__title-link" href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $title ); ?></a>
			<?php else : ?>
				<?php echo esc_html( $title ); ?>
			<?php endif; ?>
		</h3>
		<p class="event-card__location"><?php echo esc_html( $location ); ?></p>
		<p class="event-card__description"><?php echo esc_html( $description ); ?></p>

		<?php if ( $link_label && $link_url ) : ?>
			<a class="text-link" href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_label ); ?></a>
		<?php endif; ?>
	</div>
</article>
