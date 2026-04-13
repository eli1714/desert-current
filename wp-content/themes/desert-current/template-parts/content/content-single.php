<?php
/**
 * Single post content.
 *
 * @package DesertCurrent
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry entry-single' ); ?>>
	<header class="entry-header">
		<p class="entry-meta"><?php echo esc_html( get_the_date() ); ?></p>
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

