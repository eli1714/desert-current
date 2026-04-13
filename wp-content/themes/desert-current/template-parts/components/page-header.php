<?php
/**
 * Small reusable section header.
 *
 * @package DesertCurrent
 */

$title = $args['title'] ?? '';
$intro = $args['intro'] ?? '';
$level = $args['level'] ?? 'h2';

if ( ! $title ) {
	return;
}

if ( ! in_array( $level, array( 'h1', 'h2', 'h3' ), true ) ) {
	$level = 'h2';
}
?>

<header class="section-header">
	<?php printf( '<%1$s class="section-title">%2$s</%1$s>', esc_html( $level ), esc_html( $title ) ); ?>

	<?php if ( $intro ) : ?>
		<p class="section-intro"><?php echo esc_html( $intro ); ?></p>
	<?php endif; ?>
</header>
