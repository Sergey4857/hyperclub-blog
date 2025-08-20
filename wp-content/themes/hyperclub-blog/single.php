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
		<!-- Breadcrumbs -->
		<div class="breadcrumbs-container">
			<nav aria-label="breadcrumb">
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="/blog/">Blog</a></li>
					<li class="breadcrumb-item">
						<a href="<?php echo $category_link; ?>">
							<?php echo esc_html($category->name); ?>
						</a>
					</li>
					<li class="breadcrumb-item active"><?php the_title(); ?></li>
				</ul>
			</nav>
		</div>

		<div class="post-title-container">
			<h1><?php the_title(); ?></h1>
		</div>

		<div class="post-banner-container">
			<?php
			$image_url = has_post_thumbnail()
				? esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large'))
				: esc_url(get_template_directory_uri() . '/src/images/post1.png');
			?>
			<div class="post-main-image" style="background-image: url('<?php echo $image_url; ?>');"
				aria-label="<?php the_title_attribute(); ?>">
			</div>
		</div>


		<div class="post-meta-container">
			<div class="meta-item">
				<span class="meta-icon author-icon"></span>
				<span class="meta-text"><?php the_author(); ?></span>
			</div>
			<div class="meta-item">
				<span class="meta-icon calendar-icon"></span>
				<span class="meta-text"><?php the_time('d/m/Y'); ?></span>
			</div>
			<div class="meta-item">
				<span class="meta-icon read-icon"></span>
				<span class="meta-text">
					<?php
					$content = get_the_content();
					$content = strip_tags($content);
					$word_count = str_word_count($content);
					$reading_speed = 220;
					$reading_time = ceil($word_count / $reading_speed);
					echo sprintf(__('%d min read', 'hyperclub-blog'), $reading_time);
					?>
				</span>
			</div>
			<div class="meta-item">
				<span class="meta-icon views-icon"></span>
				<span class="meta-text">
					<?php
					// Simple views implementation
					$views = get_post_meta(get_the_ID(), 'post_views', true);
					if (!$views) {
						$views = 0;
					}
					echo $views . ' views';
					?>
				</span>
			</div>
			
			<button class="toc-toggle-btn" aria-label="Open Table of Contents">
				<span class="toc-icon"></span>
				<span class="toc-text">TOC</span>
			</button>
		</div>

		<!-- Main content and sidebar -->
		<div class="post-content-sidebar">
			<!-- Main content -->
			<div class="post-content-main">
				<?php if (have_posts()):
					while (have_posts()):
						the_post(); ?>
						
						<!-- Article description -->
						<div class="post-description">
							<?php the_excerpt(); ?>
						</div>

						<!-- Article content -->
						<div class="post-content-wrap">
							<?php the_content(); ?>
						</div>

						<!-- Tags -->
						<div class="post-tags">
							<h4>Tags</h4>
							<div class="tags"><?php the_tags('', ' ', ''); ?></div>
						</div>

						<!-- Share -->
						<div class="share">
							<h4>Share this article:</h4>
							<div class="share-links">
								<a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
									target="_blank" rel="noopener noreferrer">
									<img src="<?php echo get_template_directory_uri(); ?>/src/icons/telegram.svg" alt="Share on Telegram">
								</a>
								<a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
									target="_blank" rel="noopener noreferrer">
									<img src="<?php echo get_template_directory_uri(); ?>/src/icons/twitter.svg" alt="Share on Twitter">
								</a>
								<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
									target="_blank" rel="noopener noreferrer">
									<img src="<?php echo get_template_directory_uri(); ?>/src/icons/facebook-white.svg" alt="Share on Facebook">
								</a>
							</div>
						</div>

					
					<?php endwhile; endif; ?>
			</div>

			<!-- Sidebar -->
			<div class="post-sidebar">
				<!-- Table of Contents -->
				<div class="sidebar-widget table-of-contents">
					<button class="toc-close-btn" aria-label="Close Table of Contents">
						<span class="close-icon"></span>
					</button>
					<h3>Table of Contents</h3>
					<div class="toc-content">
						<p>Content will be added automatically</p>
					</div>
				</div>

				<!-- Share -->
				<div class="sidebar-widget share-widget">
					<h3>Share</h3>
					<div class="share-buttons">
						<a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
							target="_blank" rel="noopener noreferrer" class="share-btn linkedin">
							<img src="<?php echo get_template_directory_uri(); ?>/src/icons/telegram.svg" alt="LinkedIn">
						</a>
						<a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
							target="_blank" rel="noopener noreferrer" class="share-btn twitter">
							<img src="<?php echo get_template_directory_uri(); ?>/src/icons/twitter.svg" alt="Twitter">
						</a>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
							target="_blank" rel="noopener noreferrer" class="share-btn facebook">
							<img src="<?php echo get_template_directory_uri(); ?>/src/icons/facebook-white.svg" alt="Facebook">
						</a>
					</div>
				</div>

				<!-- Related materials -->
				<div class="sidebar-widget related-materials">
					<h3>Related Materials</h3>
					<?php
					$related_query = new WP_Query([
						'post_type' => 'post',
						'posts_per_page' => 3,
						'post__not_in' => [get_the_ID()],
						'category__in' => [$category->term_id],
						'orderby' => 'date',
						'order' => 'DESC'
					]);

					if ($related_query->have_posts()): ?>
						<div class="related-posts">
							<?php while ($related_query->have_posts()): $related_query->the_post(); ?>
								<div class="related-post-item">
									<?php if (has_post_thumbnail()): ?>
										<div class="related-post-image">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail('thumbnail'); ?>
											</a>
										</div>
									<?php endif; ?>
									<div class="related-post-content">
										<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
										<div class="related-post-date"><?php the_time('d/m/Y'); ?></div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					<?php endif;
					wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</section>



	<?php echo get_template_part('template-parts/connect-section'); ?>

	<!-- Похожие статьи -->
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
?>
