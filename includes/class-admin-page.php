<?php

#includes/class-admin-page.php

function awesome_posts_settings_page() {
    if (isset($_POST['awesome_posts_save_settings'])) {
        check_admin_referer('awesome_posts_save_settings_verify');

        $selected_post_categories = !empty($_POST['awesome_posts_post_categories']) ? array_map('sanitize_text_field', $_POST['awesome_posts_post_categories']) : [];
        update_option('awesome_posts_selected_post_categories', $selected_post_categories);

        $selected_page_categories = !empty($_POST['awesome_posts_page_categories']) ? array_map('sanitize_text_field', $_POST['awesome_posts_page_categories']) : [];
        update_option('awesome_posts_selected_page_categories', $selected_page_categories);

        $selected_post_types = !empty($_POST['awesome_posts_post_types']) ? array_map('sanitize_text_field', $_POST['awesome_posts_post_types']) : [];
        update_option('awesome_posts_selected_post_types', $selected_post_types);

        $selected_cpt_categories = !empty($_POST['awesome_posts_cpt_categories']) ? array_map('sanitize_text_field', $_POST['awesome_posts_cpt_categories']) : [];
        update_option('awesome_posts_selected_cpt_categories', $selected_cpt_categories);

        echo '<div class="updated"><p>Settings saved.</p></div>';
    }

    $selected_post_categories = get_option('awesome_posts_selected_post_categories', []);
    $selected_page_categories = get_option('awesome_posts_selected_page_categories', []);
    $selected_post_types = get_option('awesome_posts_selected_post_types', []);
    $selected_cpt_categories = get_option('awesome_posts_selected_cpt_categories', []);

    $categories = get_categories();
    $post_types = get_post_types(['public' => true], 'objects');

    $taxonomies = get_taxonomies(['public' => true, '_builtin' => false], 'objects');
    ?>

    <div class="wrap">
        <h1>Awesome Posts Plugin</h1>
        <p>This plugin fetches and displays posts and pages of selected categories in a four-column layout.</p>
        <hr>
        <h2>Usage</h2>
        <p>Use the shortcode <code>[display_posts]</code> to display the posts and pages.</p>
        <hr>
        <h2>Select the taxonomy of the posts to be shown:</h2>
        <br>

        <form method="post" action="">
            <?php wp_nonce_field('awesome_posts_save_settings_verify'); ?>
            <h3>Select Categories for Posts</h3>
            <ul>
                <?php foreach ($categories as $category): ?>
                    <li>
                        <label>
                            <input type="checkbox" name="awesome_posts_post_categories[]" value="<?php echo esc_attr($category->slug); ?>" <?php echo in_array($category->slug, $selected_post_categories) ? 'checked' : ''; ?>>
                            <?php echo esc_html($category->name); ?>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
            <h3>Select Categories for Pages</h3>
            <ul>
                <?php foreach ($categories as $category): ?>
                    <li>
                        <label>
                            <input type="checkbox" name="awesome_posts_page_categories[]" value="<?php echo esc_attr($category->slug); ?>" <?php echo in_array($category->slug, $selected_page_categories) ? 'checked' : ''; ?>>
                            <?php echo esc_html($category->name); ?>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
            <h3>Select Post Types</h3>
            <ul>
                <?php foreach ($post_types as $post_type => $post_type_object): ?>
                    <li>
                        <label>
                            <input type="checkbox" name="awesome_posts_post_types[]" value="<?php echo esc_attr($post_type); ?>" <?php echo in_array($post_type, $selected_post_types) ? 'checked' : ''; ?>>
                            <?php echo esc_html($post_type_object->labels->name); ?>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
            <h3>Select Categories for Custom Post Types</h3>
            <?php foreach ($taxonomies as $taxonomy): ?>
                <h4><?php echo esc_html($taxonomy->label); ?></h4>
                <ul>
                    <?php
                    $terms = get_terms(['taxonomy' => $taxonomy->name, 'hide_empty' => false]);
                    foreach ($terms as $term): ?>
                        <li>
                            <label>
                                <input type="checkbox" name="awesome_posts_cpt_categories[]" value="<?php echo esc_attr($term->slug); ?>" <?php echo in_array($term->slug, $selected_cpt_categories) ? 'checked' : ''; ?>>
                                <?php echo esc_html($term->name); ?>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
            <p><input type="submit" name="awesome_posts_save_settings" value="Save Settings" class="button button-primary"></p>
        </form>
    </div>
    <?php
}
?>