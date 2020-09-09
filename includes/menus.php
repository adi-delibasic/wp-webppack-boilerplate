<?php

function beauty_theme_menu_reg()
{
  register_nav_menus(
    [
      'header' => __('Header Menu'),
      'footer' => __('Footer Menu')
    ]
  );
}

add_action('after_setup_theme', 'beauty_theme_menu_reg');
