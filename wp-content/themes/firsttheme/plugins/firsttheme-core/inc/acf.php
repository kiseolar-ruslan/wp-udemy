<?php

function firsttheme_acf_metaboxes()
{
    acf_add_local_field_group(array(
        'key'                   => 'acf_carsettings',
        'title'                 => 'Car settings for ACF from code',
        'fields'                => array(
            array(
                'key'   => 'custom_price',
                'label' => esc_html__('Car Price', 'firsttheme'),
                'name'  => esc_html__('custom_price', 'firsttheme'),
                'type'  => 'text',
            ),
            array(
                'key'     => 'custom_engine_type',
                'label'   => esc_html__('Car Engine Type', 'firsttheme'),
                'name'    => esc_html__('custom_engine_type', 'firsttheme'),
                'type'    => 'select',
                'choices' => array(
                    'manual'    => esc_html__('Manual', 'firsttheme'),
                    'automatic' => esc_html__('Automatic', 'firsttheme'),
                ),
                'allow_null' => 1,
            ),
        ),
        'location'              => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'car',
                )
            )
        ),
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => array(),
    ));
}
add_action('acf/init', 'firsttheme_acf_metaboxes');