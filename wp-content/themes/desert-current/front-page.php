<?php
/**
 * Front page template.
 *
 * @package DesertCurrent
 */

get_header();

$hero_story = new WP_Query(
	array(
		'posts_per_page'      => 1,
		'ignore_sticky_posts' => true,
		'post_status'         => 'publish',
	)
);

$hero_story_ids = wp_list_pluck( $hero_story->posts, 'ID' );

$top_stories = new WP_Query(
	array(
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => true,
		'post__not_in'        => $hero_story_ids,
		'post_status'         => 'publish',
	)
);

$top_story_ids = wp_list_pluck( $top_stories->posts, 'ID' );

$latest_articles = new WP_Query(
	array(
		'posts_per_page'      => 6,
		'ignore_sticky_posts' => true,
		'post__not_in'        => array_merge( $hero_story_ids, $top_story_ids ),
		'post_status'         => 'publish',
	)
);

$featured_events = array(
	array(
		'month'       => 'APR',
		'day'         => '18',
		'title'       => 'Desert Sounds on Main Street',
		'schedule'    => 'Friday, 6:30 PM to 9:00 PM',
		'location'    => 'Main Street Plaza',
		'description' => 'An outdoor music night with local performers, food stalls, and shaded seating for families.',
		'link_label'  => 'Event details',
		'link_url'    => home_url( '/events/' ),
	),
	array(
		'month'       => 'APR',
		'day'         => '20',
		'title'       => 'West Mesa Makers Market',
		'schedule'    => 'Sunday, 8:00 AM to 1:00 PM',
		'location'    => 'West Mesa Community Park',
		'description' => 'A weekend market featuring neighborhood artists, vintage sellers, and small-batch food vendors.',
		'link_label'  => 'Event details',
		'link_url'    => home_url( '/events/' ),
	),
	array(
		'month'       => 'APR',
		'day'         => '24',
		'title'       => 'Public Art Walk and Panel',
		'schedule'    => 'Thursday, 7:00 PM',
		'location'    => 'Rail Yard Arts District',
		'description' => 'A guided evening walk through downtown murals followed by a conversation with local artists.',
		'link_label'  => 'Event details',
		'link_url'    => home_url( '/events/' ),
	),
);

$community_spotlight = array(
	'eyebrow'      => 'Community Spotlight',
	'title'        => 'Neighbors Turn an Empty Corner Into a Weekend Garden Share',
	'description'  => 'What started as a small volunteer cleanup turned into a regular gathering spot with donated plants, seed swaps, and free gardening tips for first-time growers.',
	'meta'         => 'South Ridge Neighborhood',
	'link_label'   => 'Read the spotlight',
	'link_url'     => home_url( '/category/community/' ),
);

$newsletter_callout = array(
	'eyebrow'      => 'Stay in the Loop',
	'title'        => 'Get the week\'s most useful local stories in one short update.',
	'description'  => 'Later we can connect this area to a real form. For now, it works as a realistic newsletter callout and portfolio-friendly CTA.',
	'link_label'   => 'Visit the contact page',
	'link_url'     => home_url( '/contact/' ),
);
?>

<main id="main-content" class="site-main">
	<section class="hero-section">
		<div class="container hero-layout">
			<div class="hero-copy">
				<p class="eyebrow"><?php esc_html_e( 'Local stories, culture, and community', 'desert-current' ); ?></p>
				<h1><?php bloginfo( 'name' ); ?></h1>
				<p class="hero-text"><?php esc_html_e( 'Independent coverage of neighborhood news, local events, public life, and the creative energy shaping a desert city.', 'desert-current' ); ?></p>
			</div>

			<div class="hero-story">
				<?php if ( $hero_story->have_posts() ) : ?>
					<?php
					while ( $hero_story->have_posts() ) :
						$hero_story->the_post();
						get_template_part( 'template-parts/content/content', 'featured' );
					endwhile;
					wp_reset_postdata();
					?>
				<?php else : ?>
					<div class="hero-story__placeholder">
						<p class="eyebrow"><?php esc_html_e( 'Lead Story', 'desert-current' ); ?></p>
						<h2><?php esc_html_e( 'Your lead story will appear here once you publish your first post.', 'desert-current' ); ?></h2>
						<p><?php esc_html_e( 'This space is meant for the most important story on the site. It gives the homepage a strong visual starting point.', 'desert-current' ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="content-section">
		<div class="container">
			<?php
			get_template_part(
				'template-parts/components/page-header',
				null,
				array(
					'title' => __( 'Top Stories', 'desert-current' ),
					'intro' => __( 'A focused row of recent stories makes the homepage feel like a real local publication instead of a generic landing page.', 'desert-current' ),
				)
			);
			?>

			<?php if ( $top_stories->have_posts() ) : ?>
				<div class="story-grid">
					<?php
					while ( $top_stories->have_posts() ) :
						$top_stories->the_post();
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

	<section class="content-section section-alt">
		<div class="container">
			<?php
			get_template_part(
				'template-parts/components/page-header',
				null,
				array(
					'title' => __( 'Featured Local Events', 'desert-current' ),
					'intro' => __( 'These placeholder events help the homepage feel realistic now, and they can later be replaced with a real Events content type.', 'desert-current' ),
				)
			);
			?>

			<div class="event-grid">
				<?php foreach ( $featured_events as $event ) : ?>
					<?php get_template_part( 'template-parts/components/event-card', null, $event ); ?>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="content-section">
		<div class="container">
			<?php get_template_part( 'template-parts/components/community-spotlight', null, $community_spotlight ); ?>
		</div>
	</section>

	<section class="content-section section-dark">
		<div class="container">
			<?php get_template_part( 'template-parts/components/newsletter-callout', null, $newsletter_callout ); ?>
		</div>
	</section>

	<section class="content-section">
		<div class="container">
			<?php
			get_template_part(
				'template-parts/components/page-header',
				null,
				array(
					'title' => __( 'Latest Articles', 'desert-current' ),
					'intro' => __( 'This grid gives the homepage useful depth without making it feel overloaded.', 'desert-current' ),
				)
			);
			?>

			<?php if ( $latest_articles->have_posts() ) : ?>
				<div class="story-grid">
					<?php
					while ( $latest_articles->have_posts() ) :
						$latest_articles->the_post();
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
