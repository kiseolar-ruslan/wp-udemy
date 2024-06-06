<?php
/*
Plugin Name: Firsttheme Core
Plugin URI: https://firsttheme.com
Description: A plugin that implements Firsttheme functionality
Version: 1.0
Author: Ukrlan
Author URI: https://firsttheme.com
License: GPLv2 or later
Text Domain: firsttheme-core
*/

if (function_exists('add_action') === false) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

//widget connection
require_once __DIR__ . '/inc/widget-about.php';

//meta boxes connection
require_once __DIR__ . '/inc/metaboxes.php';

//ACF plugin meta boxes connection
require_once __DIR__ . '/inc/acf.php';

require_once __DIR__ . '/inc/custom_post_type.php';

//add elementor widget
require_once __DIR__ . '/inc/elementor.php';
