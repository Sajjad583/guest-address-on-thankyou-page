<?php
if (!defined('ABSPATH')) {
	exit();
}

class Ka_Ba_Sa_Admin {

	public $id = 'ka_Thankyou_shipping_demo';
	public function __construct() { 
		  
		add_filter('woocommerce_get_settings_pages', array($this, 'ka_add_custom_setting_page'), 78);
	}

	public static function ka_add_settings_tab( $settings_tabs ) { 
		$settings_tabs[$this->id] = __( 'Thankyou Shipping', 'woocommerce-settings-tab-demo' );
		return $settings_tabs;
	}
	public function ka_output_sections() {
		global $current_section;

	}

	public function ka_add_custom_setting_page( $pages) { 
		$pages[$this->id] = include_once EBS_PLUGIN_DIR . 'class_Ka_ba_sa_th_page.php';
		return $pages;
	} 

}
if (class_exists('Ka_Ba_Sa_Admin')) {
	new Ka_Ba_Sa_Admin();
}



 
