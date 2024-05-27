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
        //Pagination
        echo '<div class="pagination">';
        the_posts_pagination(
                array(
                        'prev_text' => esc_html__('Prev', 'firsttheme'),
                        'next_text' => esc_html__('Next', 'firsttheme')
                )
        );
//        posts_nav_link(
//            ' <--> ',
//            esc_html__('Prev', 'firsttheme'),
//            esc_html__('Next', 'firsttheme')
//        );
        echo '</div>';
    } else {
        get_template_part('partials/content-none', 'none');
    }
    ?>
</div>

<?php
//get_sidebar();
//get_footer();
?>
