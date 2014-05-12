<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dp_admin_settings{


	/**
	*	consturtor function to load all the need functionality
	*	@since 2.0.0
	*
	*/

	public function __construct(){
		add_action('admin_menu',array( $this,'dp_admin_nav'));
		add_action( 'admin_head', array( $this,'dp_add_menu_icons_styles')  );
	}

	/**
	*	Manage plugin admin menus
	*	@since 2.0.0
	*
	*/

	public function dp_admin_nav(){

		add_submenu_page( 'edit.php?post_type=todo', 'DoPress Settings', 'Settings', 'activate_plugins', basename(__FILE__), array( $this ,'dp_setup_settings_page' ) );
	
	}

	/** 
	* register the plugins settings via WordPress Settings API
	* 
	* @since 2.0.0
	*/
	private function dp_register_settings(){
		// check options and load the array
	}

	/**
	*	add the admin main menu icon
	*	@since 2.0.0
	*
	*/

	public function dp_add_menu_icons_styles(){
		?>
		<style>

		#adminmenu #menu-posts-todo div.wp-menu-image:before {
		  content: '\f147' !important;
		}
		</style>	 
		<?php
	}

	/**
	*	create the settings page content
	*	@since 2.0.0
	*/
	
	public function dp_setup_settings_page(){

		// get current settings from the database
		$settings = $this->get_settings();
		// create a pagenam id array to feed into the dr
		$pages = $this->get_page_id_list();

		echo '<div class="wrap">';
		echo '<h2>DoPress Settings</h2>';
		echo '<form name="dopress-settings"> ';
		settings_fields( 'dopress-settings-group' );
		echo '<select name="page-id">';
		foreach ($pages as $page) {
			//echo '<option '.selected($page->ID) .'value="'..'">   </option>';
		}
		var_dump($pages);
		echo '</select>';
		echo '</form> ';
		echo '</div>';

	}// end dp_setup_settings_page 

	/**
	*	generate a pagename / id list
	*
	*	@since 2.0.0
	*   @return array page names and id list
	*/
	
	public function get_page_id_list(){
		$page_id_list = [];

		// get a list of page names and ids for use in the drop down
		$args = array(
			'sort_order' => 'ASC',
			'sort_column' => 'post_title',
			'hierarchical' => 1,
			'exclude' => '',
			'include' => '',
			'meta_key' => '',
			'meta_value' => '',
			'authors' => '',
			'child_of' => 0,
			'parent' => -1,
			'exclude_tree' => '',
			'number' => '',
			'offset' => 0,
			'post_type' => 'page',
			'post_status' => 'publish'
		); 
		$pages = get_pages($args);

		// retrieve the page names and id's into the pag_id_lists array 

		foreach ($pages as $page) {
			array_push( $page_id_list, array( 'id'=>$page->ID , 'title'=>$page->post_title ) );
		}

		return $page_id_list;
	}

	/**
	*	return an array of settings
	*
	*	@since 2.0.0
	*   @return array settings
	*/
	public function get_settings(){
		// check if settings exist if not call the tegister settings creting the default
	}

	public function update_settings(){
		// check if settings exist if not call the tegister settings creting the default
	}

	protected function register_settings(){
		// check if settings exist if not call the tegister settings creting the default
	}

}