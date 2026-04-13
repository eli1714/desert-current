<?php
/**
 * Archive template.
 *
 * @package DesertCurrent
 */

get_header();
?>

<main id="main-content" class="site-main">
	<section class="content-section">
		<div class="container">
			<?php
			$archive_intro = term_description();

			get_template_part(
				'template-parts/components/page-header',
				null,
				array(
					'title' => get_the_archive_title(),
					'intro' => wp_strip_all_tags( $archive_intro ),
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
