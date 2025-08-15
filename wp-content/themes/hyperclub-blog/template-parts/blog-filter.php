<?php

$uncategorized = get_category_by_slug('uncategorized');
$uncategorized_id = $uncategorized ? $uncategorized->term_id : 0;

$categories = get_categories(array(
  'orderby' => 'name',
  'order' => 'ASC',
  'hide_empty' => false,
  'exclude' => $uncategorized_id,
));
?>

<form method="get" action="<?php echo esc_url(home_url('/')); ?>">
  <div class="dropdown">
    <button id="dropdownButton" class="dropdown-button" type="button" aria-haspopup="true" aria-expanded="false">All
      Categories</button>
    <div id="dropdownMenu" class="dropdown-menu" aria-labelledby="dropdownButton">
      <div class="dropdown-item" data-value="">All Categories</div>
      <?php
      foreach ($categories as $category_item) {
        echo '<div class="dropdown-item" data-value="' . esc_attr($category_item->slug) . '">' . esc_html($category_item->name) . '</div>';
      }
      ?>
    </div>
  </div>
  <input type="hidden" name="category" id="hiddenCategoryInput"
    value="<?php echo esc_attr($_GET['category'] ?? ''); ?>">
  <div class="search-block">
    <input type="text" name="s" id="searchInput" placeholder="Search" value="<?php echo esc_attr($_GET['s'] ?? ''); ?>">
    <button type="submit" class="search-button">
      <img src="<?php echo esc_url(get_template_directory_uri() . "/src/images/search-icon.svg") ?>" alt="">
    </button>
  </div>
</form>