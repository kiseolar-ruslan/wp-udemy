<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package firsttheme
 */

get_header();
?>
	<div>
		<p>Template for Custom Post Type Car</p>
		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header>

		<?php
		if ( have_posts() === true ) {
			while ( have_posts() === true ) {
				the_post();
				get_template_part( 'partials/content' );
			}
		} else {
			get_template_part( 'partials/content-none', 'none' );
		}
		?>
	</div>

<?php
get_sidebar('cars');
get_footer();
