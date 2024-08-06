<?php 
#posts-template.php

if (!empty($posts)): ?>
    <div class="awesome-posts-container">
	
	    <div class="col-md-12" id="awesome-posts-title-container">
			<h2>Notícias</h2>
			<hr>
		</div>
		<div class="awesome-posts-posts-container">
        <?php foreach ($posts as $post): setup_postdata($post); ?>
            <div class="awesome-post" style="">
                <?php if (has_post_thumbnail($post)): ?>
                    <div class="awesome-post-thumbnail">
                        <?php echo get_the_post_thumbnail($post, 'full'); ?>
                    </div>
                <?php endif; ?>
                <div class="content">
                    <p class="publish-date"><?php echo get_the_date('', $post); ?></p>
                    <h2 class="title"><?php echo get_the_title($post); ?></h2>
                    <hr>
                    <div class="excerpt"><?php echo get_the_excerpt($post); ?></div>
                    <div class="cta">
                        <a href="<?php echo get_permalink($post); ?>">
                            <span class="dashicons dashicons-plus-alt plus-dashicon"></span>
                        </a>
                    </div>
                </div>
            </div>
			<?php endforeach; wp_reset_postdata(); ?>
		</div>
		<div class="col-md-12 mktv-cta-container">
			<a href="/news">
				<button id="posts-cta-button">Ver tudo</button>
			</a>
		</div>
	</div>
<?php endif; ?>
