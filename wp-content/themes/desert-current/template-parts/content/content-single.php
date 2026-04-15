<?php
/**
 * Single post content.
 *
 * @package DesertCurrent
 */

$category_list = get_the_category_list( ', ' );
$post_id       = get_the_ID();
$category_ids  = wp_get_post_categories( $post_id );

$related_posts_args = array(
	'post_type'           => 'post',
	'posts_per_page'      => 3,
	'post__not_in'        => array( $post_id ),
	'ignore_sticky_posts' => true,
	'post_status'         => 'publish',
);

if ( ! empty( $category_ids ) ) {
	$related_posts_args['category__in'] = $category_ids;
}

$related_posts = new WP_Query( $related_posts_args );
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
		<?php if ( $related_posts->have_posts() ) : ?>
			<section class="related-stories" aria-labelledby="related-stories-title">
				<div class="related-stories__header">
					<p class="eyebrow"><?php esc_html_e( 'Continue Reading', 'desert-current' ); ?></p>
					<h2 id="related-stories-title" class="related-stories__title"><?php esc_html_e( 'Related Stories', 'desert-current' ); ?></h2>
					<p class="related-stories__intro"><?php esc_html_e( 'More reporting connected to this story and the topics around it.', 'desert-current' ); ?></p>
				</div>

				<div class="story-grid story-grid--related">
					<?php
					while ( $related_posts->have_posts() ) :
						$related_posts->the_post();
						get_template_part( 'template-parts/content/content', 'excerpt' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</section>
		<?php endif; ?>
	</footer>
</article>
