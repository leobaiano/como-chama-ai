<?php

return array(
	'id'          => 'page-layout',
	'types'       => array('post', 'page'),
	'title'       => __('Page Layout Settings', 'luxe_framework'),
	'priority'    => 'high',
	'template'    => array(
		array(
			'type'        => 'select',
			'name'        => 'page-title',
			'label'       => 'Page Title',
			'description' => 'Choose how your background image is displayed.',
			'items'       => array(
				array(
					'value' => '1',
					'label' => __('Show Title', 'luxe_framework'),
				),
				array(
					'value' => '0',
					'label' => __('Hide Title', 'luxe_framework'),
				),
			),
			'default'     => array(
				'1',
			),
		),
		array(
			'type' => 'textbox',
			'name' => 'page-subtitle',
			'label' => __('Page Subtitle', 'luxe_framework'),
			'dependency' => array(
				'field'    => 'page-title',
				'function' => 'vp_dep_boolean',
			),
			'description' => __('Description shown beneath the page title.', 'luxe_framework'),
		),
		array(
			'type'        => 'select',
			'name'        => 'sidebar-position',
			'label'       => 'Sidebar Position',
			'description' => 'This will override your default sidebar position in theme options.',
			'items'       => array(
				array(
					'value' => 'default',
					'label' => __('Default (Theme Options)', 'luxe_framework'),
				),
				array(
					'value' => 'no-sidebar',
					'label' => __('No Sidebar', 'luxe_framework'),
				),
				array(
					'value' => 'sidebar-left',
					'label' => __('Left Sidebar', 'luxe_framework'),
				),
				array(
					'value' => 'sidebar-right',
					'label' => __('Right Sidebar', 'luxe_framework'),
				),
			),
			'default'     => array(
				'default',
			),
		),
		array(
			'type' => 'textbox',
			'name' => 'padding-top',
			'label' => __('Padding Top', 'luxe_framework'),
			'description' => __('The padding on top of any page in pixels.  (Default is 70)', 'luxe_framework'),
			'default' => '70',
		),
		array(
			'type' => 'textbox',
			'name' => 'padding-bottom',
			'label' => __('Padding Bottom', 'luxe_framework'),
			'description' => __('The padding on bottom of any page in pixels.  (Default is 70)', 'luxe_framework'),
			'default' => '70',
		),

		
	),
);

/**
 * EOF
 */