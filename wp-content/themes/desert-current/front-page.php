<?php
/**
 * Front page template.
 *
 * @package DesertCurrent
 */

get_header();

$front_page_id = get_queried_object_id();

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

$featured_events = new WP_Query(
	array(
		'post_type'      => 'event',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
		'meta_key'       => 'event_date',
		'orderby'        => 'meta_value',
		'order'          => 'ASC',
		'meta_query'     => array(
			array(
				'key'     => 'event_date',
				'value'   => current_time( 'Y-m-d' ),
				'compare' => '>=',
				'type'    => 'DATE',
			),
		),
	)
);

$hero_content = array(
	'eyebrow'              => get_field( 'home_hero_eyebrow', $front_page_id ),
	'kicker'               => get_field( 'home_hero_kicker', $front_page_id ),
	'intro'                => get_field( 'home_hero_intro', $front_page_id ),
	'primary_link_label'   => __( 'Read latest stories', 'desert-current' ),
	'primary_link_url'     => $stories_url,
	'secondary_link_label' => __( 'Explore community highlights', 'desert-current' ),
	'secondary_link_url'   => '#home-rail',
);

$hero_notes = desert_current_get_home_hero_notes( $front_page_id );

$community_spotlight = array(
	'eyebrow'      => 'Community Spotlight',
	'title'        => get_field( 'home_spotlight_title', $front_page_id ),
	'description'  => get_field( 'home_spotlight_description', $front_page_id ),
	'meta'         => get_field( 'home_spotlight_meta', $front_page_id ),
	'link_label'   => get_field( 'home_spotlight_link_label', $front_page_id ),
	'link_url'     => get_field( 'home_spotlight_link_url', $front_page_id ),
);

$newsletter_callout = array(
	'eyebrow'      => 'Stay in the Loop',
	'title'        => get_field( 'home_newsletter_title', $front_page_id ),
	'description'  => get_field( 'home_newsletter_description', $front_page_id ),
	'link_label'   => get_field( 'home_newsletter_link_label', $front_page_id ),
	'link_url'     => get_field( 'home_newsletter_link_url', $front_page_id ),
);
?>

<main id="main-content" class="site-main">
	<section class="hero-section">
		<div class="container hero-layout">
			<div class="hero-copy-wrap">
				<div class="hero-copy">
					<?php if ( $hero_content['eyebrow'] ) : ?>
						<p class="eyebrow"><?php echo esc_html( $hero_content['eyebrow'] ); ?></p>
					<?php endif; ?>
					<?php if ( $hero_content['kicker'] ) : ?>
						<p class="hero-copy__kicker"><?php echo esc_html( $hero_content['kicker'] ); ?></p>
					<?php endif; ?>
					<h1><?php bloginfo( 'name' ); ?></h1>
					<?php if ( $hero_content['intro'] ) : ?>
						<div class="hero-text"><?php echo wp_kses_post( $hero_content['intro'] ); ?></div>
					<?php endif; ?>
					<div class="hero-copy__actions">
						<a class="button-link" href="<?php echo esc_url( $hero_content['primary_link_url'] ); ?>"><?php echo esc_html( $hero_content['primary_link_label'] ); ?></a>
						<a class="hero-copy__secondary-link" href="<?php echo esc_url( $hero_content['secondary_link_url'] ); ?>"><?php echo esc_html( $hero_content['secondary_link_label'] ); ?></a>
					</div>
				</div>

				<?php if ( $hero_notes ) : ?>
					<div class="hero-notes">
						<?php foreach ( $hero_notes as $hero_note ) : ?>
							<div class="hero-note">
								<span class="hero-note__label"><?php echo esc_html( $hero_note['label'] ); ?></span>
								<span class="hero-note__value"><?php echo esc_html( $hero_note['value'] ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
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
					'intro' => __( 'The stories shaping conversation right now, from public updates to local culture and community life.', 'desert-current' ),
					'action_label' => __( 'View all stories', 'desert-current' ),
					'action_url'   => $stories_url,
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
</main>

<?php
get_footer();
