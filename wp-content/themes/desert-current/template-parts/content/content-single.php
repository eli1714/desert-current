<?php
/**
 * Single post content.
 *
 * @package DesertCurrent
 */

$category_list = get_the_category_list( ', ' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry entry-single' ); ?>>
	<header class="entry-header">
		<?php if ( $category_list ) : ?>
			<p class="entry-kicker"><?php echo wp_kses_post( $category_list ); ?></p>
		<?php endif; ?>
		<div class="entry-meta">
			<span><?php echo esc_html( get_the_date() ); ?></span>
			<span aria-hidden="true">•</span>
			<span><?php echo esc_html( get_the_author() ); ?></span>
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

	<footer class="entry-footer">
		<?php the_post_navigation(); ?>
	</footer>
</article>
