<?php
/**
*	Plugin Name: DoPress
* 	Plugin URI : https://github.com/dwainm/dopress
* 	Description: Run your own todo list. DoPress is an elegant to do list app built on top of WordPress. 
*				 It will take the page you choose and turn it into your a todo list. The list items are 
*				 stored for per user.
*	Author: dwainm
* 	Requires at least: 3.8
* 	Author URI: http://dwainm.com
*	License: GPLv2
*/

if( ! defined('ABSPATH') ){ exit; } // exit if this file is accessed directly



if( !class_exists('DoPress') ){

	final class DoPress{
	
		/*
		* Protected varialbe to hold reference to
		* self intatance
		* since 2.0
		*/
		protected static $_instance = null;	

		/**
		* Public variables for this plugin
		* @var $_PATH
		*/
		protected $_PATH;


		/**
		* private hoding class for the settings object
		*
		* @var $_PATH
		*/
		protected $settings;
		
		/*
		*
		*/
		protected $_URL;


		/**
		* Plubic instance creation class
		* self intatance
		* @since:  2.0
		*/
		public static function instance(){
				if( is_null( self::$_instance ) ){
					self::$_instance = new self();
				}
				return self::$_instance;
		}
		

		/**
		* The DoPress Class constructor
		* @since 2.0.0
		* @author @dwainm
		* @todo regist 'dopress' text domain
		*/
		public function __construct(){

			register_activation_hook( __FILE__ , array( $this, 'activate' ) );

			// include plugin files
			$this->includes();

			//intiate the api
			$this->api_endpoint = new DP_API_Endpoint();
			$this->api_interface = new DP_API_Interface();

			// seutp admin menu's
			$this->post_type = new dp_cpt_item();
			$this->settings = new dp_admin_settings();
			
			register_deactivation_hook( __FILE__ , array( $this, 'deactivate' ) );
		}

		/**
		*  @author Dwain Maralack 
		*  @since	
		*  setup plugin path and URL
		*/	

		// helper function to reference this plugins directory
		private function path_url_initialize (){
			// assing to global internal variables
				$_PATH = plugin_dir_path( __FILE__);
				$_URL = plugins_url( '', __FILE__);
		}

		/** 
		* included the files neeeded
		* 
		* @since 2.0.0
		*/
		private function includes(){			
			
			// admin
			require_once('includes/admin/class-dp-cpt-todo.php');
			require_once('includes/admin/class-dp-admin-settings.php');

			//front end
			require_once('includes/class-dp-api-endpoint.php');
			require_once('includes/class-dp-api-interface.php');
						
		}



		/**
		* Register the activation hook needed to setup the plugin
		* @access public 
		* @author dwainm
		* @since 2.0
		*/

		public function activate(){
			// initialize the API endpoint and listeners
			// delete data when deactivate 

		}

		/**
		* Register the de-activation hook
		* @access public 
		* @author dwainm
		* @since 2.0
		*/

		public function deactivate(){
			//ad any activation stuff here
		}

	}// end class DoPress

} // end if class exists


/*
* Load public reference to DoPress 
* after checking that it exists
*/

function DoPress(){
	return DoPress::instance();
}


// set globals for access via the old method
$GLOBALS['DoPress'] = DoPress();

// setup wordpress hooks
