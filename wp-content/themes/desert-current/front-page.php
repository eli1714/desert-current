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

$posts_page_id = (int) get_option( 'page_for_posts' );
$stories_url   = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/' );
$events_url    = get_post_type_archive_link( 'event' );

$latest_articles = new WP_Query(
	array(
		'posts_per_page'      => 6,
		'ignore_sticky_posts' => true,
		'post__not_in'        => array_merge( $hero_story_ids, $top_story_ids ),
		'post_status'         => 'publish',
	)
);

$featured_events = new WP_Query(
	array(
		'post_type'      => 'event',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
		'meta_key'       => '_desert_current_event_date',
		'orderby'        => 'meta_value',
		'order'          => 'ASC',
		'meta_query'     => array(
			array(
				'key'     => '_desert_current_event_date',
				'value'   => current_time( 'Y-m-d' ),
				'compare' => '>=',
				'type'    => 'DATE',
			),
		),
	)
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
			<div class="hero-copy-wrap">
				<div class="hero-copy">
					<p class="eyebrow"><?php esc_html_e( 'Local stories, culture, and community', 'desert-current' ); ?></p>
					<p class="hero-copy__kicker"><?php esc_html_e( 'A desert city newsroom with a neighborhood point of view', 'desert-current' ); ?></p>
					<h1><?php bloginfo( 'name' ); ?></h1>
					<p class="hero-text"><?php esc_html_e( 'Independent coverage of neighborhood news, local events, public life, and the creative energy shaping a desert city.', 'desert-current' ); ?></p>
					<div class="hero-copy__actions">
						<a class="button-link" href="<?php echo esc_url( $stories_url ); ?>"><?php esc_html_e( 'Read latest stories', 'desert-current' ); ?></a>
						<a class="hero-copy__secondary-link" href="#home-rail"><?php esc_html_e( 'Explore community highlights', 'desert-current' ); ?></a>
					</div>
				</div>

				<div class="hero-notes">
					<div class="hero-note">
						<span class="hero-note__label"><?php esc_html_e( 'This week', 'desert-current' ); ?></span>
						<span class="hero-note__value"><?php esc_html_e( 'Neighborhood news, civic updates, and culture worth showing up for.', 'desert-current' ); ?></span>
					</div>
					<div class="hero-note">
						<span class="hero-note__label"><?php esc_html_e( 'Editorial focus', 'desert-current' ); ?></span>
						<span class="hero-note__value"><?php esc_html_e( 'Stories that feel specific, local, and close to daily life.', 'desert-current' ); ?></span>
					</div>
				</div>
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
				<div class="top-stories-layout">
					<?php
					$top_story_count = 0;

					while ( $top_stories->have_posts() ) :
						$top_stories->the_post();

						++$top_story_count;

						if ( 1 === $top_story_count ) :
							?>
							<div class="top-stories-layout__lead">
								<?php get_template_part( 'template-parts/content/content', 'excerpt' ); ?>
							</div>
							<?php
						else :
							if ( 2 === $top_story_count ) :
								?>
								<div class="top-stories-layout__stack">
								<?php
							endif;

							get_template_part( 'template-parts/content/content', 'compact' );
						endif;
					endwhile;

					if ( $top_story_count > 1 ) :
						?>
						</div>
						<?php
					endif;

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
					'intro' => __( 'A quick look at upcoming markets, music nights, art walks, and neighborhood gatherings.', 'desert-current' ),
					'action_label' => __( 'View all events', 'desert-current' ),
					'action_url'   => $events_url ? $events_url : home_url( '/events/' ),
				)
			);
			?>

			<?php if ( $featured_events->have_posts() ) : ?>
				<div class="event-grid">
					<?php
					while ( $featured_events->have_posts() ) :
						$featured_events->the_post();
						get_template_part( 'template-parts/components/event-card' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
			<?php endif; ?>
		</div>
	</section>

	<section class="content-section content-section--rail" id="home-rail">
		<div class="container">
			<div class="home-rail">
				<div class="home-rail__spotlight">
					<?php get_template_part( 'template-parts/components/community-spotlight', null, $community_spotlight ); ?>
				</div>

				<div class="home-rail__newsletter">
					<?php get_template_part( 'template-parts/components/newsletter-callout', null, $newsletter_callout ); ?>
				</div>
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
