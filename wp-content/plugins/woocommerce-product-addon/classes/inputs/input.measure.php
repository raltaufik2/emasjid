<?php
/*
 * Followig class handling Measuremnts input control and their
* dependencies. Do not make changes in code
* Create on: 21 May, 2014
*/

class NM_Measure_wooproduct extends PPOM_Inputs{
	
	/*
	 * input control settings
	 */
	var $title, $desc, $settings;
	
	/*
	 * this var is pouplated with current plugin meta
	*/
	var $plugin_meta;
	
	function __construct(){
		
		$this -> plugin_meta = ppom_get_plugin_meta();
		
		$this -> title 		= __ ( 'Measure Input', "ppom" );
		$this -> desc		= __ ( 'Measuremnts', "ppom" );
		$this -> icon		= __ ( '<i class="fa fa-building-o" aria-hidden="true"></i>', 'ppom' );
		$this -> settings	= self::get_settings();
		
		add_filter('ppom_option_label', array($this, 'change_option_label'), 15, 4);
	}
	
	function change_option_label($label, $option, $meta, $product){
   
		if($meta['type'] != 'measure') return $label;
		
		$price = isset($option['price']) ? $option['price'] : 0;
		$price = wc_price($price);
	    $label = $price.'/'.$option['option'];
	    return $label;
	}
	
	private function get_settings(){
		
		$input_meta = array (
				'title' => array (
						'type' => 'text',
						'title' => __ ( 'Title', "ppom" ),
						'desc' => __ ( 'It will be shown as field label', "ppom" ) 
				),
				'data_name' => array (
						'type' => 'text',
						'title' => __ ( 'Data name', "ppom" ),
						'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', "ppom" ) 
				),
				'description' => array (
						'type' => 'textarea',
						'title' => __ ( 'Description', "ppom" ),
						'desc' => __ ( 'Small description, it will be display near name title.', "ppom" ) 
				),
				'error_message' => array (
						'type' => 'text',
						'title' => __ ( 'Error message', "ppom" ),
						'desc' => __ ( 'Insert the error message for validation.', "ppom" ) 
				),
				'max' => array (
						'type' => 'text',
						'title' => __ ( 'Max. values', "ppom" ),
						'desc' => __ ( 'Max. values allowed, leave blank for default', "ppom" ),
						'col_classes' => array('col-md-3','col-sm-12')
				),
				'min' => array (
						'type' => 'text',
						'title' => __ ( 'Min. values', "ppom" ),
						'desc' => __ ( 'Min. values allowed, leave blank for default', "ppom" ),
						'col_classes' => array('col-md-3','col-sm-12')
				),
				'step' => array (
						'type' => 'text',
						'title' => __ ( 'Steps', "ppom" ),
						'desc' => __ ( 'specified legal number intervals', "ppom" ),
						'col_classes' => array('col-md-3','col-sm-12')
				),
				'default_value' => array (
						'type' => 'text',
						'title' => __ ( 'Set default value', "ppom" ),
						'desc' => __ ( 'Pre-defined value for measure input', "ppom" ),
						'col_classes' => array('col-md-3','col-sm-12')
				),
				'price' => array (
						'type' => 'text',
						'title' => __ ( 'Addon-on Price', 'ppom' ),
						'desc' => __ ( 'Price will be added as Add-on if text provided', 'ppom' ),
						'col_classes' => array('col-md-3','col-sm-12')
				),
				'class' => array (
						'type' => 'text',
						'title' => __ ( 'Class', "ppom" ),
						'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', "ppom" ),
						'col_classes' => array('col-md-3','col-sm-12')
				),
				'width' => array (
						'type' => 'select',
						'title' => __ ( 'Width', 'ppom' ),
						'desc' => __ ( 'Select width column.', "ppom"),
						'options'	=> ppom_get_input_cols(),
						'default'	=> 12,
						'col_classes' => array('col-md-3','col-sm-12')
				),
				'visibility' => array (
						'type' => 'select',
						'title' => __ ( 'Visibility', 'ppom' ),
						'desc' => __ ( 'Set field visibility based on user.', "ppom"),
						'options'	=> ppom_field_visibility_options(),
						'default'	=> 'everyone',
						'col_classes' => array('col-md-3','col-sm-12')
				),
				'visibility_role' => array (
						'type' => 'text',
						'title' => __ ( 'User Roles', 'ppom' ),
						'desc' => __ ( 'Role separated by comma.', "ppom"),
						'hidden' => true,
				),
				'desc_tooltip' => array (
						'type' => 'checkbox',
						'title' => __ ( 'Show tooltip (PRO)', 'ppom' ),
						'desc' => __ ( 'Show Description in Tooltip with Help Icon', 'ppom' ),
						'col_classes' => array('col-md-3','col-sm-12')
				),
				'required' => array (
						'type' => 'checkbox',
						'title' => __ ( 'Required', "ppom" ),
						'desc' => __ ( 'Select this if it must be required.', "ppom" ),
						'col_classes' => array('col-md-3','col-sm-12')
				),
				'logic' => array (
						'type' => 'checkbox',
						'title' => __ ( 'Enable Conditions', "ppom" ),
						'desc' => __ ( 'Tick it to turn conditional logic to work below', "ppom" )
				),
				'conditions' => array (
						'type' => 'html-conditions',
						'title' => __ ( 'Conditions', "ppom" ),
						'desc' => __ ( 'Tick it to turn conditional logic to work below', "ppom" )
				),
				
		);
		
		$type = 'measure';
		return apply_filters("poom_{$type}_input_setting", $input_meta, $this);
	}
}