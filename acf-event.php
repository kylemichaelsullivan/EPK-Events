<?php
/**
 * Add ACF Field Group: Events
 *
 * @link https://developer.wordpress.org/reference/functions/add_shortcode/
 *
 * @since 1.0.0
 */

if( ! function_exists( 'add_epk_events_acf' ) ) {
	function add_epk_events_acf() {
		/**
		 * Add ACF Fields for EPK Events
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		if ( function_exists( 'acf_add_local_field_group' ) ) {
			acf_add_local_field_group( array(
				'key' => 'group_65a0c882dbe95',
				'title' => 'Events',
				'fields' => array(
					array(
						'key' => 'field_65a0c88332b10',
						'label' => 'Start',
						'name' => 'start',
						'aria-label' => '',
						'type' => 'date_time_picker',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'display_format' => 'F j, Y | g:iA',
						'return_format' => 'Y-m-d H:i:s',
						'first_day' => 1,
					),
					array(
						'key' => 'field_65a0cc6232b12',
						'label' => 'Location',
						'name' => 'location',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_65a0cd0632b13',
						'label' => 'Address',
						'name' => 'address',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'placeholder' => '1 Division Ave, Grand Rapids, MI 49503',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_65c1850db79ef',
						'label' => 'Link',
						'name' => 'link',
						'aria-label' => '',
						'type' => 'link',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'default_value' => '',
					),
					array(
						'key' => 'field_65c18547b79f0',
						'label' => 'Details',
						'name' => 'details',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'rows' => '',
						'placeholder' => '',
						'new_lines' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'epk_event',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
				'show_in_rest' => 1,
			) );
		}	
	}
	add_action( 'acf/include_fields', 'add_epk_events_acf' );
}
