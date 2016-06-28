<?php

return array(
	'id'          => 'portfolio',
	'types'       => array('portfolio'),
	'title'       => __('Portfolio Item Settings', 'luxe_framework'),
	'priority'    => 'high',
	'template'    => array(
	    array(
	        'type' => 'textbox',
	        'name' => 'skills',
	        'label' => __('Skills', 'luxe_framework'),
	        'description' => __('', 'luxe_framework'),
	        'default' => '',
	    ),
	    array(
	        'type' => 'textbox',
	        'name' => 'client',
	        'label' => __('Client', 'luxe_framework'),
	        'description' => __('', 'luxe_framework'),
	        'default' => '',
	    ),
	    array(
	        'type' => 'textbox',
	        'name' => 'location',
	        'label' => __('Location', 'luxe_framework'),
	        'description' => __('', 'luxe_framework'),
	        'default' => '',
	    ),
	    array(
	        'type' => 'textbox',
	        'name' => 'project-link',
	        'label' => __('Project Link', 'luxe_framework'),
	        'description' => __('', 'luxe_framework'),
	        'default' => ''
	    ),
	),
);

/**
 * EOF
 */