<?php

$query = isset($args['query']) ? $args['query'] : $wp_query;
$pagination = isset($args['pagination']) ? $args['pagination'] : "";
?>

<?php if ($query->have_posts()): ?>
  <ul class="blog-posts">
    <?php while ($query->have_posts()):
      $query->the_post(); ?>
      <li class="post-item">
        <a class="post-link" href="<?php the_permalink(); ?>">
          <?php
          $image_url = has_post_thumbnail()
            ? esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium'))
            : esc_url(get_template_directory_uri() . '/src/images/post1.png');
          ?>

          <div class="post-img" style="background-image: url('<?php echo $image_url; ?>');"
            aria-label="<?php the_title_attribute(); ?>"></div>
        </a>
        <div class="post-block">
          <a href="<?php the_permalink(); ?>">
            <h2>
              <?php the_title(); ?>
            </h2>
          </a>
          <div class="post-text"><?php the_excerpt(); ?></div>
          <div class="info-block">
            <div class="info-category">
              <?php the_category(', '); ?>
            </div>
            <div class="info-time">
              <?php the_time('d/m/Y'); ?>
            </div>

            <div class="reading-time">
              <?php
              $content = get_the_content();
              $content = strip_tags($content);
              $word_count = str_word_count($content);
              $reading_speed = 220;
              $reading_time = ceil($word_count / $reading_speed);
              echo sprintf(__('%d min read', 'hyperclub-blog'), $reading_time);
              ?>
            </div>

          </div>
          <div class="author-block">
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="author-link">
              <div class="author"><?php the_author(); ?>
              </div>
              <?php if (function_exists('get_field')): ?>
                <div class="author-position">
                  <?php echo esc_html(get_field('author_position', 'user_' . get_the_author_meta('ID'))); ?>
                </div>
              <?php endif; ?>
            </a>
          </div>
        </div>
      </li>
    <?php endwhile; ?>
  </ul>

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