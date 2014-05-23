<?php

if(!defined('ABSPATH')) exit;
	
class dp_cpt_item{

	/**
	*	post type name storage
	*	@var $post_type_name
	*	@access protected
	*	@since 2.0.0 
	*/
	
	protected $post_type_name;

	/**
	*	which default wordpress features
	*	will be supported
	*
	*	@var $supports
	*	@access protected
	*	@since 2.0.0 
	*/
	
	private $supports;


	/**
	*	constructor function of the dp_cpt_todo
	*	
	*	@since 2.0.0
	*/

	public function __construct(){
		// register post type
		$this->post_type_name = 'todo';
		$this->supports = array( 'title', 'editor');

		add_action( 'init', array( $this,'register_post_type' )  );
		add_action( 'save_post', array( $this , 'dp_save_todo_meta' ) ) ;

		add_filter('manage_todo_posts_columns' , array( $this, 'dp_todo_add_columns' ) );
		add_action('manage_todo_posts_custom_column', array( $this,'dp_todo_add_columns_content' ) );
	}




	/**
	*	add the completed column to the list of todos
	*	
	*	@since 2.0.0
	*   @return array
	*/

	function dp_todo_add_columns_content($columns) {
		global $post;
 	    
 	    if('completed'==$columns){

			$completed = get_post_meta( $post->ID , 'completed',true );

			if('true'==$completed){
				echo 'YES';
			}else{
				echo 'NO';
			}

 	   }

	}


	/**
	*	add the completed column to the list of todos
	*	
	*	@since 2.0.0
	*   @return array
	*/

	function dp_todo_add_columns($columns) {

 	   return array_merge($columns,  array('completed' => __('Completed', 'dopress') ) ) ;
                    
	}



	/**
	*	register the todo post type
	*	
	*	@since 2.0.0
	*   @return bool on success
	*/

	public function register_post_type() {

		$single = $this->post_type_name;
 		$plural = $single.'s';
 		$supports = $this->supports;

	    $labels = array(
	        'name' => _x( $plural, 'post type general name', 'dopress' ),
	        'singular_name' => _x( "$single", 'post type singular name','dopress' ),
	        'add_new' => _x( "Add New $single", "$single",'dopress' ),
	        'add_new_item' => __( "Add New $single", 'dopress' ),
	        'edit_item' => __( "Edit $single" , 'dopress'),
	        'new_item' => __( "New $single" , 'dopress'),
	        'all_items' => __( "All $plural" , 'dopress'),
	        'view_item' => __( "View $single" , 'dopress'),
	        'search_items' => __( "Search $plural" , 'dopress'),
	        'not_found' => __( "No $plural found" , 'dopress'),
	        'not_found_in_trash' => __( "No $single found in Trash", 'dopress' ),
	        'parent_item_colon' => '',
        	'menu_name' => 'DoPress'
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
	        'menu_position' => 5,
			'menu_icon' => '',
	        'register_meta_box_cb' => array($this, 'dp_cpt_add_meta_boxes'),
	        'supports' => ( $supports ) ? $supports : array( 'title', 'editor', 'page-attributes' )
	    );

	    register_post_type( $single, $args );

	} // register_post_type


	/**
	*	dp_cpt_add_meta_boxes function 
	*	@since 2.0.0
	*/

	public function dp_cpt_add_meta_boxes($post){

		//setup meta box values arguments
		$metabox_id 		= 'todo_completed_meta';
		$metabox_title 		= 'completed';//_x('Completed', 'Todo post type edit screen, metabox title ','dopress');
		$callback_function 	= 'completed_metabox_render';   //array($this,'completed_metabox_render');
		$screen 			= 'todo';
		$context			= 'side';
		$priority 			= '';
		$callback_args 		= null;


		//register function note thhis function has to be 
		//created here for the add metabox function to have access to it
		function completed_metabox_render($post){

		// get completede meta value for this post
		$completed = get_post_meta($post->ID , 'completed',true);

		// build form
			$form = "<form name='todo_metabox'>";
			$form.= "<label>Complete </label>";
			$form.= "<select name='todo_completed'>";
			$form.= "<option ". selected( $completed , 'true', false) ." value='true'>Yes</option>";
			$form.= "<option ". selected( $completed , 'false', false) ."  value='false'>No</option>";
			$form.= "</select>";
			$form.= "</form>";

		// show the form
			echo $form;
						
		} // end completed_metabox_render

		//add completed metabox
		add_meta_box( $metabox_id, $metabox_title, $callback_function, $screen, $context, $priority , $callback_args);

	} // add_meta_boxes


	/**
	*	Hook to save todo meta data in the admin save
	*	
	*	@param $post_id
	*	@since 2.0.0
	*  
	*/

	public function dp_save_todo_meta($post_id) {

		//check post type is todo before going further
		if( !isset($_POST['post_type']) || 'todo' != $_POST['post_type']  ){

			return;
		
		}

		// update the completed key

		if(isset($_REQUEST['todo_completed'])){
			update_post_meta($post_id, 'completed', $_REQUEST['todo_completed'] );

		}

	}

}

?>