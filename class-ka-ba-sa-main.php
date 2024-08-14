<?php
/**
   * Plugin name: Guest Address On Thankyou Page
   * Plugin URI:
   * Description: This plugin is use to display the shipping address on Thankyou page for guest customers.
   * Author: Koala Apps
   * Author URI:
   * Version: 1.0.1 
   * Text Domian: ka-gatp
   *  
*/

if (!defined('ABSPATH')) {
	exit();
}

if ( ! is_multisite() ) { 
	if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) { 
		function ka_sr_checking_module_is_not_deactivate() { 
			// Deactivate the plugin. 
			deactivate_plugins( __FILE__ ); 
			?> 
   <div id="message" class="error"> 
   <p> 
   <strong> 
			<?php esc_html_e( 'Shipping Address plugin is inactive. WooCommerce plugin must be active in order to activate it.', 'ka-gatp' ); ?> 
   </strong> 
   </p> 
   </div>; 
			<?php 
		} 
		add_action( 'admin_notices', 'ka_sr_checking_module_is_not_deactivate' ); 
	} 
}

class Ka_Ba_Sa_Main {

	public function __construct() { 
		add_action( 'init', array($this,'ka_gatp_init'));
		$this->ka_ebShippingaddress_global_variables();
	  
		if (is_admin()) {    
			include_once EBS_PLUGIN_DIR . 'include/admin/class-ka-ba-sa-admin.php';
		} else {
			include_once EBS_PLUGIN_DIR . 'include/front/class-ka-ba-sa-front.php';
		}
	}
	 
	public function ka_ebShippingaddress_global_variables() { 

		if (!defined('EBS_URL') ) {
			define('EBS_URL', plugin_dir_url(__FILE__));
		}

		if (! defined('EBS_PLUGIN_DIR') ) {
			define('EBS_PLUGIN_DIR', plugin_dir_path(__FILE__));
		}
	}

	public function ka_gatp_init() {
		if ( function_exists( 'load_plugin_textdomain' ) ) { 
			load_plugin_textdomain( 'ka-gatp', false, dirname( plugin_basename(__FILE__) ) . '/languages' ); 
		} 
	}     
}
if (class_exists('Ka_Ba_Sa_Main')) {
	new Ka_Ba_Sa_Main();
}
