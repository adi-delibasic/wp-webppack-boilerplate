<?php
include_once 'includes/menus.php';

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script('main', get_stylesheet_directory_uri() . '/assets/dist/main.bundle.js', [], '1.0.0', false);
  wp_enqueue_style('main', get_stylesheet_directory_uri() . '/assets/dist/main.css', [], '1.0.0', 'all');

  wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/dd22fa3761.js');

  //Fonts
  wp_enqueue_style('wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600', false);
});


// Defer JS

function defer_parsing_of_js($url)
{
  if (is_user_logged_in()) return $url; //don't break WP Admin
  if (FALSE === strpos($url, '.js')) return $url;
  if (strpos($url, 'jquery.js')) return $url;
  return str_replace(' src', ' defer src', $url);
}
add_filter('script_loader_tag', 'defer_parsing_of_js', 10);

// Title tag support
add_theme_support('title-tag');
