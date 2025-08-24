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

      <a href="https://www.hyperclub.xyz" class="logo-wrap">
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
          <div class="burger-nav-close">
            <img src="<?php echo get_template_directory_uri() . "/src/icons/close.svg" ?>" alt="close" />
          </div>
          <div class="burger-nav">
            <?php
            wp_nav_menu(array(
              'theme_location' => 'header-nav',

            ));
            ?>
          </div>

          <a href="/login" class="login-button-mobile">
            Login
          </a>

        </div>
      </div>
    </div>
  </header>