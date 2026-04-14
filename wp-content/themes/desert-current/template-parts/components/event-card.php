<?php
/**
 * Event card for the homepage.
 *
 * @package DesertCurrent
 */

$event = array();

if ( ! empty( $args ) ) {
	$event = $args;
} else {
	$event_details = desert_current_get_event_details();

	$event = array(
		'month'       => desert_current_format_event_date( $event_details['date'], 'M' ),
		'day'         => desert_current_format_event_date( $event_details['date'], 'd' ),
		'title'       => get_the_title(),
		'schedule'    => desert_current_format_event_date( $event_details['date'], 'l, F j, Y' ),
		'location'    => $event_details['location'],
		'description' => get_the_excerpt(),
		'link_label'  => __( 'Event details', 'desert-current' ),
		'link_url'    => get_permalink(),
	);
}

$month       = $event['month'] ?? '';
$day         = $event['day'] ?? '';
$title       = $event['title'] ?? '';
$schedule    = $event['schedule'] ?? '';
$location    = $event['location'] ?? '';
$description = $event['description'] ?? '';
$link_label  = $event['link_label'] ?? '';
$link_url    = $event['link_url'] ?? '';
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
