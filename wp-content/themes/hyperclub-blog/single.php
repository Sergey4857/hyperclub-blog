<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hyperclub-blog
 */

get_header();
$category = get_the_category();
$category = $category[0];
$category_link = get_category_link($category->term_id);
$posttags = get_the_tags();
?>
<main class="blog-content">
	<section class="single-header-container single-post">
		<div class="left_bar">
			<div class="breadcrumbs-wrap">
				<nav aria-label="breadcrumb">
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/blog/">Blog</a></li>
						<li class="breadcrumb-item">
							<a href="<?php echo $category_link; ?>">
								<?php echo esc_html($category->name); ?>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>

		<div class="post_head">
			<div class="right_bar">
				<div class="read-block">

					<div class="read-time">
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


				<h1><?php the_title(); ?></h1>


				<div class="post-wrap">
					<div class="post-category"><?php the_category(', '); ?></div>
					<div class="post-data"><?php the_time('d/m/Y'); ?></div>
				</div>

				<?php
				$image_url = has_post_thumbnail()
					? esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large'))
					: esc_url(get_template_directory_uri() . '/src/images/post1.png');
				?>

				<div class="post-main-image" style="background-image: url('<?php echo $image_url; ?>');"
					aria-label="<?php the_title_attribute(); ?>');">
				</div>

			</div>

		</div>

		<div class="post-content">


			<?php if (have_posts()):
				while (have_posts()):
					the_post(); ?>


					<div class="post-content-wrap">
						<?php the_content(); ?>
					</div>

					<span class="decor-line"></span>
					<div class="post-tags">
						<h4>Tags</h4>
						<div class="tags"><?php the_tags('', ' ', ''); ?></div>
					</div>
					<span class="decor-line"></span>
					<div class="share">
						<h4>Share this article:</h4>
						<div class="share-links">

							<a href="https://www.linkedin.com/shareArticle?url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>"
								target="_blank" rel="noopener noreferrer">
								<img src="<?php echo get_template_directory_uri(); ?>/src/images/linkedin.svg" alt="Share on LinkedIn">
							</a>

							<a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
								target="_blank" rel="noopener noreferrer">
								<img src="<?php echo get_template_directory_uri(); ?>/src/images/twitter.svg" alt="Share on Twitter">
							</a>

							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
								target="_blank" rel="noopener noreferrer">
								<img src="<?php echo get_template_directory_uri(); ?>/src/images/facebook.svg" alt="Share on Facebook">
							</a>
						</div>
					</div>

					<div class="author-wrap">
						<?php
						$author_id = get_the_author_meta('ID');
						$author_image = get_field('author_image', 'user_' . $author_id);
						$author_description = get_field('author_description', 'user_' . $author_id);
						?>

						<?php if ($author_image): ?>
							<img class="author_image" src="<?php echo esc_url($author_image); ?>"
								alt="<?php echo esc_attr(get_the_author()); ?>">
						<?php endif; ?>

						<div class="author-subtitle">Article by</div>
						<div class="author-title">
							<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author">
								<?php echo esc_html(get_the_author()); ?>
							</a>
						</div>

						<?php if ($author_description): ?>
							<div class="author-desc">
								<?php echo $author_description; ?>
							</div>
						<?php endif; ?>

						<?php if (have_rows('author_social_networks', 'user_' . $author_id)): ?>
							<div class="author-social">
								<?php while (have_rows('author_social_networks', 'user_' . $author_id)):
									the_row();
									$social_link = get_sub_field('author_social_link');
									$social_icon = get_sub_field('author_social_icon');
									if ($social_link && $social_icon): ?>
										<a href="<?php echo esc_url($social_link); ?>" target="_blank" rel="noopener noreferrer">
											<img src="<?php echo esc_url($social_icon); ?>" alt="Social Icon">
										</a>
									<?php endif; ?>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endwhile; endif; ?>

		</div>
	</section>
	<?php
	$posttags = get_the_tags();

	if ($posttags) {
		$tag_ids = [];
		foreach ($posttags as $tag) {
			$tag_ids[] = $tag->term_id;
		}

		$related_query = new WP_Query([
			'tag__in' => $tag_ids,
			'post__not_in' => [get_the_ID()],
			'posts_per_page' => 3,
			'ignore_sticky_posts' => 1,
			'no_found_rows' => true,
		]);


		if ($related_query->have_posts()) { ?>
			<section class="related-articles">
				<h2 class="related-title">Related Articles</h2>
				<?php get_template_part('template-parts/blog-posts', null, ['query' => $related_query, 'pagination' => false]); ?>
			</section>
		<?php }
		wp_reset_postdata();
	}
	?>


</main>
<?php
get_footer();
