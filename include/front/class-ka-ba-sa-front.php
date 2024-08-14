<?php
/**
 * 
 */
if (!defined('ABSPATH')) {
	exit();
}


class Ka_Ba_Sa_Front {

	
	public function __construct() {
		add_action('woocommerce_after_single_product_summary', array( $this, 'text_sizing_and_fit_color' ) ); 
		add_action('wp_enqueue_scripts', array($this, 'ka_sa_ba_front_scripts') );
		if ('yes' == get_option('ka_shippingaddress')   ) {

			if ('ka_order_details'==get_option('ka_shippingaddress_position') ) {
				add_action('woocommerce_before_thankyou', array($this, 'ka_custom_content_thankyou'), 3, 1);
			} elseif ('ka_before_order_table'==get_option('ka_shippingaddress_position')) {
					
				add_action('woocommerce_order_details_before_order_table', array($this, 'ka_custom_content_thankyou'), 10, 1);
			} elseif ('ka_default_position'==get_option('ka_shippingaddress_position')) {
				add_action('woocommerce_after_order_details', array($this, 'ka_custom_content_thankyou'), 10, 1);
			}
		} 			
	}
	public function text_sizing_and_fit_color(){
        
        echo "Ali Ahmad hfghjhkjlklygdcd  hedhgjbbl rfjehr i hi hu hiuhugyg  uyg uiu iuh uhi gyugyftf tf yyu fu ";

         
     }	
	public function ka_custom_content_thankyou( $order ) { 

		
		if ( is_int( $order ) ) {
			
				$order = wc_get_order( $order );
		}

		if ( is_user_logged_in() || 0!== $order->get_user_id()  ) {

			return;
		}
		
		$show_billing = get_option('ka_shippingaddress') ? true : wc_ship_to_billing_address_only();
		?>
		<section class="woocommerce-customer-details" >
			<div class="flex-containe-default">

		<?php 
		if ( $show_billing ) { 	
			?>
			
		<div class="ka-billing-address" id="billing-address-def" >
			<h2 class="billing-address-column__title"><?php esc_html_e( 'Billing address', 'ka-gatp' ); ?></h2>
			<address>
				<?php echo wp_kses_post( $order->get_formatted_billing_address( esc_html__( 'N/A', 'ka-gatp' ) ) ); ?>

				<?php if ( $order->get_billing_phone() ) : ?>
					<p><?php echo esc_html( $order->get_billing_phone() ); ?></p>
				<?php endif; ?>

				<?php if ( $order->get_billing_email() ) : ?>
					<p><?php echo esc_html( $order->get_billing_email() ); ?></p>
				<?php endif; ?>
			</address>
		</div>
	
			<?php 
		}

		$show_shipping = 'ka_default_billing_address' == get_option('ka_shippingaddress_position') ? true :$order->needs_shipping_address();
		if ($show_shipping) {
			?>
				<div class="ka-shipping-address" id="shipping-address-def" >
				<h2 class="shipping-address-column__title"><?php esc_html_e( 'Shipping address', 'ka-gatp' ); ?></h2>
				<address>
					<?php echo wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'ka-gatp' ) ) ); ?>

					<?php if ( $order->get_shipping_phone() ) : ?>
						<p><?php echo esc_html( $order->get_shipping_phone() ); ?></p>
					<?php endif; ?>
				</address>
			</div>		
	</section>
			<?php	
		}
		// }		
	}

	public function ka_sa_ba_front_scripts() {
		wp_enqueue_style( 'dbs-front', plugins_url('../assets/css/class_ka_ba_sa_front.css', __FILE__) , false, '1.0.1');

	}
}
if (class_exists('Ka_Ba_Sa_Front')) {
	new Ka_Ba_Sa_Front();	
}






