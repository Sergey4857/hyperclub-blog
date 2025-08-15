<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#archive
 *
 * @package hyperclub-blog
 */

get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$archive_title = '';
$archive_description = '';
$query_args = [
	'post_type' => 'post',
	'posts_per_page' => 10,
	'paged' => $paged,
];


if (is_category()) {
	$category = get_queried_object();
	if ($category && !is_wp_error($category)) {
		$archive_title = 'Articles in category "' . esc_html($category->name) . '"';
		$query_args['category_name'] = $category->slug;
	}
} elseif (is_tag()) {
	$tag = get_queried_object();
	if ($tag && !is_wp_error($tag)) {
		$archive_title = 'Articles tagged "' . esc_html($tag->name) . '"';
		$query_args['tag'] = $tag->slug;
	}
} else {
	$archive_title = get_the_archive_title();
}

$query = new WP_Query($query_args);

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
<main class="blog-content">
	<section class="blog-search-container">
		<div class="blog-header">
			<h1>Blog</h1>
			<?php get_template_part('template-parts/blog-filter'); ?>

			<?php if (!empty($archive_title)): ?>
				<div class="search-notify"><?php echo esc_html($archive_title); ?></div>
			<?php endif; ?>

			<p class="search-results">
				<?php if ($total_posts > 0): ?>
					Showing <?php echo esc_html($start); ?>-<?php echo esc_html($end); ?> of <?php echo esc_html($total_posts); ?>
					articles
				<?php else: ?>
					No articles found.
				<?php endif; ?>
			</p>

			<?php get_template_part('template-parts/blog-posts', null, ['query' => $query, 'pagination' => true], ); ?>

			<?php wp_reset_postdata(); ?>

		</div>
	</section>
</main>
<?php
get_footer();
?>