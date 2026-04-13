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
					'title' => get_the_archive_title() ? get_the_archive_title() : __( 'Latest Stories', 'desert-current' ),
					'level' => 'h1',
				)
			);
			?>

			<?php if ( have_posts() ) : ?>
				<div class="story-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content/content', 'excerpt' );
					endwhile;
					?>
				</div>

				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();
