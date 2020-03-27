<?php

GFForms::include_addon_framework();

class GFPrivacyAddOn extends GFAddOn {

	protected $_version = GF_PRIVACY_ADDON_VERSION;
	protected $_min_gravityforms_version = '1.9';
	protected $_slug = 'gravityforms-privacy-addon';
	protected $_path = 'gravityforms-privacy-addon/gravityforms-privacy-addon.php';
	protected $_full_path = __FILE__;
	protected $_title = 'Gravity Forms Privacy Add-On';
	protected $_short_title = 'Privacy Add-On';

	private static $_instance = null;

	/**
	 * Get an instance of this class.
	 *
	 * @return GFPrivacyAddOn
	 */
	public static function get_instance() {
		if ( self::$_instance == null ) {
			self::$_instance = new GFPrivacyAddOn();
		}

		return self::$_instance;
	}
	
	/**************************************************************
	*  init
	*
	*  Init
	*
	*  @type	function
	*  @date	22/05/18
	*  @since	0.1.0
	*
	*  @param	N/A
	*  @return	N/A
	**************************************************************/
	
	public function init() {
		parent::init();

		add_filter( 'wp_privacy_personal_data_exporters', array( $this, 'tela_register_plugin_exporter' ), 10, 1 );
		add_filter( 'wp_privacy_personal_data_erasers', array( $this, 'tela_register_plugin_eraser' ), 10, 1 );
	}

	// # ADMIN FUNCTIONS -----------------------------------------------------------------------------------------------

	/**************************************************************
	*  tela_register_plugin_exporter
	*
	*  Add exporters
	*
	*  @type	function
	*  @date	22/05/18
	*  @since	0.1.0
	*
	*  @param	{array}		$exporters 		Current array of exporters
	*  @return	{array}
	**************************************************************/

	public function tela_register_plugin_exporter( $exporters ) {
		$exporters['gravityforms-privacy-addon'] = array(
			'exporter_friendly_name' => __( 'Gravity Forms Privacy plugin' ),
			'callback'               => array( $this, 'tela_gf_get_entries' ),
		);
		return $exporters;
	}

	/**************************************************************
	*  tela_gf_get_entries
	*
	*  Get the gravity form entries according to the email
	*
	*  @type	function
	*  @date	22/05/18
	*  @since	0.1.0
	*
	*  @param	{string}	$email_address	Email address of request
	*  @param	{integer}	$page			Current page
	*  @return	{array}
	**************************************************************/

	public function tela_gf_get_entries( $email_address, $page = 0 ) {
		$export_items = array();
	
		// Get the forms
		$forms = GFAPI::get_forms();
	
		// Loop through the forms
		foreach( $forms as $form ){
			
			$form_id   = $form['id'];
			$entry_ids = GFFormsModel::search_lead_ids( $form_id );
	
			// Loop through the forms
			foreach( $entry_ids as $entry_id ){

				$data         = array();
				$email_found  = false;
				$entry        = GFAPI::get_entry( $entry_id );
			

				$email_fields = GFCommon::get_email_fields( $form );
				foreach ( $email_fields as $email_field ) {
			
					// If there's a match for the email address
					if ( ! empty( $entry[ $email_field["id"] ] ) && $entry[ $email_field["id"] ] == $email_address ) {
						$emails[] = $entry["id"];
						$email_found = true;
				
						$fields = $this->tela_get_fields( $form );
		
						foreach ( $fields as $key => $value ) {
							$data[] = array(
								'name'  => $value,
								'value' => $entry[ $key ],
							);
						}
					}
				}
			
				// If email is found then add the data
				if( $email_found ){

					$group_label = $form['title'];
					$group_id = 'gf' . $form_id;
					$item_id = 'gf-' . $form_id;

					$export_items[] = array(
						'group_id'    => $group_id,
						'group_label' => $group_label,
						'item_id'     => $item_id,
						'data'        => $data,
					);
				}
			}
		
		}
		
		// Return the results
		return array(
			'data' => $export_items,
			'done' => true,
		);
	}

	/**************************************************************
	*  tela_get_fields
	*
	*  Get the fields from the form
	*
	*  @type	function
	*  @date	22/05/18
	*  @since	0.1.0
	*
	*  @param	{array}		$form		The form array that is passed
	*  @return	{array}
	**************************************************************/

	public function tela_get_fields( $form ){
		foreach ( $form['fields'] as $field ) {
			if( is_array( $field['inputs'] ) ){
				foreach ( $field['inputs'] as $input ) {
					$label = $field['type'] === 'checkbox' ? $field['label'] : $input['label'];
					$fields[ (string) $input['id']] 	= $label;
				}
			} else {
				$fields[ $field['id'] ] = $field['label'];
			}
		}
		return $fields;
	}

	/**************************************************************
	*  tela_register_plugin_eraser
	*
	*  Add erasers
	*
	*  @type	function
	*  @date	22/05/18
	*  @since	0.1.0
	*
	*  @param	{array}		$erasers	 Current array of erasers
	*  @return	{array}
	**************************************************************/

	public function tela_register_plugin_eraser( $erasers ) {
		$erasers['gravityforms-privacy-addon'] = array(
			'eraser_friendly_name' => __( 'Gravity Forms Privacy plugin' ),
			'callback'             => array( $this, 'tela_gf_delete_entries' ),
		);
		return $erasers;
	}

	/**************************************************************
	*  tela_gf_delete_entries
	*
	*  Get the gravity form entries according to the email
	*
	*  @type	function
	*  @date	22/05/18
	*  @since	0.1.0
	*
	*  @param	{string}	$email_address	Email address of request
	*  @param	{integer}	$page			Current page
	*  @return	{array}
	**************************************************************/

	public function tela_gf_delete_entries( $email_address, $page = 1 ) {
	
		$export_items = array();

		// Get the forms
		$forms = GFAPI::get_forms();

		// Loop through the forms
		foreach( $forms as $form ){
		
			$form_id   = $form['id'];
			$entry_ids = GFFormsModel::search_lead_ids( $form_id );

			// Loop through the forms
			foreach( $entry_ids as $entry_id ){

				$data         = array();
				$email_found  = false;
				$entry        = GFAPI::get_entry( $entry_id );

				$email_fields = GFCommon::get_email_fields( $form );
				foreach ( $email_fields as $email_field ) {
		
					// If there's a match for the email address delete it
					if ( ! empty( $entry[ $email_field["id"] ] ) && $entry[ $email_field["id"] ] == $email_address ) {
						GFAPI::delete_entry( $entry['id'] );
						$items_removed = true;
					}
				}
			}
		}
		// Return the results
		return array( 
			'items_removed'  => $items_removed,
			'items_retained' => false, // always false to delete
			'messages'       => array(), // no messages
			'done'           => true,
		);
	}
}