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
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
        </header>

        <?php
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;

        $cars = new WP_Query(
            array(
                'post_type'      => 'car',
                'posts_per_page' => 2,
                'paged'          => $paged,
            )
        );

        if ($cars->have_posts() === true) {
            while ($cars->have_posts() === true) {
                $cars->the_post();
                get_template_part('partials/content');
            }
            //Pagination
            echo '<div class="pagination">';
            firsttheme_paginate($cars);
            echo '</div>';
        } else {
            get_template_part('partials/content-none', 'none');
        }
        wp_reset_postdata();
        ?>
    </div>

<?php
get_sidebar('cars');
get_footer();
