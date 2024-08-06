<?php
/*
Plugin Name: Awesome Posts
Description: A plugin to fetch and display posts of a given category in a four-column layout.
Version: 1.0
Author: Alex Ruco
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

require_once plugin_dir_path(__FILE__) . 'includes/class-posts-fetcher.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-admin-page.php';

function awesome_posts_enqueue_styles() {
    wp_enqueue_style('awesome-posts-styles', plugin_dir_url(__FILE__) . 'assets/css/styles.css');
}
add_action('wp_enqueue_scripts', 'awesome_posts_enqueue_styles');

function awesome_posts_admin_menu() {
    add_menu_page(
        'Awesome Posts Settings',
        'Awesome Posts',
        'manage_options',
        'awesome-posts',
        'awesome_posts_settings_page',
		'dashicons-format-status'
    );
}
add_action('admin_menu', 'awesome_posts_admin_menu');
