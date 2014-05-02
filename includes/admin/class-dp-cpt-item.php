<?php

if(!defined('ABSPATH')) exit;

class dp_cpt_item{

	private $post_type_name ='';
	private $supports = array();

	public function __construct(){
		// register post type
		$this->post_type_name = 'item';
		$this->supports = array( 'title', 'editor', 'page-attributes' );


		add_action('admin_init', array($this,'registerPostType')  );
		
	}

	public function registerPostType() {


		$single = $this->post_type_name;
 		$plural = $single.'s';
 		$supports = $this->supports;

	    $labels = array(
	        'name' => _x( $plural, 'post type general name' ),
	        'singular_name' => _x( "$single", 'post type singular name' ),
	        'add_new' => _x( "Add New $single", "$single" ),
	        'add_new_item' => __( "Add New $single" ),
	        'edit_item' => __( "Edit $single" ),
	        'new_item' => __( "New $single" ),
	        'all_items' => __( "All $plural" ),
	        'view_item' => __( "View $single" ),
	        'search_items' => __( "Search $plural" ),
	        'not_found' => __( "No $plural found" ),
	        'not_found_in_trash' => __( "No $single found in Trash" ),
	        'parent_item_colon' => '',
        	'menu_name' => $plural
	    );
	    $args = array(
	        'labels' => $labels,
	        'public' => true,
	        'publicly_queryable' => true,
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'query_var' => true,
	        'rewrite' => true,
	        'capability_type' => 'post',
	        'has_archive' => true,
	        'hierarchical' => false,
	        'menu_position' => 1,
	        'supports' => ( $supports ) ? $supports : array( 'title', 'editor', 'page-attributes' )
	    );

	    register_post_type( $single, $args );

	}
}

?>