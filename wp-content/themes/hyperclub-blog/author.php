<?php
get_header();

$author_id = get_query_var('author');

if (!$author_id || !is_numeric($author_id)) {
  wp_redirect(home_url());
  exit;
}

$author_data = get_userdata($author_id);
if (!$author_data) {
  wp_redirect(home_url());
  exit;
}

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$posts_per_page = 10;

$args = [
  'post_type' => 'post',
  'posts_per_page' => $posts_per_page,
  'paged' => $paged,
  'author' => $author_id,
];

$query = new WP_Query($args);

$total_posts = $query->found_posts;
$start_post = ($paged - 1) * $posts_per_page + 1;
$end_post = min($paged * $posts_per_page, $total_posts);
?>

<main class="blog-content">
  <div class="blog-author-container">
    <div class="author-profile">
      <div class="first-block">
        <h1><?php echo esc_html($author_data->display_name); ?></h1>
        <p class="author-position"><?php echo get_field('author_position', 'user_' . $author_id); ?></p>
        <?php if (have_rows('author_recognition', 'user_' . $author_id)): ?>

          <div class="author-recognition-block">


            <div class="author-recognition-title">
              <?php echo get_field('author_recognition_title', 'user_' . $author_id); ?>
            </div>

            <ul class="author_recognition_list">
              <?php while (have_rows('author_recognition', 'user_' . $author_id)):
                the_row(); ?>

                <li class="author_recognition_item">
                  <a href="<?php echo get_sub_field('author_recognition_link'); ?>" target="_blank"
                    rel="noopener noreferrer">
                    <img src="<?php echo get_sub_field('author_recognition_image'); ?>" alt="recognition_image">
                    <div class="recognition_text"><?php echo get_sub_field('recognition_text'); ?></div>
                  </a>
                </li>
              <?php endwhile; ?>
            </ul>
          </div>

        <?php endif; ?>
        <div class="author-description"><?php echo get_field('author_description', 'user_' . $author_id); ?></div>
      </div>
      <div class="second-block">
        <?php if (get_field('author_image', 'user_' . $author_id)): ?>
          <img class="author_image" src="<?php echo esc_url(get_field('author_image', 'user_' . $author_id)); ?>"
            alt="<?php echo esc_attr($author_data->display_name); ?>">
        <?php endif; ?>

        <div class="author-social">
          <?php if (have_rows('author_social_networks', 'user_' . $author_id)): ?>
            <?php while (have_rows('author_social_networks', 'user_' . $author_id)):
              the_row(); ?>
              <a href="<?php echo esc_url(get_sub_field('author_social_link')); ?>" target="_blank"
                rel="noopener noreferrer">
                <img src="<?php echo esc_url(get_sub_field('author_social_icon')); ?>" alt="Social Icon">
              </a>
            <?php endwhile; ?>

          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="author-posts">
      <h2>Articles by <?php echo esc_html($author_data->display_name); ?></h2>
      <p class="search-results">
        Showing <?php echo $start_post; ?>-<?php echo $end_post; ?> of <?php echo $total_posts; ?> articles
      </p>
      <?php get_template_part('template-parts/blog-posts', null, ['query' => $query, 'pagination' => true]); ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>