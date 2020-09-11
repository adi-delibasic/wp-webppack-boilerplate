<?php
include_once 'includes/menus.php';

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script('main', get_stylesheet_directory_uri() . '/assets/dist/main.bundle.js', [], '1.0.0', false);
  wp_enqueue_style('main', get_stylesheet_directory_uri() . '/assets/dist/main.css', [], '1.0.0', 'all');

  wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/dd22fa3761.js');

  //Fonts
  wp_enqueue_style('wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600', false);
});


// Defer or async JS

add_filter('script_loader_tag', 'add_defer_tags_to_scripts');
function add_defer_tags_to_scripts($tag)
{
  # List scripts to add attributes to
  $scripts_to_defer = array('main.bundle.js', 'script_b');
  $scripts_to_async = array('script_c', 'script_d');

  # add the defer tags to scripts_to_defer array
  foreach ($scripts_to_defer as $current_script) {
    if (true == strpos($tag, $current_script))
      return str_replace(' src', ' defer="defer" src', $tag);
  }

  # add the async tags to scripts_to_async array
  // foreach ($scripts_to_async as $current_script) {
  //   if (true == strpos($tag, $current_script))
  //     return str_replace(' src', ' async="async" src', $tag);
  // }
  return $tag;
}

// Title tag support
add_theme_support('title-tag');
