<?php
/**
 * Plugin Name:       LD Text Sizing & Fit color
 * Plugin URI:        http://
 * Description:       This plugin is use to display detail information about text sizing & fit color
 * Version:           1.0.0
 * Author:            sajjad
 * Developed By:      sajjad
 * Author URI:        http://
 * Domain Path:       /languages
 * TextDomain:        ld-tsfc   
 **/

if (!defined('ABSPATH')) {
	exit();
}

if ( ! is_multisite() ) { 
	if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) { 
		function tsfc_checking_module_is_not_deactivate() { 
			// Deactivate the plugin. 
			deactivate_plugins( __FILE__ ); 
			?> 
   <div id="message" class="error"> 
   <p> 
   <strong> 
			<?php esc_html_e( 'This plugin is inactive. WooCommerce plugin must be active in order to activate it.', 'ld-tsfc' ); ?> 
   </strong> 
   </p> 
   </div>; 
			<?php 
		} 
		add_action( 'admin_notices', 'tsfc_checking_module_is_not_deactivate' ); 
		add_action( 'wp_ajax_nopriv_get_variation_data',array($this, 'get_variation_data' ));
      add_action( 'wp_ajax_get_variation_data',array($this, 'get_variation_data' ));
	} 
}

class Ld_Txt_Sizing_Main {

	public function __construct() { 
		add_action( 'init', array($this,'ld_tsfc_init'));
		add_action( 'wp_ajax_get_variation_data',array($this, 'get_variation_data' ));
		add_action( 'wp_ajax_nopriv_get_variation_data',array($this, 'get_variation_data' ));
		$this->ka_tsfc_global_variables();	
			include_once TSFC_PLUGIN_DIR . 'include/front/class-ld_txt_sizing-front.php';	
	}
	 
	public function ka_tsfc_global_variables() { 
		if (!defined('TSFC_URL') ) {
			define('TSFC_URL', plugin_dir_url(__FILE__));
		}
		if (! defined('TSFC_PLUGIN_DIR') ) {
			define('TSFC_PLUGIN_DIR', plugin_dir_path(__FILE__));
		}
	}

	public function get_variation_data(){
		if(isset($_POST['nonce'])){
        $nonce=$_POST['nonce'];
	    }else{
	        $nonce=0;
	    } 
	    if(!wp_verify_nonce($nonce, 'text-sizing&fif-nonce')){
	       die(__( 'Failed Ajax Security Check', 'ld-tsfc' ));
	    }  	 
		if(isset($_POST['variation_id'])){
        $variation_id=($_POST['variation_id']);
        // echo $variation_id;
        $variable_descri = get_post_meta( $variation_id, '_variation_description', true ); 
        $variation_pro=wc_get_product($variation_id); 
        $variable_price=$variation_pro->get_price(); 
        ob_start();   ?>
        <div class="variation_label_data"> 
        	<label> <?php echo $variable_descri; echo '<br';  ?>  </label>
        	<label> <?php echo $variable_price; ?>  </label> 
        </div> <?php
        $variation_data=ob_get_clean();
        wp_send_json(array("variation_html"=> $variation_data));
     }
      wp_die();  
	}
	public function ld_tsfc_init() {
		if ( function_exists( 'load_plugin_textdomain' ) ) { 
			load_plugin_textdomain( 'ld-tsfc', false, dirname( plugin_basename(__FILE__) ) . '/languages' ); 
		} 
	}     
}
if (class_exists('Ld_Txt_Sizing_Main')) {
	new Ld_Txt_Sizing_Main();
}
