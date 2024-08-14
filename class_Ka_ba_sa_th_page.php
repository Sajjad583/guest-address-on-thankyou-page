<?php

if (!defined('ABSPATH')) {
	exit();
}


class Ka_Custom_Thankyou_Page extends WC_Settings_Page {
	
	public function __construct() {
		$this->id    = 'ka_thankyou';
		$this->label = __( 'Billing & Shipping Address', 'woocommerce' );

		parent::__construct();
	}

	public function get_settings_for_default_section() { 

		$settings =
			array(

				array(
					'title' => __( 'Billing & Shipping Address on Thank you Page', 'woocommerce' ),
					'type'  => 'title',
					'desc'  => __( 'The billing & shipping address on Thank you page for guest users.', 'woocommerce' ),
				),
				array(
					'title'    => __( 'Enable Billing & Shipping address', 'woocommerce' ),
					'desc'     => __( 'Enable the Billing & Shipping address on Thank you page', 'woocommerce' ),
					'id'       => 'ka_shippingaddress',
					'default'  => 'no',
					'type'     => 'checkbox',
				),
				array(
					'title'    => __( 'Position of Shipping address', 'woocommerce' ),
					'id'       => 'ka_shippingaddress_Position',
					'default'  => 'Default position',
					'type'     => 'select',
					'class'    => 'wc-enhanced-select',
					'desc_tip' => true,
					'options'  => array(
						'ka_default_position'        => __( 'Default position', 'woocommerce' ),
						'ka_order_details'       => __( 'Before Order Details', 'woocommerce' ),
						'ka_before_order_table'  => __( 'Before Order Table', 'woocommerce' ),
					),
				),
				array(
					'type' => 'sectionend',
					'id'   => 'ka_position_options',
				),
			);

		return apply_filters( 'woocommerce_' . $this->id . '_settings', $settings );
	}
}
if (class_exists('Ka_Custom_Thankyou_Page')) {
	new Ka_Custom_Thankyou_Page();
}
