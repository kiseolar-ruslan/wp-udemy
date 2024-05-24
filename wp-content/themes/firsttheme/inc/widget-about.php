<?php

class FirstthemeAboutWidget extends WP_Widget
{
    //Указывает в какие HTML теги будет обернут виджет
    public array $args = array(
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div>',
    );

    public function __construct()
    {
        parent::__construct(
            'firsttheme_about_widget',
            esc_html__('About Widget', 'firsttheme'),
            array(
                'description' => esc_html__('Our First Widget', 'firsttheme')
            ),
        );
    }

    /*
     * front-end output
     * Используется для отображения виджета на сайте.
     * Выводит заголовок и содержимое виджета.
     */
    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        $text  = apply_filters('the_content', $instance['text']);

        echo $this->args['before_widget'];

        if (empty($title) === false) {
            echo $this->args['before_title'] . esc_html__($title) . $this->args['after_title'];
        }

        if (empty($text) === false) {
            echo wp_kses_post($text);
        }

        echo $this->args['after_widget'];
    }

    /*
     * back-end
     * Создает форму в админ-панели для настройки виджета.
     */
    public function form($instance)
    {
        $title = $instance['title'] ?? '';
        $text  = $instance['text'] ?? '';
        ?>
        <p>
            <label for="<?php
            echo $this->get_field_id('title'); ?>">
                <?php
                esc_html_e('Title', 'firsttheme') ?>
            </label>
            <input
                    type="text"
                    class="widefat"
                    id="<?php
                    echo $this->get_field_id('title'); ?>"
                    name="<?php
                    echo $this->get_field_name('title'); ?>"
                    value="<?php
                    echo esc_attr($title) ?>"
            >
        </p>
        <p>
            <label for="<?php
            echo $this->get_field_id('text'); ?>">
                <?php
                esc_html_e('Text', 'firsttheme') ?>
            </label>
            <textarea
                    class="widefat"
                    id="<?php
                    echo $this->get_field_id('text'); ?>"
                    name="<?php
                    echo $this->get_field_name('text'); ?>"
            >
                <?php
                echo esc_attr($text) ?>
            </textarea>
        </p>
        <?php
    }

    //Обрабатывает и сохраняет настройки виджета.
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['text']  = strip_tags($new_instance['text']);

        return $instance;
    }
}