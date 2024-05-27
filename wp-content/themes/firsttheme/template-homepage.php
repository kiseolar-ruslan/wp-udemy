<?php
/**
 * Template name: Homepage Template
 */

get_header();
echo '<div class="cars">';
$args = array(
    'post_type'      => 'car',
    'orderby'        => 'date',
    'order'          => 'ASC',
    'posts_per_page' => -1,
);
$cars = new WP_Query($args);

if ($cars->have_posts() === true) {
    while ($cars->have_posts() === true) {
        $cars->the_post();
        get_template_part('partials/content');
    }
} else {
    get_template_part('partials/content-none', 'none');
}
wp_reset_postdata();
echo '</div>';

echo '<hr>';

echo '<div class="blog-posts">';
unset($args);
$args      = array(
    'post_type'      => 'post',
    'posts_per_page' => -1,
);
$blogPosts = new WP_Query($args);

if ($blogPosts->have_posts() === true) {
    while ($blogPosts->have_posts() === true) {
        $blogPosts->the_post();
        get_template_part('partials/content');
    }
} else {
    get_template_part('partials/content-none', 'none');
}
wp_reset_postdata();
echo '</div>';
get_footer();