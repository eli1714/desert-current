<?php
/**
 * Newsletter callout section.
 *
 * @package DesertCurrent
 */

$eyebrow     = $args['eyebrow'] ?? '';
$title       = $args['title'] ?? '';
$description = $args['description'] ?? '';
$link_label  = $args['link_label'] ?? '';
$link_url    = $args['link_url'] ?? '';
?>

<div class="newsletter-callout">
	<div class="newsletter-callout__content">
		<?php if ( $eyebrow ) : ?>
			<p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<?php endif; ?>

		<h2 class="newsletter-callout__title"><?php echo esc_html( $title ); ?></h2>
		<p class="newsletter-callout__description"><?php echo esc_html( $description ); ?></p>
	</div>

	<?php if ( $link_label && $link_url ) : ?>
		<div class="newsletter-callout__action">
			<a class="button-link button-link--light" href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_label ); ?></a>
		</div>
	<?php endif; ?>
</div>
