<?php

$query = isset($args['query']) ? $args['query'] : $wp_query;
$pagination = isset($args['pagination']) ? $args['pagination'] : "";
?>

<?php if ($query->have_posts()): ?>
  <div class="blog-posts-grid">
    <?php while ($query->have_posts()):
      $query->the_post(); ?>
      <article class="post-grid-item">
        <a href="<?php the_permalink(); ?>">
        <div class="post-image">
          
            <?php
            $image_url = has_post_thumbnail()
              ? esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium'))
              : esc_url(get_template_directory_uri() . '/src/images/post1.png');
            ?>
            <img src="<?php echo $image_url; ?>" alt="<?php the_title_attribute(); ?>">
         
        </div>
        
        <div class="post-content">
         
          
          <h2 class="post-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>
          
          <div class="post-excerpt">
            <?php
            $excerpt = get_the_excerpt();
            if (empty($excerpt)) {
              $excerpt = get_the_content();
            }
            $excerpt = strip_tags($excerpt);
            $excerpt = wp_trim_words($excerpt, 25, '...');
            echo $excerpt;
            ?>
          </div>
          
    
        </div>
         </a>
      </article>
    <?php endwhile; ?>
  </div>

  <?php
  if (!isset($pagination) || $pagination != false):
    $current_page = max(1, get_query_var('paged'));
    $total_pages = $query->max_num_pages;

    echo '<div class="pagination">';

    if ($current_page > 1) {
      echo '<a href="' . esc_url(get_pagenum_link($current_page - 1)) . '" class="prev"><span class="arrow"></span></a>';
    } else {
      echo '<span class="prev disabled"><span class="arrow"></span></span>';
    }

    echo paginate_links([
      'total' => $total_pages,
      'current' => $current_page,
      'mid_size' => 2,
      'prev_next' => false,
    ]);

    if ($current_page < $total_pages) {
      echo '<a href="' . esc_url(get_pagenum_link($current_page + 1)) . '" class="next"><span class="arrow"></span></a>';
    } else {
      echo '<span class="next disabled"><span class="arrow"></span></span>';
    }

    echo '</div>';
  endif;
  ?>

<?php endif; ?>