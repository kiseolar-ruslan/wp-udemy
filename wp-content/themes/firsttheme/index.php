<?php
get_header();
?>

<div>
    <?php
        if (have_posts() === true) {
            while (have_posts() === true) {
                the_post();
                get_template_part('partials/content');
            }
        } else {
            get_template_part('partials/content-none', 'none');
        }
    ?>
</div>

<?php //get_sidebar();
get_footer();
?>
