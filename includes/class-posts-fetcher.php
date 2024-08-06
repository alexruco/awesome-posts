<?php
#class-posts-fetcher.php

class Awesome_Posts_Fetcher {
    public static function get_posts_by_selected_categories() {
        $selected_post_categories = get_option('awesome_posts_selected_post_categories', []);
        $selected_page_categories = get_option('awesome_posts_selected_page_categories', []);
        $selected_post_types = get_option('awesome_posts_selected_post_types', []);

        $posts = [];
        
        if (!empty($selected_post_categories)) {
            $args = array(
                'category_name' => implode(',', $selected_post_categories),
                'posts_per_page' => 3,
                'post_type' => 'post',
                'orderby' => 'menu_order',
                'order' => 'DESC',
                
            );
            $query = new WP_Query($args);
            $posts = array_merge($posts, $query->posts);
        }

        if (!empty($selected_page_categories)) {
            $args = array(
                'category_name' => implode(',', $selected_page_categories),
                'posts_per_page' => 3,
                'post_type' => 'page',
                'orderby' => 'menu_order',
                'order' => 'DESC',


            );
            $query = new WP_Query($args);
            $posts = array_merge($posts, $query->posts);
        }

        if (!empty($selected_post_types)) {
            foreach ($selected_post_types as $post_type) {
                $args = array(
                    'posts_per_page' => 3,
                    'post_type' => $post_type,
                    'orderby' => 'menu_order',
                    'order' => 'DESC',


                );
                $query = new WP_Query($args);
                $posts = array_merge($posts, $query->posts);
            }
        }

        return $posts;
    }
}
