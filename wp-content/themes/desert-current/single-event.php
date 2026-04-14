<?php
/**
 * Single event template.
 *
 * @package DesertCurrent
 */

get_header();
?>

<main id="main-content" class="site-main">
	<section class="content-section">
		<div class="container reading-width">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', 'event-single' );
			endwhile;
			?>
		</div>
	</section>
</main>

<?php
get_footer();
