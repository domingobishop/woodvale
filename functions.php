<?php

// Included functions
include 'functions-admin.php';
include 'functions-global.php';

// add_action
add_action( 'wp_enqueue_scripts', 'wood_styles' );
add_action( 'wp_enqueue_scripts', 'wood_scripts' );
add_action( 'after_setup_theme', 'register_wood_menu' );

// Theme support
add_theme_support( 'post-thumbnails' );

// add_filter
add_filter('excerpt_more', 'new_excerpt_more');
add_filter('the_content', 'add_image_responsive_class');
add_filter( 'wp_title', 'wood_wp_title', 10, 2 );
