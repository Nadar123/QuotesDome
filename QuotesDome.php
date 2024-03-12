<?php 
/*
  Plugin Name: QuotesDome Plugin
  Description: Quotes plugin
  Description: QuotesDome help you manage and showcase quotes on your WordPress site.
  Version: 1.0
  Author: Nadar Rossano
  Author URI: https://nosite.org
  Text Domain: quotesDomedomin
*/


if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

// Require the custom post type registration
require_once plugin_dir_path( __FILE__ ) . 'includes/PostTypes/PostType.php';

// Include your custom functions file
require_once plugin_dir_path( __FILE__ ) . 'includes/themeSupport/custom-theme-support.php';

// Require the meta box functions
include_once 'includes/metaBox/meta-boxes.php';
//$quote_meta_box = new Quote_Meta_Box();

// Require shortcode class
require_once 'shortcode/shortcodes.php';
// $random_quote_shortcode = new Random_Quote_Shortcode();

// Require the Enqueue Scripts and Styles
require_once plugin_dir_path( __FILE__ ) . 'includes/enqueue/enqueue-scripts.php';

// Register widgets and other functionalities
require_once plugin_dir_path( __FILE__ ) . 'includes/widget/random-quote-widget.php';

// Register the footer widget area
require_once plugin_dir_path( __FILE__ ) . 'includes/widget/register-footer-widget.php';

// Require ajax filter quotes
require_once plugin_dir_path( __FILE__ ) . 'includes/ajax/ajax.php';

// Include settings page random quote
include_once(plugin_dir_path(__FILE__) . 'admin/admin-page.php');
include_once(plugin_dir_path(__FILE__) . 'includes/settingPage/plugin-settings.php');
include_once(plugin_dir_path(__FILE__) . 'includes/settingPage/display-quotes.php');

// Include custom get template function
include_once plugin_dir_path( __FILE__ ) . 'functions/custom-functions.php';
