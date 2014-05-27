<?php
if(! defined('ABSPATH') ){ exit(); }

 /**
 * DP_API_Endpoint (DoPress API) for setting up the enpoint upon plugin activation
 * 
 * This class sets up the plugin and makes sure the endpoint is registered 
 * @since 2.0.0
 */

class DP_API_Endpoint{

	 public function __construct(){
	 	// register dopress-api to the root url 
	 	add_action('init', array( $this, 'register_endpoint' ) );
 	}

 	 /**
	 * Register Enpoint used for external  acccess with WordPress
	 *   
	 * This function registers the enpoints and calls the enpoint_register hook 
	 * for further extension and interaction 
	 * 
	 * @access public 
	 * @return void 
	 * @since 2.0.0
	 */
	public function register_endpoint(){

		add_rewrite_endpoint( 'dopress-api', EP_ROOT );
		
		flush_rewrite_rules();
	}	
}