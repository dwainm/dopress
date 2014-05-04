<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class dp_admin_menus{

	private $parrenthook;

	public function __construct(){
		
		add_action('admin_menu',array( $this,'admin_nav'));
	}


	public function admin_nav() {
		global $menu;
		$main = add_menu_page( 'DoPress', 'DoPress', 'manage_options','dopress-menu' ,'edit.php?post_type=item');
		add_submenu_page( 'dopress-menu', 'DoPress Items', 'View Items', 'manage_options', 'dopress-menu');
		add_submenu_page( 'dopress-menu', 'DoPress Settings', 'Settings', 'manage_options', 'dopress-settings');
	}
}
?>