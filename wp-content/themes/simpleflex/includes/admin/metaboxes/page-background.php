<?php

return array(
	'id'          => 'page-background',
	'types'       => array('post', 'page', 'portfolio'),
	'title'       => __('Page Background', 'luxe_framework'),
	'priority'    => 'high',
	'template'    => array(
		array(
			'type' => 'color',
			'name' => 'background-color',
			'label' => __('Background Color', 'luxe_framework'),
			'description' => __('', 'luxe_framework'),
			'default' => '',
			'format' => 'rgb'
		),
		array(
			'type'        => 'select',
			'name'        => 'background-shadow',
			'label'       => 'Background Shadow',
			'description' => 'Light shadow displayed on the right half of your background image/color.',
			'items'       => array(
				array(
					'value' => '0',
					'label' => __('No Shadow', 'luxe_framework'),
				),
				array(
					'value' => '1',
					'label' => __('Show Shadow', 'luxe_framework'),
				),
			),
			'default'     => array(
				'0',
			),
		),
		array(
			'type' => 'upload',
			'name' => 'background-image',
			'label' => __('Background Image', 'luxe_framework'),
			'description' => __('', 'luxe_framework'),
			'default' => '',
		),
		array(
			'type'        => 'select',
			'name'        => 'background-repeat',
			'label'       => 'Background Repeat',
			'description' => 'Choose how your background image is displayed.',
			'dependency' => array(
				'field'    => 'background-image',
				'function' => 'vp_dep_boolean',
			),
			'items'       => array(
				array(
					'value' => 'cover',
					'label' => __('Stretch to Fit', 'luxe_framework'),
				),
				array(
					'value' => 'repeat-x',
					'label' => __('Repeat Horizontally', 'luxe_framework'),
				),
				array(
					'value' => 'repeat-y',
					'label' => __('Repeat Vertically', 'luxe_framework'),
				),
				array(
					'value' => 'repeat',
					'label' => __('Repeat Both', 'luxe_framework'),
				),
				array(
					'value' => 'no-repeat',
					'label' => __('No Repeat', 'luxe_framework'),
				),
			),
			'default'     => array(
				'cover',
			),
		),
		array(
			'type'        => 'select',
			'name'        => 'background-attachment',
			'label'       => 'Background Attachment',
			'description' => 'Choose how your background moves with the page.',
			'dependency' => array(
				'field'    => 'background-image',
				'function' => 'vp_dep_boolean',
			),
			'items'       => array(
				array(
					'value' => 'scroll',
					'label' => __('Scroll (traditional background)', 'luxe_framework'),
				),
				array(
					'value' => 'fixed',
					'label' => __('Fixed (parallax effect)', 'luxe_framework'),
				),
			),
			'default'     => array(
				'scroll',
			),
		),
		array(
			'type' => 'textbox',
			'name' => 'background-position',
			'label' => __('Background Position', 'luxe_framework'),
			'dependency' => array(
				'field'    => 'background-image',
				'function' => 'vp_dep_boolean',
			),
			'description' => __('This determines how the background is placed. You can enter in percentage (x% y%) or pixels (i.e., 50px 100px)', 'luxe_framework'),
		),
		array(
			'type'        => 'select',
			'name'        => 'container-arrow',
			'label'       => 'Container Arrow',
			'description' => 'Show or hide the arrow after each page container (only on one-page templates).',
			'items'       => array(
				array(
					'value' => '1',
					'label' => __('Show Arrow', 'luxe_framework'),
				),
				array(
					'value' => '0',
					'label' => __('Hide Arrow', 'luxe_framework'),
				),
			),
			'default'     => array(
				'1',
			),
		),
		
	),
);

/**
 * EOF
 */