<?php
/* Template Name: Blog main page */

get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$selected_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
$search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

$args = [
    'post_type' => 'post',
    'posts_per_page' => 10,
    'paged' => $paged,
    's' => $search_query,
];

if (!empty($selected_category)) {
    $args['category_name'] = $selected_category;
}

$query = new WP_Query($args);
?>

<main class="blog-content">
    <section class="blog-header-container">
        <div class="blog-header">
            <h1><?php _e('Blog', 'hyperclub-blog'); ?></h1>
            <?php get_template_part('template-parts/blog-filter'); ?>
            <?php get_template_part('template-parts/blog-posts', null, ['query' => $query, 'pagination' => false]); ?>

        </div>
    </section>
</main>

<?php
get_footer();
?>