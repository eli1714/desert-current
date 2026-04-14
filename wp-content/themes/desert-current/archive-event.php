<?php
/**
 * Event archive template.
 *
 * @package DesertCurrent
 */

get_header();
?>

<main id="main-content" class="site-main">
	<section class="content-section">
		<div class="container">
			<?php
			get_template_part(
				'template-parts/components/page-header',
				null,
				array(
					'title' => __( 'Local Events', 'desert-current' ),
					'intro' => __( 'Upcoming markets, music nights, public talks, and neighborhood gatherings across the region.', 'desert-current' ),
					'level' => 'h1',
				)
			);
			?>

			<?php if ( have_posts() ) : ?>
				<div class="event-grid event-grid--archive">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content/content', 'event' );
					endwhile;
					?>
				</div>

				<?php get_template_part( 'template-parts/components/pagination' ); ?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();
