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
      <a href="/">
        <img class="logo-image" alt="logo" src="<?php echo get_template_directory_uri() . '/src/icons/logo.svg'; ?>" />
        Hyper Club
      </a>
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
          <img class="footer-social-icon" alt="telegram" src="<?php echo get_template_directory_uri() . '/src/icons/telegram.svg'; ?>" />
        </a>
      </li>
      <li class="footer-social-item">  <a class="footer-social-link" href="/">
          <img class="footer-social-icon" alt="discord" src="<?php echo get_template_directory_uri() . '/src/icons/discord.svg'; ?>" />
        </a></li>
      <li class="footer-social-item">  <a class="footer-social-link" href="/">
          <img class="footer-social-icon" alt="twitter" src="<?php echo get_template_directory_uri() . '/src/icons/twitter.svg'; ?>" />
        </a></li>
      <li class="footer-social-item">  <a class="footer-social-link" href="/">
          <img class="footer-social-icon" alt="instagram" src="<?php echo get_template_directory_uri() . '/src/icons/instagram.svg'; ?>" />
        </a></li>
           <li class="footer-social-item">  <a class="footer-social-link" href="/">
          <img class="footer-social-icon" alt="youtube" src="<?php echo get_template_directory_uri() . '/src/icons/youtube.svg'; ?>" />
        </a></li>
    </ul>

    
    
   </div>

  </div>
</footer>


<?php wp_footer(); ?>

</body>

</html>