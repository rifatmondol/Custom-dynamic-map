<?php

/**
 * Header settings
 */
Redux::set_section($opt_name, array(
	'title'            => esc_html__('Header', HELLO_ELEMENTOR_CHILD),
	'id'               => 'wooprex_header_section',
	'icon'             => 'flaticon-header',
));


// Logo
Redux::set_section($opt_name, array(
	'title'      => esc_html__('Header Settings', HELLO_ELEMENTOR_CHILD),
	'id'         => 'wooprex_header_setting',
	'icon'       => '',
	'subsection' => true,
	'fields'     => array(
		array(
			'title'    => esc_html__('Main Logo', HELLO_ELEMENTOR_CHILD),
			'subtitle' => esc_html__('Upload the main logo image for your header.', HELLO_ELEMENTOR_CHILD),
			'id'       => 'wooprex_m_logo',
			'type'     => 'media',
			'compiler' => true,
			'default'  => array(
				'url' => esc_url(get_stylesheet_directory_uri() . '/assets/svg/logo.png')
			)
		),
		array(
			'title'    => esc_html__('Logo Width', HELLO_ELEMENTOR_CHILD),
			'subtitle' => esc_html__('Adjust the width of the uploaded logo.', HELLO_ELEMENTOR_CHILD),
			'id'       => 'logo_dimensions',
			'type'     => 'dimensions',
			'units'    => array('px', 'em', '%'),
			'output'   => 'header.wx-header-section .header-logo img',
			'default'  => array(
				'width'   => '235',
				'height'  => ''
			),
		),
		array(
			'id'      => 'header_btn_label',
			'type'    => 'text',
			'title'   => esc_html__('Button Label', HELLO_ELEMENTOR_CHILD),
			'default' => 'Contact',
		),
		array(
			'id'      => 'header_btn_url',
			'type'    => 'text',
			'title'   => esc_html__('Button Link', HELLO_ELEMENTOR_CHILD),
			'default' => home_url('/'),
		),
		array(
			'id'      => 'header_btn_label_en',
			'type'    => 'text',
			'title'   => esc_html__('Button Label(EN)', HELLO_ELEMENTOR_CHILD),
			'default' => 'Contact',
		),
		array(
			'id'      => 'header_btn_url_en',
			'type'    => 'text',
			'title'   => esc_html__('Button Link(EN)', HELLO_ELEMENTOR_CHILD),
			'default' => home_url('/'),
		),

		array(
			'id'      => 'google_map_key',
			'type'    => 'text',
			'title'   => esc_html__('Map API Key', HELLO_ELEMENTOR_CHILD),
			'default' => 'api key',
		),

	)
));
