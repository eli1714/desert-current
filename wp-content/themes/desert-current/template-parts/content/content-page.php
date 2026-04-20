<?php
/**
 * Page content.
 *
 * @package DesertCurrent
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry entry-page' ); ?>>
	<?php $is_elementor_page = 'builder' === get_post_meta( get_the_ID(), '_elementor_edit_mode', true ); ?>

	<?php if ( ! $is_elementor_page ) : ?>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>
