<?php

return array(
	'id'          => 'post',
	'types'       => array('post', 'portfolio'),
	'title'       => __('Post Settings', 'luxe_framework'),
	'priority'    => 'high',
	'template'    => array(
		array(
			'type'        => 'wpeditor',
			'name'        => 'custom-code',
			'label'       => 'Custom Post Code',
			'description' => 'You can add sliders, video embeds, or any other custom code to this area.  This will override the default featured image.'
		),
		array(
		    'type'      => 'group',
		    'repeating' => true,
		    'name'      => 'gallery-images',
		    'title'     => __('Gallery Images', 'luxe_framework'),
		    'fields'    => array(
		        array(
		            'type'        => 'upload',
		            'name'        => 'gallery-image',
		            'label'       => __('Gallery Image', 'luxe_framework'),
		            'description' => __('Add images here for your gallery post type.', 'luxe_framework'),
		            'default'     => '',
		        ),
		        /* more controls fields or even nested group ... */
		    ),
		),
	    array(
	        'type' => 'textbox',
	        'name' => 'video',
	        'label' => __('Video URL', 'luxe_framework'),
	        'description' => __('Vimeo or Youtube URL', 'luxe_framework'),
	        'default' => '',
	        'validation' => 'url',
	    ),
	    array(
	        'type' => 'color',
	        'name' => 'border-color',
	        'label' => __('Post Border Color', 'vp_textdomain'),
	        'description' => __('The border color of the post displayed in the blog shortcode and on the blog page.', 'vp_textdomain'),
	        'default' => '',
	        'format' => 'hex',
	    ),
	),
);

/**
 * EOF
 */