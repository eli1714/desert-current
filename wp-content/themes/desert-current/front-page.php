<?php
/**
 * Front page template.
 *
 * @package DesertCurrent
 */

get_header();

$featured_story = new WP_Query(
	array(
		'posts_per_page'      => 1,
		'ignore_sticky_posts' => true,
	)
);

$latest_stories = new WP_Query(
	array(
		'posts_per_page'      => 3,
		'offset'              => 1,
		'ignore_sticky_posts' => true,
	)
);
?>

<main id="main-content" class="site-main">
	<section class="hero-section">
		<div class="container hero-layout">
			<div class="hero-copy">
				<p class="eyebrow"><?php esc_html_e( 'Local stories, culture, and community', 'desert-current' ); ?></p>
				<h1><?php bloginfo( 'name' ); ?></h1>
				<p class="hero-text"><?php bloginfo( 'description' ); ?></p>
			</div>
		</div>
	</section>

	<section class="content-section">
		<div class="container">
			<?php get_template_part( 'template-parts/components/page-header', null, array( 'title' => __( 'Featured Story', 'desert-current' ), 'intro' => __( 'A simple homepage lead story gives the site a clear editorial hierarchy.', 'desert-current' ) ) ); ?>

			<?php if ( $featured_story->have_posts() ) : ?>
				<?php
				while ( $featured_story->have_posts() ) :
					$featured_story->the_post();
					get_template_part( 'template-parts/content/content', 'excerpt' );
				endwhile;
				wp_reset_postdata();
				?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
			<?php endif; ?>
		</div>
	</section>

	<section class="content-section section-alt">
		<div class="container">
			<?php get_template_part( 'template-parts/components/page-header', null, array( 'title' => __( 'Latest Stories', 'desert-current' ), 'intro' => __( 'This section will later become a reusable story feed for the homepage and archive pages.', 'desert-current' ) ) ); ?>

			<?php if ( $latest_stories->have_posts() ) : ?>
				<div class="story-grid">
					<?php
					while ( $latest_stories->have_posts() ) :
						$latest_stories->the_post();
						get_template_part( 'template-parts/content/content', 'excerpt' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();

