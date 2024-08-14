<?php
/**
 * 
 */
if (!defined('ABSPATH')) {
	exit();
}


class Ld_Txt_Sizing_Front {

	
	public function __construct() {
		add_action('woocommerce_after_single_product_summary', array( $this, 'text_sizing_and_fit_color' ),15 );
		// add_action( 'woocommerce_before_add_to_cart_quantity',  array( $this,'display_variation_product_data' )); 
		add_action('wp_enqueue_scripts', array($this, 'ka_sa_ba_front_scripts') );
		// add_action( 'woocommerce_before_variations_form',array($this, 'ui_display_wc_variation' ));
		
			
	}


	function ui_display_wc_variation() {    
	   global $product;
	  ?>
	  <script>
	  jQuery(document).ready(function() {
	    jQuery( 'input.variation_id' ).change( function(){
	      if( jQuery.trim( jQuery( 'input.variation_id' ).val() )!='' ) {
	        var variation = jQuery( 'input.variation_id' ).val();
	        console.log('Variation ' + variation );
	        // your custom code goes here
	      }
	    });
	  });
	  </script>
	  <?php
	}

	public function text_sizing_and_fit_color(){
		global $product;
		
	    $variations = $product->get_available_variations();
	    $var = [];
	    foreach ($variations as $variation) {
	        $var[] = $variation['attributes'];

	    }
	    // var_dump($var);
	    
	    foreach ($var as $key => $arr) {
	      foreach ($arr as $orig_code => $lowercase_value) {
	        $terms_arr = wp_get_post_terms( $product->id, str_replace('attribute_','',$orig_code), array( 'fields' => 'names' ) );

	        foreach ($terms_arr as $term) {
	            if (strtolower($term) == $lowercase_value) {
	                $var[$key][$orig_code] = $term;
	                break;
	            }
	        }
	      }
	    }
	    // var_dump($variation['variation_description']);
		
		// $target_attribute= 'colors';
		// $variation_ids= array();
		// $product_id=$product->get_id();
		// $default_attributes=$product->get_default_attributes();
		// $available_attributes=$product->get_available_variations();
		// foreach($available_attributes as $variation_values){
		// 	foreach($variation_values['attributes'] as $key =>$attribute_value){
		// 		$attribute_name=str_replace('attribute_', '', $key);
		// 		if($attribute_name == $target_attribute){
		// 			$default_value =$product->get_variation_default_attribute( $attribute_name );
		// 			if ( $default_value == $attribute_value) {
		// 					$variation_ids[] = $variation_values['variation_id'];
		// 			}
		// 		}
		// 	}
		// }
		// echo '<pre>';
		// print_r($variation_ids);
		// var_dump($attribute_name);
		// echo $product_id;
     //    if(isset($_POST['variation_id'])){
     //    $variation_id=($_POST['variation_id']);
       
     //    $variation_meta=get_post_meta($variation_id,'woocommerce-variation-description',true);
        
     // }
	    // $textp="Ali Ahmad hfghjhkjlklygdcd hedhgjbbl rfjehr i hi hu hiuhugyg  uyg uiu iuh uhi gyugyftf tf yyu fu ";
     //    echo $textp;
        ?> <form><div class="variation_data" id="variation_data">  </div></form> <?php
    }	

 
function display_variation_product_data() {
   global $product;
   if ( $product->is_type( 'variable' ) ) {
      wc_enqueue_js( "
         $( 'input.variation_id' ).change( function(){
            if( '' != $(this).val() ) {
               var var_id = $(this).val();
               alert('You just selected variation #' + var_id);
            }
         });
      " );
   }
}
	
	public function ka_sa_ba_front_scripts() {
		wp_enqueue_script( 'ld-tsfc', TSFC_URL .'include/assets/js/af_class_tsfc_front.js',array('jquery'), '1.0.1');
		$script_var = array(
                'admin_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('text-sizing&fif-nonce'),
            );
            wp_localize_script( 'ld-tsfc', 'TSFC_URL', $script_var );
	}
}
if (class_exists('Ld_Txt_Sizing_Front')) {
	new Ld_Txt_Sizing_Front();	
}






