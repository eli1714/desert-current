<?php
/**
 * Community spotlight callout block.
 *
 * @package DesertCurrent
 */

$eyebrow     = $args['eyebrow'] ?? '';
$title       = $args['title'] ?? '';
$description = $args['description'] ?? '';
$meta        = $args['meta'] ?? '';
$link_label  = $args['link_label'] ?? '';
$link_url    = $args['link_url'] ?? '';
?>

<div class="spotlight-card">
	<div class="spotlight-card__content">
		<?php if ( $eyebrow ) : ?>
			<p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<?php endif; ?>

		<h2 class="spotlight-card__title"><?php echo esc_html( $title ); ?></h2>

		<?php if ( $meta ) : ?>
			<p class="spotlight-card__meta"><?php echo esc_html( $meta ); ?></p>
		<?php endif; ?>

		<div class="spotlight-card__description"><?php echo wp_kses_post( $description ); ?></div>

		<?php if ( $link_label && $link_url ) : ?>
			<a class="button-link" href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_label ); ?></a>
		<?php endif; ?>
	</div>
</div>
