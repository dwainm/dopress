<?php
/*
*	Plugin Name: DoPress
* 	Plugin URI : https://github.com/dwainm/dopress
* 	Description: An elegant to do list app built on top of WordPress. Now you own your todo list data.
*	Author: dwainm
*	Version: 2.0
* 	Author URI: http://dwainm.com
*/



/*DoPress.PHP*/

/*Security first*/

if( ! defined('ABSPATH') ){
	exit; //exit if this file is accessed directly
}


if( !class_exists('DoPress') ){

	final class DoPress{
	
		/*
		* Protected varialbe to hold reference to
		* self intatance
		* since 2.0
		*/
		protected static $_instance = null;	

		/*
		* Public variables for this plugin
		*/



		/*
		* Plubic instance creation class
		* self intatance
		* since 2.0
		*/
		public static function instance(){
				if( is_null( self::$_instance ) ){
					self::$_instance = new self();
				}
				return self::$_instance;
			}
		

		/*
		* Plubic class constructor
		* since 2.0
		*/
		public function __construct(){
			// include needed classes
			require_once('includes/admin/class-dp-admin-menus.php');
			require_once('includes/admin/class-dp-cpt-item.php');
			//require_once('includes/admin/class-dp-admin-menus.php');
			//require_once('includes/admin/class-dp-admin-menus.php');
										
			// seutp admi menu's
			$this->post_type = new dp_cpt_item();
			$this->menu = new dp_admin_menus();
			

		}	


	}

}

/*
* Load public reference to DoPress 
* after checking that it exists
*/


function DoPress(){
	return DoPress::instance();
}

// set globals for access via the old method
$GLOBALS['DoPress'] = DoPress();

// helper function to reference this plugins directory
if(! function_exists('pp')){
	function pp(){
		return plugin_dir_url(__FILE__);
	}
}