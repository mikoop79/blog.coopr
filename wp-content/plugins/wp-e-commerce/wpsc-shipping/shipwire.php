<?php

/**
 * New Shipwire Shipping rates  
 * This is a very simple gateway - no settings, and essentially just a wrapper function for the Shipwire Shipping Rate API
 */

class WPSC_Shipwire_Shipping {
	public $internal_name;
	public $name;	
	
	/**
	 * Constructor
	 */
	function __construct () {
		$this->internal_name   = 'shipwire';
		$this->name            = __( 'Shipwire', 'wpsc' );
		$this->is_external     = true;
		$this->requires_weight = false;
		$this->needs_zipcode   = true;
		
		return true;
	}
	
	function getName() {
		return $this->name;
	}
	
	function getInternalName() {
		return $this->internal_name;
	}
	

	function getForm() {

		$output  = '<p>' . _x( 'There are no settings for this form.', 'Shipwire settings form', 'wpsc' ) . '</p>';
		$output .= '<p>' . _x( '<em>It simply works.</em>', 'Shipwire settings form', 'wpsc' ) . '</p>';
		$output .= '<p>' . _x( 'Be sure to enter your username and password (above).', 'Shipwire settings form', 'wpsc' ) . '</p>';
		$output .= '<p>' . sprintf( _x( 'Be sure to read <a href="%s">the documentation</a>, there are some pretty important things to note.', 'Shipwire settings form', 'wpsc' ), esc_url( 'http://docs.getshopped.org/documentation/shipwire' ) ) . '</p>';

		return $output;
	}
	
	function submit_form() {
		return true;
	}

	function getQuote() {
		return WPSC_Shipwire::get_shipping_quotes();
	}
}

if ( WPSC_Shipwire::is_active() ) {
	if ( ! in_array( 'shipwire', get_option( 'custom_shipping_options' ) ) )
		update_option( 'custom_shipping_options', array( 'shipwire' ) );

	$wpsc_shipwire = new WPSC_Shipwire_Shipping();
	$wpsc_shipping_modules[$wpsc_shipwire->getInternalName()] = $wpsc_shipwire;
}

?>
