<?php
/**
* Plugin Name: New User Approve Require
* Description: This plugin allows create New User Approve Require plugin.
* Version: 1.0
* Copyright: 2020
* Text Domain: new-user-approve-require
* Domain Path: /languages 
*/


if (!defined('ABSPATH')) {
	exit();
}
if (!defined('NUAR_PLUGIN_NAME')) {
  define('NUAR_PLUGIN_NAME', 'New user Approve Require');
}
if (!defined('NUAR_PLUGIN_VERSION')) {
  define('NUAR_PLUGIN_VERSION', '2.0.0');
}
if (!defined('NUAR_PLUGIN_FILE')) {
  define('NUAR_PLUGIN_FILE', __FILE__);
}
if (!defined('NUAR_PLUGIN_DIR')) {
  define('NUAR_PLUGIN_DIR',plugins_url('', __FILE__));
}
if (!defined('NUAR_BASE_NAME')) {
    define('NUAR_BASE_NAME', plugin_basename(NUAR_PLUGIN_FILE));
}
if (!defined('NUAR_DOMAIN')) {
  define('NUAR_DOMAIN', 'new-user-approve-require');
}

if (!class_exists('NUAR')) {

	class NUAR {

  	protected static $NUAR_instance;

  	public static function load_plugin() {
  		$args = array('orderby' => 'ID');
			$wp_user_query = new WP_User_Query($args);
			$users = $wp_user_query->results;
			foreach ($users as $value) {
				if($value->roles != 'administrator'){
					update_user_meta($value->ID, 'approval_confirmation', 'confirm_approve');
				}
			}
		}		

  	public static function NUAR_instance() {
    	if (!isset(self::$NUAR_instance)) {
      	self::$NUAR_instance = new self();
      	self::$NUAR_instance->init();
      	self::$NUAR_instance->includes();
    	}
    	return self::$NUAR_instance;
    }

  	function init() {	      	
    	add_action( 'admin_enqueue_scripts', array($this, 'NUAR_load_admin_script_style'));
    	add_action( 'wp_enqueue_scripts',  array($this, 'NUAR_load_script_style'));
  		add_filter( 'plugin_row_meta', array( $this, 'NUAR_plugin_row_meta' ), 10, 2 );
    }

    function includes() {
    	include_once('includes/nuar-common.php');
    	include_once('includes/nuar-backend.php');
    	include_once('includes/nuar-frontend.php');
    	if ( ! class_exists( 'WP_List_Table' ) ) {
		    require_once( NUAR_PLUGIN_FILE . 'wp-admin/includes/class-wp-list-table.php' );
			}
    }

   	function NUAR_load_admin_script_style() {
      wp_enqueue_style( 'nuar-backend-css', NUAR_PLUGIN_DIR.'/assets/css/nuar-backend.css', false, '1.0' );
    }

    function NUAR_load_script_style() {
    	wp_enqueue_script('jquery', false, array(), false, false);
    }

    function NUAR_plugin_row_meta( $links, $file ) {
      if ( NUAR_BASE_NAME === $file ) {
        $row_meta = array(
          'rating'    =>  '<a href="https://xthemeshop.com/new-user-approve-require/" target="_blank">Documentation</a> | <a href="https://xthemeshop.com/contact/" target="_blank">Support</a> | <a href="https://wordpress.org/support/plugin/new-user-approve-require/reviews/?filter=5" target="_blank"><img src="'.NUAR_PLUGIN_DIR.'/images/star.png" class="nuar_rating_div"></a>'
        );
        return array_merge( $links, $row_meta );
      }
      return (array) $links;
    }
	}
	add_action('plugins_loaded', array('NUAR', 'NUAR_instance'));
	register_activation_hook( __FILE__, array('NUAR', 'load_plugin' ));
}


add_action( 'plugins_loaded', 'NUAR_load_textdomain' );
function NUAR_load_textdomain() {
    load_plugin_textdomain( 'new-user-approve-require', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

function NUAR_load_my_own_textdomain( $mofile, $domain ) {
    if ( 'new-user-approve-require' === $domain && false !== strpos( $mofile, WP_LANG_DIR . '/plugins/' ) ) {
        $locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
        $mofile = WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/languages/' . $domain . '-' . $locale . '.mo';
    }
    return $mofile;
}
add_filter( 'load_textdomain_mofile', 'NUAR_load_my_own_textdomain', 10, 2 );

?>