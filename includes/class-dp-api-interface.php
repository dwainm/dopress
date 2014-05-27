<?php
if(! defined('ABSPATH') ){ exit(); }

 /**
 * DP_API_Interface (DoPress API) The main external interface 
 * 
 * This class will be the main point of contact for localized variable injection and handle 
 * all incomming messages. It  will implement a PUB/SUB pattern allowing any class inside 
 * this plugin to  listen to precicely defined interfaces and incomming  actions. 
 *
 */

class DP_API_Interface{

	 public function __construct(){

	 	//intercept the dopress-api request on template redirect
	 	add_action('template_redirect', array($this, 'proecess_request') );
	 	add_filter('dopress_localize_data', array($this, 'localize_api_data')   );
 	}

	 /**
	 * Process all incomming requests
	 *   
	 * This function listens at the main point of externall access and notifies 
	 * the  listeners 
	 * 
	 * @access public 
	 * @return void 
	 */
	public function proecess_request(){

		global $wp_query, $wp_rewrite;

		// if this is not a request for dopress then do nothing
    	if ( ! isset( $wp_query->query_vars['dopress-api'] ) ){
    		return;
    	}

    	// check if the rewrite rule is active if not call this plugins
    	echo '{dopress: "on"} ';

    	// do not render any other data 
        exit;
	}

	 /**
	 * Localize all plugin data for local consumption
	 *   
	 * This function listens at the main point of externall access and notifies 
	 * the  listeners 
	 * 
	 * @access public 
	 * @return void 
	 */
	public function localize_api_data( $data ){
		// if user is logged and is on dopress page
		if( !is_user_logged_in() ){  return; } // the user doens't get any access

		// get a apply the current sites url
		$api_url = $this->get_home_url();



		//nonce to allow user to post data and get data
		$nonce = wp_create_nonce('dopress-nonce');


		// add dat to be ocalized
		$data['apiURL'] = $api_url;
		$data['nonce'] = $nonce;

		return $data;
	
	}

	 /**
	 * Determine the current sites url 
	 * 
	 * @access protected 
	 * @return void 
	 */
	protected function get_home_url(){

		// if permalinks is used change the dopress url accordingly

		$url = '';

		if( get_option('permalink_structure') ){
			$url = home_url( $path = '/' ).'dopress-api';
		}else{
			$url = home_url( $path = '/' ).'?dopress-api';
		}

		return $url;
	}

}