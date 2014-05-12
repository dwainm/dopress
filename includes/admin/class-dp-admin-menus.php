<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dp_admin_menus{


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

}