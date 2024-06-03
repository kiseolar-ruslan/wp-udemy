<?php

function firsttheme_register_post_type()
{
    $args = array(
        'hierarchical'      => false,
        'labels'            => array(
            'name'              => esc_html_x('Brands', 'taxonomy general name', 'firsttheme'),
            'singular_name'     => esc_html_x('Brand', 'taxonomy singular name', 'firsttheme'),
            'search_items'      => esc_html__('Search Brands', 'firsttheme'),
            'all_items'         => esc_html__('All Brands', 'firsttheme'),
            'parent_item'       => esc_html__('Parent Brand', 'firsttheme'),
            'parent_item_colon' => esc_html__('Parent Brand:', 'firsttheme'),
            'edit_item'         => esc_html__('Edit Brand', 'firsttheme'),
            'update_item'       => esc_html__('Update Brand', 'firsttheme'),
            'add_new_item'      => esc_html__('Add New Brand', 'firsttheme'),
            'new_item_name'     => esc_html__('New Brand Name', 'firsttheme'),
            'menu_name'         => esc_html__('Brand', 'firsttheme'),
        ),
        'show_ui'           => true,
        'rewrite'           => array('slug' => 'brands'),
        'query_var'         => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
    );

    register_taxonomy('brand', array('car'), $args);

    unset($args);

    $args = array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'              => esc_html_x('Manufactures', 'taxonomy general name', 'firsttheme'),
            'singular_name'     => esc_html_x('Manufacture', 'taxonomy singular name', 'firsttheme'),
            'search_items'      => esc_html__('Search Manufactures', 'firsttheme'),
            'all_items'         => esc_html__('All Manufactures', 'firsttheme'),
            'parent_item'       => esc_html__('Parent Manufacture', 'firsttheme'),
            'parent_item_colon' => esc_html__('Parent Manufacture:', 'firsttheme'),
            'edit_item'         => esc_html__('Edit Manufacture', 'firsttheme'),
            'update_item'       => esc_html__('Update Manufacture', 'firsttheme'),
            'add_new_item'      => esc_html__('Add New Manufacture', 'firsttheme'),
            'new_item_name'     => esc_html__('New Manufacture Name', 'firsttheme'),
            'menu_name'         => esc_html__('Manufacture', 'firsttheme'),
        ),
        'show_ui'           => true,
        'rewrite'           => array('slug' => 'manufactures'),
        'query_var'         => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
    );

    register_taxonomy('manufacture', array('car'), $args);

    unset($args);

    $args = array(
        'label'              => esc_html__('Cars', 'firsttheme'),
        'labels'             => array(
            'add_new'      => esc_html__('Add New', 'firsttheme'),
            'all_items'    => esc_html__('All Cars', 'firsttheme'),
            'not_found'    => esc_html__('No Cars Found', 'firsttheme'),
            'search_items' => esc_html__('Search Cars', 'firsttheme'),
        ),
        'supports'           => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'comments',
            'revisions',
            'page-attributes'
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'cars'),
        'show_in_rest'       => true,
    );

    register_post_type('car', $args);
}

add_action('init', 'firsttheme_register_post_type');
