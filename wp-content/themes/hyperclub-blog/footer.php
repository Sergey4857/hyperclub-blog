<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package investment
 */

?>


<footer class="footer-section">
  <div class="footer">
    <div class="footer-first">
      
 
    <div class="footer-logo">
      <img class="logo-image" alt="logo" src="<?php echo get_template_directory_uri() . '/src/icons/logo.svg'; ?>" />
      Hyper Club
    </div>

        <div class="footer-privacy-block">
      <div class="footer-privacy">
        © Copyright 2025. All rights reserved
      </div>
  
    </div>

   </div>

   <div class="footer-second">
    <div class="footer-nav">
    <?php
    wp_nav_menu(array(
      'theme_location' => 'footer-1',
      'container' => false,
      'menu_class' => 'footer-nav-list',
    ));
    ?>
    </div>
    <ul class="footer-social-list">
      <li class="footer-social-item">
        <a class="footer-social-link" href="/">
          <img class="footer-social-icon" alt="logo" src="<?php echo get_template_directory_uri() . '/src/icons/facebook.svg'; ?>" />
        </a>
      </li>
      <li class="footer-social-item"></li>
      <li class="footer-social-item"></li>
      <li class="footer-social-item"></li>
    </ul>

    
    
   </div>

  </div>
</footer>


<?php wp_footer(); ?>

</body>

</html>