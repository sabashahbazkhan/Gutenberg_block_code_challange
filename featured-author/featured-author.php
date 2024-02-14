<?php

/*
  Plugin Name: Featured Author Block Type
  Version: 1.0
  Author: Saba Shahbaz
  Author URI: https://www.linkedin.com/in/sabashahbaz/
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once plugin_dir_path(__FILE__) . 'inc/generateAuthorHTML.php';
/*
 * Main class of trewplugin/featured-author plugin.
 */
class FeaturedAuthor {
  function __construct() {
    add_action('init', [$this, 'onInit']);
    add_action('rest_api_init', [$this, 'authHTML']);
  }
  function onInit() {
    wp_register_script('featuredAuthorScript', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-i18n', 'wp-editor'));
    wp_register_style('featuredAuthorStyle', plugin_dir_url(__FILE__) . 'build/index.css');

    register_block_type('trewplugin/featured-author', array(
      'render_callback' => [$this, 'renderCallback'],
      'editor_script' => 'featuredAuthorScript',
      'editor_style' => 'featuredAuthorStyle'
    ));
  }
/*
 * for the preview of author block in admin side
 */
  function renderCallback($attributes) {
    if (isset($attributes['authId'])) {
      wp_enqueue_style('featuredAuthorStyle');
      return generateAuthorHTML($attributes['authId']);
    } else {
      return NULL;
    }
  }

/*
 * Registering API end point
 */
  function authHTML() {
    register_rest_route('featuredAuthor/v1', 'getHTML', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => [$this, 'getAuthHTML']
    ));
  }

  function getAuthHTML($data) {
      return generateAuthorHTML($data['authId']);
  }


}

$featuredAuthor = new FeaturedAuthor();