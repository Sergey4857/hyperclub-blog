<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package hyperclub-blog
 */

get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$search_query = get_search_query();
$category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

$args = [
	'post_type' => 'post',
	'posts_per_page' => 10,
	'paged' => $paged,
];


if (!empty($search_query)) {
	$args['s'] = $search_query;
}


if (!empty($category)) {
	$args['category_name'] = $category;
}

$query = new WP_Query($args);

if (!empty($category)) {
	$category_obj = get_category_by_slug($category);
}
?>
<main class="blog-content">
	<section class="blog-search-container">
		<div class="blog-header">
			<h1>Blog</h1>


			<?php if (!empty($search_query)): ?>
				<div class="search-notify">Articles containing "<?php echo esc_html($search_query); ?>"</div>
			<?php endif; ?>

			<?php

			if ($query->have_posts()) {
				$total_posts = $query->found_posts;
				$posts_per_page = $query->get('posts_per_page');
				$current_page = max(1, $paged);
				$start = ($current_page - 1) * $posts_per_page + 1;
				$end = min($start + $posts_per_page - 1, $total_posts);
			} else {
				$total_posts = 0;
				$start = 0;
				$end = 0;
			}
			?>

			<p class="search-results">
				<?php if ($total_posts > 0): ?>
					Showing <?php echo esc_html($start); ?>-<?php echo esc_html($end); ?> of <?php echo esc_html($total_posts); ?>
					articles
				<?php else: ?>
					No articles found.
				<?php endif; ?>
			</p>

			<?php get_template_part('template-parts/blog-posts', null, ['query' => $query, 'pagination' => true]); ?>
		</div>
	</section>
</main>
<?php
get_footer();
?>