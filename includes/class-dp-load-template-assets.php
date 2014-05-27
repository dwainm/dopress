<?php

if(! defined('ABSPATH') ){ exit(); }

 /**
 * DP_Load_template_assets responsible for loading all assets ( data, scripts, styles )
 * 
 * 
 * This class sets up the plugin and makes sure the endpoint is registered 
 * @since 2.0.0
 */

 class DP_Load_template_assets{
 	/**
 	* Constructor fucntion responsible for delegating functionaility
 	* @access public
	* @since 2.0.0
 	*/

 	public function __construct(){

 		if( DOPRESS_PAGE  && DOPRESS_PAGE == true ) {

 			add_action( 'wp_enqueue_scripts',  array( $this, 'load_styles' ) ) ;
	 		add_action( 'wp_footer'	,  array( $this, 'load_scripts' ) ) ;
	 		add_action( 'wp_footer' ,  array( $this, 'localize_data' )  );

 		}
	 	
 	}

 	/**
 	* Load front end styles
 	*
 	* @access public
 	* @since 2.0.0
 	* @return void
 	*/
 	public function load_styles(){
 		wp_enqueue_style( 'dopress-css',   plugin_dir_url(__FILE__).'../assets/css/style.css' );
 	}	

 	/**
 	* Load front end footer scripts
 	*
 	* @access public
 	* @since 2.0.0
 	* @return void
 	*/
 	public function load_scripts(){

 		wp_enqueue_script( 'jquery');
 		wp_enqueue_script( 'underscore');	
 		wp_enqueue_script( 'backbone');

 		//load models
 		wp_enqueue_script( 'dopress-js-model-item',  plugin_dir_url(__FILE__).'../assets/js/models/item.js' , array('jquery','underscore','backbone') ) ;
 		wp_enqueue_script( 'dopress-js-model-app',  plugin_dir_url(__FILE__).'../assets/js/models/app.js' , array('jquery','underscore','backbone') ) ;

 		//load collections
 		wp_enqueue_script( 'dopress-js-collection-items',  plugin_dir_url(__FILE__).'../assets/js/collections/items.js' , array('jquery','underscore','backbone') ) ;
	
	 	//load views
 		wp_enqueue_script( 'dopress-js-view-item',  plugin_dir_url(__FILE__).'../assets/js/views/item.js' , array('jquery','underscore','backbone') ) ;
 		wp_enqueue_script( 'dopress-js-view-form',  plugin_dir_url(__FILE__).'../assets/js/views/form.js' , array('jquery','underscore','backbone') ) ;
 		wp_enqueue_script( 'dopress-js-view-list',  plugin_dir_url(__FILE__).'../assets/js/views/list.js' , array('jquery','underscore','backbone') ) ;
 		wp_enqueue_script( 'dopress-js-view-footer',  plugin_dir_url(__FILE__).'../assets/js/views/footer.js' , array('jquery','underscore','backbone') ) ;
 		wp_enqueue_script( 'dopress-js-view-app',  plugin_dir_url(__FILE__).'../assets/js/views/app.js' , array('jquery','underscore','backbone') ) ;
 	}

 	/**
 	* Load front end footer scripts
 	*
 	* @access public
 	* @since 2.0.0
 	* @return void
 	*/
 	public function localize_data(){

 		$data = array( 'version'=>DOPRESS_VERSION);

 		$data  = apply_filters( 'dopress_localize_data' , $data  );

 		wp_localize_script( 'dopress-js-view-app', 'dopress', $data );
 
 	}	 	


 	

 }