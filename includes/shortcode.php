<?php
#shortcode.php

function awesome_posts_display_posts() {
    $posts = Awesome_Posts_Fetcher::get_posts_by_selected_categories();

    ob_start();
    include plugin_dir_path(__FILE__) . '../templates/posts-template.php';
    return ob_get_clean();
}

add_shortcode('display_posts', 'awesome_posts_display_posts');
