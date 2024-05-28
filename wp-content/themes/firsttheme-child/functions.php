<?php

function firsttheme_child_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar123', 'firsttheme'),
            'id'            => 'sidebar-1123',
            'description'   => esc_html__('Add widgets here.', 'firsttheme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'firsttheme_child_widgets_init');