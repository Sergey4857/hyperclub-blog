<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header class="header-section">
    <div class="header">

      <a href="/" class="logo-wrap">
        <div class="logo">
          <img class="logo-image" alt="logo"
            src="<?php echo get_template_directory_uri() . "/src/icons/logo.svg" ?>" />Hyper Club
        </div>
      </a>


      <nav class="header-nav">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'header-nav',
       
        ));
        ?>
      </nav>
      <div class="language-switcher">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'language-switcher',
        ));
        ?>
      </div>


      <a href="/login" class="login-button">
        Login
      </a>


      <div class="burger-button">

      </div>

      <div class="burger-backdrop">
        <div class="burger-nav-wrap">
          <div class="burger-nav">
            <div class="burger-wrapper">
              <div class="burger-title">
                Services
              </div>
              <div class="burger-block">
                <a href="/" class="burger-link">
                  Buy TikTok <span class="highlight-likes">Likes</span>
                </a>
                <a href="/buy-tiktok-followers" class="burger-link">
                  Buy TikTok <span class="highlight-followers">Followers</span>
                </a>
                <a href="/buy-tiktok-views" class="burger-link">
                  Buy TikTok <span class="highlight-views">Views</span>
                </a>
              </div>
            </div>

            <div class="burger-wrapper">
              <div class="burger-title">
                Free Tools
              </div>
              <div class="burger-block">
                <a href="#" class="burger-link soon">
                  Free TikTok Video Downloader
                </a>
                <a href="#" class="burger-link soon">
                  Free TikTok Likes
                </a>
                <a href="#" class="burger-link soon">
                  Free TikTok Views
                </a>
                <a href="#" class="burger-link soon">
                  Free TikTok Followers
                </a>
              </div>
            </div>
            <div class="burger-wrapper">
              <div class="burger-title">
                About
              </div>

              <div class="burger-block">


                <a href="/blog" class="burger-link">
                  Blog
                </a>
                <a href="/privacy-policy" class="burger-link">
                  Privacy Policy
                </a>
                <a href="/terms-of-use" class="burger-link">
                  Terms of Use
                </a>
                <a href="#" class="burger-link">
                  Live Support
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>