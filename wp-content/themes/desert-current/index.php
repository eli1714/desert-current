<?php
/**
 * Fallback template for Desert Current.
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
					'title' => __( 'Stories', 'desert-current' ),
					'intro' => __( 'Recent reporting on neighborhood news, culture, and the everyday changes shaping life across the region.', 'desert-current' ),
					'level' => 'h1',
				)
			);
			?>

			<?php if ( have_posts() ) : ?>
				<div class="story-grid story-grid--archive">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content/content', 'excerpt' );
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
