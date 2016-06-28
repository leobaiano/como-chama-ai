<?php

/**
	ThemeLuxe Framework Options Configuration
	For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
**/

if ( !class_exists( "ReduxFramework" ) ) {
	return;
} 

if ( !class_exists( "Luxe_Options" ) ) {
	class Luxe_Options {

		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		public function __construct( ) {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();
			
			// Set a few help tabs so you can see how it's done
			$this->setHelpTabs();

			// Create the sections and fields
			$this->setSections();
			
			if ( !isset( $this->args['opt_name'] ) ) { // No errors please
				return;
			}
			

			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);

		}

		public function setSections() {


			// JQuery Easing Effects
			$easing =	 array(
				'linear'           => 'linear',
				'swing'            => 'swing',
				'jswing'           => 'jswing',
				'easeInQuad'       => 'easeInQuad',
				'easeOutQuad'      => 'easeOutQuad',
				'easeInOutQuad'    => 'easeInOutQuad',
				'easeInCubic'      => 'easeInCubic',
				'easeOutCubic'     => 'easeOutCubic',
				'easeInOutCubic'   => 'easeInOutCubic',
				'easeInQuart'      => 'easeInQuart',
				'easeOutQuart'     => 'easeOutQuart',
				'easeInOutQuart'   => 'easeInOutQuart',
				'easeInQuint'      => 'easeInQuint',
				'easeOutQuint'     => 'easeOutQuint',
				'easeInOutQuint'   => 'easeInOutQuint',
				'easeInSine'       => 'easeInSine',
				'easeOutSine'      => 'easeOutSine',
				'easeInOutSine'    => 'easeInOutSine',
				'easeInExpo'       => 'easeInExpo',
				'easeOutExpo'      => 'easeOutExpo',
				'easeInOutExpo'    => 'easeInOutExpo',
				'easeInCirc'       => 'easeInCirc',
				'easeOutCirc'      => 'easeOutCirc',
				'easeInOutCirc'    => 'easeInOutCirc',
				'easeInElastic'    => 'easeInElastic',
				'easeOutElastic'   => 'easeOutElastic',
				'easeInOutElastic' => 'easeInOutElastic',
				'easeInBack'       => 'easeInBack',
				'easeOutBack'      => 'easeOutBack',
				'easeInOutBack'    => 'easeInOutBack',
				'easeInBounce'     => 'easeInBounce',
				'easeOutBounce'    => 'easeOutBounce',
				'easeInOutBounce'  => 'easeInOutBounce'
			);	

			ob_start();

			$ct = wp_get_theme();
			$this->theme = $ct;
			$item_name = $this->theme->get('Name'); 
			$tags = $this->theme->Tags;
			$screenshot = $this->theme->get_screenshot();
			$class = $screenshot ? 'has-screenshot' : '';

			$customize_title = sprintf( __( 'Customize &#8220;%s&#8221;','luxe_framework' ), $this->theme->display('Name') );

			?>
			<div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
				<?php if ( $screenshot ) : ?>
					<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
					<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr( $customize_title ); ?>">
						<img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
					</a>
					<?php endif; ?>
					<img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
				<?php endif; ?>

				<h4>
					<?php echo $this->theme->display('Name'); ?>
				</h4>

				<div>
					<ul class="theme-info">
						<li><?php printf( __('By %s','luxe_framework'), $this->theme->display('Author') ); ?></li>
						<li><?php printf( __('Version %s','luxe_framework'), $this->theme->display('Version') ); ?></li>
						<li><?php echo '<strong>'.__('Tags', 'luxe_framework').':</strong> '; ?><?php printf( $this->theme->display('Tags') ); ?></li>
					</ul>
					<p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
					<?php if ( $this->theme->parent() ) {
						printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.' ) . '</p>',
							__( 'http://codex.wordpress.org/Child_Themes','luxe_framework' ),
							$this->theme->parent()->display( 'Name' ) );
					} ?>
					
				</div>

			</div>

			<?php
			$item_info = ob_get_contents();
			    
			ob_end_clean();


			// ACTUAL DECLARATION OF SECTIONS

			$this->sections[] = array(
				'title' => __('General Settings', 'luxe_framework'),
				'desc' => __('', 'luxe_framework'),
				'icon' => 'el-icon-cogs',
			    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
				'fields' => array(								
					array(
						'id'=>'logo',
						'type' => 'media', 
						'url'=> true,
						'title' => __('Logo', 'luxe_framework'),
						'compiler' => 'true',
						'desc'=> __('Upload your site logo.', 'luxe_framework'),
						'subtitle' => __('', 'luxe_framework'),
						'default'=>array('url'=> get_template_directory_uri().'/images/logo.png'),
						),
					array(
						'id'=>'favicon',
						'type' => 'media', 
						'url'=> true,
						'title' => __('Favicon', 'luxe_framework'),
						'compiler' => 'true',
						'desc'=> __('Upload your site\'s favicon.', 'luxe_framework'),
						'subtitle' => __('This is the icon displayed next to the site title in your browser\'s tab.', 'luxe_framework')
						),
					array(
						'id'=>'container-width',
						'type' => 'dimensions',
						//'units' => 'px, %, em', // You can specify a unit value. Possible: px, em, %
						'units_extended' => 'true', // Allow users to select any type of unit
						'height' => false,
						'title' => __('Maximum Container Width', 'luxe_framework'),
						'subtitle' => __('Choose the maximum width of the container for all pages.', 'luxe_framework'),
						'desc' => __('Units can be in px, em or %.', 'luxe_framework'),
						'default' => array('width' => 1180 )
						),	
					array(
						'id'=>'page-scrolling-easing',
						'type' => 'select',
						'title' => __('Page Scroll Easing', 'luxe_framework'), 
						'subtitle' => __('The transition effect of scrolling between pages for one page templates.', 'luxe_framework'),
						'desc' => __('', 'luxe_framework'),
						'default' => 'linear',
						'options' => $easing,//Must provide key => value pairs for select options
						),	
					array(
						'id'=>'page-scrolling-speed',
						'type' => 'slider', 
						'title' => __('Page Scrolling Speed', 'luxe_framework'),
						'subtitle' => __('Time it takes to scroll after clicking a link on a one-page template.', 'luxe_framework'),
						'desc'=> __('Speed is in milliseconds, default value: 1600', 'luxe_framework'),
						"default" 		=> "1600",
						"min" 		=> "0",
						"step"		=> "100",
						"max" 		=> "7000",
						),	
					array(
						'id'=>'preloader',
						'type' => 'switch', 
						'title' => __('Page Preloader', 'luxe_framework'),
						'subtitle'=> __('Displays your logo with a loading icon until the page is fully loaded.', 'luxe_framework'),
						"default" 		=> 0,
						),		
					array(
                         'id'=>'section-media-end',
                         'type' => 'section', 
                         'title' => __('Custom Code', 'luxe_framework'),
                         'indent' => false // Indent all options below until the next 'section' option is set.
                         ),  
			        array(
						'id'=>'custom-css',
						'type' => 'ace_editor',
						'title' => __('CSS Code', 'luxe_framework'), 
						'subtitle' => __('Paste your CSS code here.', 'luxe_framework'),
						'mode' => 'css',
			            'theme' => 'monokai',
						'desc' => '',
			            'default' => ".header{\n\n}"
						),
			        array(
						'id'=>'custom-js',
						'type' => 'ace_editor',
						'title' => __('JavaScript Code', 'luxe_framework'), 
						'subtitle' => __('Paste your JavaScript code here.', 'luxe_framework'),
						'mode' => 'javascript',
			            'theme' => 'chrome',
						'desc' => 'Your Google Analytics Script can also be added here.',
			            'default' => "jQuery(document).ready(function(){\n\n});"
						),	        	

					),
				);



			$this->sections[] = array(
				'type' => 'divide',
			);

			/**
			 *  Note here I used a 'heading' in the sections array construct
			 *  This allows you to use a different title on your options page
			 * instead of reusing the 'title' value.  This can be done on any 
			 * section - kp
			 */
			$this->sections[] = array(
				'icon'    => 'el-icon-home',
				'title'   => __('Header', 'luxe_framework'),
				'heading' => __('Validate ALL fields within Redux.', 'luxe_framework'),
				'desc'    => __('', 'luxe_framework'),
				'fields'  => array(
					array(
						'id'=>'header-background-color',
						'type' => 'color_rgba',
						'title' => __('Header Background Color', 'luxe_framework'), 
						'subtitle' => __('Sets the background color and opacity for your header.', 'luxe_framework'),
						'default' => array( 'color' => '#ffffff', 'alpha' => '1.0' ),
						'output' => array('header[role="banner"]'),
						'mode' => 'background',
						'validate' => 'colorrgba',
						),	
					array(
						'id'=>'header-shadow',
						'type' => 'switch', 
						'title' => __('Header Shadow', 'luxe_framework'),
						'subtitle'=> __('Light shadow displayed on the right half of your header.', 'luxe_framework'),
						"default"=> 1,
						),	
					array(
						'id'=>'header-border',
						'type' => 'border',
						'top'=>true, // Disable the top
						'right' => true, // Disable the right
						'bottom' => true, // Disable the bottom
						'left' => true, // Disable the left
						'all' => false,
						'title' => __('Header Border Option', 'luxe_framework'),
						'subtitle' => __('Set the border around your header', 'luxe_framework'),
						'output' => array('header[role="banner"]'), // An array of CSS selectors to apply this font style to
						'desc' => __('Can be used to create a line above or below your header', 'luxe_framework'),
						'default' => array('border-color' => '#ccc', 'border-style' => 'solid', 'border-top'=>'0px', 'border-right'=>'0px', 'border-bottom'=>'0px', 'border-left'=>'0px')
						),	
					/*array(
						'id'=>'header-padding',
						'type' => 'spacing',
						'mode'=>'padding', // absolute, padding, margin, defaults to padding
						//'top'=>false, // Disable the top
						'right' => false, // Disable the right
						//'bottom' => false, // Disable the bottom
						'left' => false, // Disable the left
						//'all' => true, // Have one field that applies to all
						'units' => 'px', // You can specify a unit value. Possible: px, em, %
						//'units_extended' => 'true', // Allow users to select any type of unit
						//'display_units' => 'false', // Set to false to hide the units if the units are specified
						'output' => array('header[role="banner"]'), // An array of CSS selectors to apply this font style to
						'title' => __('Padding/Margin Option', 'luxe_framework'),
						'subtitle' => __('Padding around your header', 'luxe_framework'),
						'desc' => __('Increase the top and bottom heading to make your header larger or change the position of the navigation.', 'luxe_framework'),
						'default' => array('padding-top' => '20px', 'padding-right'=>"0px", 'padding-bottom' => '10px', 'padding-left'=>'0px' )
						),	*/

					array(
						'id'=>'header-height',
						'type' => 'dimensions',
						//'units' => 'px, %, em', // You can specify a unit value. Possible: px, em, %
						'units_extended' => 'true', // Allow users to select any type of unit
						'width' => 'false',
						'title' => __('Header Height', 'luxe_framework'),
						'subtitle' => __('Choose the height of the header', 'luxe_framework'),
						'desc' => __('', 'luxe_framework'),
						'default' => array('height' => '100px' )
						),
					array(
						'id'=>'header-resize',
						'type' => 'switch', 
						'title' => __('Header Resize', 'luxe_framework'),
						'subtitle'=> __('Resize the header on scroll', 'luxe_framework'),
						"default"=> 1,
						),		
					array(
						'id'=>'header-scrolled-height',
						'type' => 'dimensions',
						//'units' => 'px, %, em', // You can specify a unit value. Possible: px, em, %
						'units_extended' => 'true', // Allow users to select any type of unit
						'width' => 'false',
						'title' => __('Header Scrolled Height', 'luxe_framework'),
						'subtitle' => __('Height of the header after the user has scrolled a set distance.', 'luxe_framework'),
						'desc' => __('', 'luxe_framework'),
						'required' => array('header-resize', '=' , '1'),
						'default' => array('height' => '50px' )
						),	
					array(
						'id'=>'header-scrolled-distance',
						'type' => 'dimensions',
						//'units' => 'px, %, em', // You can specify a unit value. Possible: px, em, %
						'units_extended' => 'true', // Allow users to select any type of unit
						'width' => 'false',
						'title' => __('Header Scrolled Distance', 'luxe_framework'),
						'subtitle' => __('Distance scrolled before the header changes to the secondary size.', 'luxe_framework'),
						'desc' => __('', 'luxe_framework'),
						'required' => array('header-resize', '=' , '1'),
						'default' => array('height' => '300px' )
					),
					/*array(
						'id'=>'navigation-link-color',
						'type' => 'link_color',
						'title' => __('Navigation Link Color', 'luxe_framework'),
						'subtitle' => __('Only color validation can be done on this field type', 'luxe_framework'),
						'desc' => __('This is the description field, again good for additional info.', 'luxe_framework'),
						//'regular' => false, // Disable Regular Color
						//'hover' => false, // Disable Hover Color
						//'active' => false, // Disable Active Color
						'visited' => true, // Enable Visited Color
						'output' => array('.nav a'),
						'default' => array(
							'regular' => '#aaa',
							'hover' => '#bbb',
							'active' => '#ccc',
						)
					),
					array(
						'id'=>'navigation-submenu-link-color',
						'type' => 'link_color',
						'title' => __('Navigation Sub-menu Link Color', 'luxe_framework'),
						'subtitle' => __('Only color validation can be done on this field type', 'luxe_framework'),
						'desc' => __('This is the description field, again good for additional info.', 'luxe_framework'),
						//'regular' => false, // Disable Regular Color
						//'hover' => false, // Disable Hover Color
						//'active' => false, // Disable Active Color
						'visited' => true, // Enable Visited Color
						'output' => array('.nav a ul li a'),
						'default' => array(
							'regular' => '#aaa',
							'hover' => '#bbb',
							'active' => '#ccc',
						)
					),*/
					array(
						'id'=>'navigation-font',
						'type' => 'typography', 
						'title' => __('Navigation Font', 'luxe_framework'),
						//'compiler'=>true, // Use if you want to hook in your own CSS compiler
						'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'=>true, // Select a backup non-google font in addition to a google font
						//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
						//'subsets'=>false, // Only appears if google is true and subsets not set to false
						'font-size'=>true,
						'line-height'=>false,
						//'word-spacing'=>true, // Defaults to false
						//'letter-spacing'=>true, // Defaults to false
						//'color'=>false,
						//'preview'=>false, // Disable the previewer
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('header[role="banner"] .nav li a'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'subtitle'=> __('Font used for your navigation.  Main body font will be used if not selected.', 'luxe_framework'),
						'default'=> array(
							'color'=>"#333", 
							'font-style'=>'300', 
							'font-family'=>'Raleway', 
							'google' => true,
							'font-size'=>'13px'),
						),	

					)
				);

			$this->sections[] = array(
				'icon' => 'el-icon-website',
				'title' => __('Body', 'luxe_framework'),
				'fields' => array(
					array(
						'id'=>'default-sidebar',
						'type' => 'image_select',
						'compiler'=>true,
						'title' => __('Default Sidebar Layout', 'luxe_framework'), 
						'subtitle' => __('Select main content and sidebar alignment.', 'luxe_framework'),
						'options' => array(
								'no-sidebar' => array('alt' => 'No Sidebar', 'img' => ReduxFramework::$_url.'assets/img/1col.png'),
								'sidebar-left' => array('alt' => 'Left Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cl.png'),
								'sidebar-right' => array('alt' => 'Right Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cr.png')
							),
						'default' => '2'
						),
					array(
						'id'=>'accent',
						'type' => 'color',
						'output' => array('.accent, header[role="banner"] .nav li a:hover, header[role="banner"] .nav li ul li a:hover, .portfolio-container .isotope .portfolio-title a:hover, .portfolio-filter .active a'),
						'title' => __('Theme Accent', 'luxe_framework'), 
						'subtitle' => __('Your theme\'s main accent color.', 'luxe_framework'),
						'default' => '#ff6f6f',
						//'validate' => 'color',
						),	
					array(
						'id'=>'body-background',
						'type' => 'background',
						'output' => array('body'),
						'title' => __('Body Background', 'luxe_framework'), 
						'subtitle' => __('Body background image or color', 'luxe_framework'),
					    'default'  => array(
					        'background-color' => '#343434',
					    ),
						//'validate' => 'color',
						),	
  
					
					array(
						'id'=>'main-font',
						'type' => 'typography', 
						'title' => __('Main Font', 'luxe_framework'),
						//'compiler'=>true, // Use if you want to hook in your own CSS compiler
						'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'=>true, // Select a backup non-google font in addition to a google font
						//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
						//'subsets'=>false, // Only appears if google is true and subsets not set to false
						//'font-size'=>false,
						//'line-height'=>false,
						//'word-spacing'=>true, // Defaults to false
						//'letter-spacing'=>true, // Defaults to false
						//'color'=>false,
						//'preview'=>false, // Disable the previewer
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('body, p, input, textarea'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'subtitle'=> __('Main typography font for your site.', 'luxe_framework'),
						'default'=> array(
							'color'=>"#989898", 
							'font-style'=>'500', 
							'font-family'=>'Raleway', 
							'google' => true,
							'font-size'=>'14px', 
							'line-height'=>'18px'),
						),	
					array(
						'id'=>'heading-font',
						'type' => 'typography', 
						'title' => __('Heading Font', 'luxe_framework'),
						//'compiler'=>true, // Use if you want to hook in your own CSS compiler
						'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'=>true, // Select a backup non-google font in addition to a google font
						//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
						//'subsets'=>false, // Only appears if google is true and subsets not set to false
						'font-size'=>false,
						'line-height'=>false,
						//'word-spacing'=>true, // Defaults to false
						//'letter-spacing'=>true, // Defaults to false
						//'color'=>false,
						//'preview'=>false, // Disable the previewer
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'subtitle'=> __('Font used for all headings on your site.', 'luxe_framework'),
						'default'=> array(
							'color'=>"#ffffff", 
							'font-style'=>'500', 
							'font-family'=>'Raleway', 
							'google' => true),
						),	
					array(
						'id'=>'extra-font',
						'type' => 'typography', 
						'title' => __('Extra Font', 'luxe_framework'),
						//'compiler'=>true, // Use if you want to hook in your own CSS compiler
						'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'=>true, // Select a backup non-google font in addition to a google font
						//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
						//'subsets'=>false, // Only appears if google is true and subsets not set to false
						'font-size'=>false,
						'line-height'=>false,
						//'word-spacing'=>true, // Defaults to false
						//'letter-spacing'=>true, // Defaults to false
						//'color'=>false,
						//'preview'=>false, // Disable the previewer
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('.extra-font'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'subtitle'=> __('Font used inside the [font] shortcode.', 'luxe_framework'),
						'default'=> array(
							'color'=>"#f2f2f2", 
							'font-style'=>'500', 
							'font-family'=>'Noticia+Text', 
							'google' => true,
							'font-size'=>'14px', 
							'line-height'=>'18px'),
						),	
					array(
						'id'=>'link-color',
						'type' => 'link_color',
						'title' => __('Links Color', 'luxe_framework'),
						'subtitle' => __('', 'luxe_framework'),
						'desc' => __('', 'luxe_framework'),
						//'regular' => false, // Disable Regular Color
						//'hover' => false, // Disable Hover Color
						'active' => false, // Disable Active Color
						//'visited' => true, // Enable Visited Color
						'output' => array('a'),
						'default' => array(
							'regular' => '#ffffff',
							'hover' => '#ff6f6f',
						)
					),
					array(
						'id'=>'button-text-color',
						'type' => 'link_color',
						'title' => __('Button Text Color', 'luxe_framework'),
						'subtitle' => __('', 'luxe_framework'),
						'desc' => __('', 'luxe_framework'),
						//'regular' => false, // Disable Regular Color
						//'hover' => false, // Disable Hover Color
						'active' => false, // Disable Active Color
						//'visited' => true, // Enable Visited Color
						'output' => array('.button:hover .button-text, input[type="submit"]'),
						'default' => array(
							'regular' => '#ffffff',
							'hover' => '#ff6f6f',
						)
					),		
					array(
						'id'=>'button-background-color',
						'type' => 'link_color',
						'title' => __('Button Background Color', 'luxe_framework'),
						'subtitle' => __('', 'luxe_framework'),
						'desc' => __('', 'luxe_framework'),
						//'regular' => false, // Disable Regular Color
						//'hover' => false, // Disable Hover Color
						'active' => false, // Disable Active Color
						//'visited' => true, // Enable Visited Color
						'default' => array(
							'regular' => '#ffffff',
							'hover' => '#ff6f6f',
						)
					),		
					array(
						'id'=>'alternate-button-text-color',
						'type' => 'link_color',
						'title' => __('Alternate Button Text Color', 'luxe_framework'),
						'subtitle' => __('', 'luxe_framework'),
						'desc' => __('', 'luxe_framework'),
						//'regular' => false, // Disable Regular Color
						//'hover' => false, // Disable Hover Color
						'active' => false, // Disable Active Color
						//'visited' => true, // Enable Visited Color
						'output' => array('.button.alt'),
						'default' => array(
							'regular' => '#343434',
							'hover' => '#343434',
						)
					),		
					array(
						'id'=>'alternate-button-background-color',
						'type' => 'link_color',
						'title' => __('Alternate Button Background Color', 'luxe_framework'),
						'subtitle' => __('', 'luxe_framework'),
						'desc' => __('', 'luxe_framework'),
						//'regular' => false, // Disable Regular Color
						//'hover' => false, // Disable Hover Color
						'active' => false, // Disable Active Color
						//'visited' => true, // Enable Visited Color
						'default' => array(
							'regular' => '#ffffff',
							'hover' => '#ffffff',
						)
					),			        


				)
			);




			$this->sections[] = array(
				'icon' => 'el-icon-lines',
				'title' => __('Footer', 'luxe_framework'),
				'fields' => array(
					array(
						'id'=>'footer-widgets',
						'type' => 'select',
						'title' => __('Footer Widgets', 'luxe_framework'), 
						'subtitle' => __('The number of footer widgets to appear on your site.', 'luxe_framework'),
						'desc' => __('This is the description field, again good for additional info.', 'luxe_framework'),
						'options' => array('0' => 'None', '1' => '1 Column','2' => '2 Columns','3' => '3 Columns','4' => '4 Columns','5' => '5 Columns'),//Must provide key => value pairs for select options
						'default' => '4'
						),
					array(
						'id'=>'footer-widgets-background-color',
						'type' => 'background',
						'background-position' => false,
						'background-repeat' => false,
						'background-image' => false,
						'background-size' => false,
						'background-attachment' => false,
						'preview' => false,
						'title' => __('Footer Widgets Background Color', 'luxe_framework'), 
						'subtitle' => __('Pick a background color for behind the widgets', 'luxe_framework'),
						'output' => array('#footer-widgets'), // An array of CSS selectors to apply this font style to dynamically
					    'default'  => array(
					        'background-color' => '#ffffff',
					    ),
						'validate' => 'color',
						),
					array(
						'id'=>'footer-background-color',
						'type' => 'background',
						'background-position' => false,
						'background-repeat' => false,
						'background-image' => false,
						'background-size' => false,
						'background-attachment' => false,
						'preview' => false,
						'title' => __('Footer Copy Background Color', 'luxe_framework'), 
						'subtitle' => __('Pick a background color for behind your footer copy area.', 'luxe_framework'),
						'output' => array('#footer-copy'), // An array of CSS selectors to apply this font style to dynamically
					    'default'  => array(
					        'background-color' => '#242424',
					    ),
						'validate' => 'color',
						),	
					array(
						'id'=>'footer-heading-font',
						'type' => 'typography', 
						'title' => __('Footer Headings Font', 'luxe_framework'),
						//'compiler'=>true, // Use if you want to hook in your own CSS compiler
						//'font-family'=>false,
						'font-weight'=>false,
						'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'=>false, // Select a backup non-google font in addition to a google font
						'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
						//'subsets'=>false, // Only appears if google is true and subsets not set to false
						'font-size'=>true,
						'line-height'=>false,
						//'word-spacing'=>true, // Defaults to false
						//'letter-spacing'=>true, // Defaults to false
						//'color'=>false,
						'preview'=>true, // Disable the previewer
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('footer[role="contentinfo"] h1, footer[role="contentinfo"] h2, footer[role="contentinfo"] h3, footer[role="contentinfo"] h4, footer[role="contentinfo"] h5, footer[role="contentinfo"] h6'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'subtitle'=> __('Font style for the headings in the footer.', 'luxe_framework'),
						'default'=> array(
							'color'=>"#343434",  
							'font-size'=>'18px', 
							'line-height'=>'18px'),
						),	
					array(
						'id'=>'footer-widgets-font',
						'type' => 'typography', 
						'title' => __('Footer Widgets Font', 'luxe_framework'),
						//'compiler'=>true, // Use if you want to hook in your own CSS compiler
						'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'=>false, // Select a backup non-google font in addition to a google font
						'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
						'subsets'=>false, // Only appears if google is true and subsets not set to false
						'font-size'=>true,
						'line-height'=>false,
						//'word-spacing'=>true, // Defaults to false
						//'letter-spacing'=>true, // Defaults to false
						//'color'=>false,
						//'preview'=>false, // Disable the previewer
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('footer[role="contentinfo"] #footer-widgets'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'subtitle'=> __('Font style for the footer widgets area.  Main body font is used if none selected.', 'luxe_framework'),
						'default'=> array(
							'color'=>"#b7b7b7", 
							'font-style'=>'500', 
							'font-family'=>'Arial', 
							'google' => true,
							'font-size'=>'14px', 
							'line-height'=>'18px'),
						),		
					array(
						'id'=>'footer-widgets-link-color',
						'type' => 'link_color',
						'title' => __('Footer Widgets Link Color', 'luxe_framework'),
						'desc' => __('', 'luxe_framework'),
						//'regular' => false, // Disable Regular Color
						//'hover' => false, // Disable Hover Color
						'active' => false, // Disable Active Color
						//'visited' => true, // Enable Visited Color
						'output' => array('footer[role="contentinfo"] #footer-widgets a'),
						'default' => array(
							'regular' => '#343434',
							'hover' => '#f76c6c',
						)
					),
					array(
						'id'=>'footer-font',
						'type' => 'typography', 
						'title' => __('Footer Font', 'luxe_framework'),
						//'compiler'=>true, // Use if you want to hook in your own CSS compiler
						'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'=>false, // Select a backup non-google font in addition to a google font
						'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
						'subsets'=>false, // Only appears if google is true and subsets not set to false
						'font-size'=>true,
						'line-height'=>false,
						//'word-spacing'=>true, // Defaults to false
						//'letter-spacing'=>true, // Defaults to false
						//'color'=>false,
						//'preview'=>false, // Disable the previewer
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('footer[role="contentinfo"]'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'subtitle'=> __('Font style for all basic footer text.  Main body font is used if none selected.', 'luxe_framework'),
						'default'=> array(
							'color'=>"#343434", 
							'font-style'=>'500', 
							'font-family'=>'Arial', 
							'google' => true,
							'font-size'=>'14px', 
							'line-height'=>'18px'),
						),		
					array(
						'id'=>'footer-link-color',
						'type' => 'link_color',
						'title' => __('Footer Link Color', 'luxe_framework'),
						'subtitle' => __('Color for footer links', 'luxe_framework'),
						'desc' => __('', 'luxe_framework'),
						//'regular' => false, // Disable Regular Color
						//'hover' => false, // Disable Hover Color
						'active' => false, // Disable Active Color
						//'visited' => true, // Enable Visited Color
						'output' => array('footer[role="contentinfo"] a'),
						'default' => array(
							'regular' => '#fff',
							'hover' => '#f76c6c',
						)
					),
					array(
						'id'=>'footer-text',
						'type' => 'editor',
						'title' => __('Footer Text', 'luxe_framework'), 
						'subtitle' => __('You can use shortcodes in this field.', 'luxe_framework'),
						'default' => '&copy; '.date("Y").' | <a href="http://themeluxe.com" target="_blank">Theme Luxe</a>',
						),
															
				)
			);
				

			$this->sections[] = array(
				'icon' => 'el-icon-instagram',
				'title' => __('Portfolio', 'luxe_framework'),
				'desc' => __('', 'luxe_framework'),
				'fields' => array(
					array(
				    'id'       => 'portfolio-page',
				    'type'     => 'select',
				    'title'    => __('Portfolio Page', 'luxe_framework'), 
				    'subtitle' => __('If selected, this page will display beneath your portfolio single item page.', 'redux-framework-demo'),
				    'data' 	   => 'pages',
					),
				),
			);

					

			$theme_info = '<div class="redux-framework-section-desc">';
			$theme_info .= '<p class="redux-framework-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', 'luxe_framework').'<a href="'.$this->theme->get('ThemeURI').'" target="_blank">'.$this->theme->get('ThemeURI').'</a></p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-author">'.__('<strong>Author:</strong> ', 'luxe_framework').$this->theme->get('Author').'</p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-version">'.__('<strong>Version:</strong> ', 'luxe_framework').$this->theme->get('Version').'</p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-description">'.$this->theme->get('Description').'</p>';
			$tabs = $this->theme->get('Tags');
			if ( !empty( $tabs ) ) {
				$theme_info .= '<p class="redux-framework-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', 'luxe_framework').implode(', ', $tabs ).'</p>';	
			}
			$theme_info .= '</div>';

			if(file_exists(dirname(__FILE__).'/README.md')){
			$this->sections['theme_docs'] = array(
						'icon' => ReduxFramework::$_url.'assets/img/glyphicons/glyphicons_071_book.png',
						'title' => __('Documentation', 'luxe_framework'),
						'fields' => array(
							array(
								'id'=>'17',
								'type' => 'raw',
								'content' => file_get_contents(dirname(__FILE__).'/README.md')
								),				
						),
						
						);
			}//if




			// You can append a new section at any time.
			$this->sections[] = array(
				'icon' => 'el-icon-twitter',
				'title' => __('Social Media', 'luxe_framework'),
				'desc' => __('', 'luxe_framework'),
				'fields' => array(
			        array(
						'id' => 'soundcloud-rounded',
						'type' => 'text',
						'title' => __('Soundcloud Rounded', 'luxe_framework'),
						'subtitle' => __('Soundcloud Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'pinterest-rounded',
						'type' => 'text',
						'title' => __('Pinterest Rounded', 'luxe_framework'),
						'subtitle' => __('Pinterest Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'windows-rounded',
						'type' => 'text',
						'title' => __('Windows Rounded', 'luxe_framework'),
						'subtitle' => __('Windows Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'addthis-rounded',
						'type' => 'text',
						'title' => __('Addthis Rounded', 'luxe_framework'),
						'subtitle' => __('Addthis Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'sharethis-rounded',
						'type' => 'text',
						'title' => __('Sharethis Rounded', 'luxe_framework'),
						'subtitle' => __('Sharethis Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'picasa-rounded',
						'type' => 'text',
						'title' => __('Picasa Rounded', 'luxe_framework'),
						'subtitle' => __('Picasa Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'lastfm-rounded',
						'type' => 'text',
						'title' => __('Lastfm Rounded', 'luxe_framework'),
						'subtitle' => __('Lastfm Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'technorati-rounded',
						'type' => 'text',
						'title' => __('Technorati Rounded', 'luxe_framework'),
						'subtitle' => __('Technorati Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'mac-rounded',
						'type' => 'text',
						'title' => __('Mac Rounded', 'luxe_framework'),
						'subtitle' => __('Mac Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'dribble-rounded',
						'type' => 'text',
						'title' => __('Dribble Rounded', 'luxe_framework'),
						'subtitle' => __('Dribble Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'behance-rounded',
						'type' => 'text',
						'title' => __('Behance Rounded', 'luxe_framework'),
						'subtitle' => __('Behance Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'facebook-rounded',
						'type' => 'text',
						'title' => __('Facebook Rounded', 'luxe_framework'),
						'subtitle' => __('Facebook Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'google-rounded',
						'type' => 'text',
						'title' => __('Google Rounded', 'luxe_framework'),
						'subtitle' => __('Google Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'skype-rounded',
						'type' => 'text',
						'title' => __('Skype Rounded', 'luxe_framework'),
						'subtitle' => __('Skype Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'linkedin-rounded',
						'type' => 'text',
						'title' => __('Linkedin Rounded', 'luxe_framework'),
						'subtitle' => __('Linkedin Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'deviantart-rounded',
						'type' => 'text',
						'title' => __('Deviantart Rounded', 'luxe_framework'),
						'subtitle' => __('Deviantart Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'bing-rounded',
						'type' => 'text',
						'title' => __('Bing Rounded', 'luxe_framework'),
						'subtitle' => __('Bing Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'twitter-rounded',
						'type' => 'text',
						'title' => __('Twitter Rounded', 'luxe_framework'),
						'subtitle' => __('Twitter Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'myspace-rounded',
						'type' => 'text',
						'title' => __('Myspace Rounded', 'luxe_framework'),
						'subtitle' => __('Myspace Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'flickr-rounded',
						'type' => 'text',
						'title' => __('Flickr Rounded', 'luxe_framework'),
						'subtitle' => __('Flickr Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'tumblr-rounded',
						'type' => 'text',
						'title' => __('Tumblr Rounded', 'luxe_framework'),
						'subtitle' => __('Tumblr Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'paypal-rounded',
						'type' => 'text',
						'title' => __('Paypal Rounded', 'luxe_framework'),
						'subtitle' => __('Paypal Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'rss-rounded',
						'type' => 'text',
						'title' => __('Rss Rounded', 'luxe_framework'),
						'subtitle' => __('Rss Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'stumbleupon-rounded',
						'type' => 'text',
						'title' => __('Stumbleupon Rounded', 'luxe_framework'),
						'subtitle' => __('Stumbleupon Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'blogger-rounded',
						'type' => 'text',
						'title' => __('Blogger Rounded', 'luxe_framework'),
						'subtitle' => __('Blogger Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'vimeo-rounded',
						'type' => 'text',
						'title' => __('Vimeo Rounded', 'luxe_framework'),
						'subtitle' => __('Vimeo Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'wordpress-rounded',
						'type' => 'text',
						'title' => __('Wordpress Rounded', 'luxe_framework'),
						'subtitle' => __('Wordpress Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'youtube-rounded',
						'type' => 'text',
						'title' => __('Youtube Rounded', 'luxe_framework'),
						'subtitle' => __('Youtube Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'yahoo-rounded',
						'type' => 'text',
						'title' => __('Yahoo Rounded', 'luxe_framework'),
						'subtitle' => __('Yahoo Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'aim-rounded',
						'type' => 'text',
						'title' => __('Aim Rounded', 'luxe_framework'),
						'subtitle' => __('Aim Rounded URL', 'luxe_framework')
					),
			        array(
						'id' => 'dribble',
						'type' => 'text',
						'title' => __('Dribble', 'luxe_framework'),
						'subtitle' => __('Dribble URL', 'luxe_framework')
					),
			        array(
						'id' => 'behance',
						'type' => 'text',
						'title' => __('Behance', 'luxe_framework'),
						'subtitle' => __('Behance URL', 'luxe_framework')
					),
			        array(
						'id' => 'facebook',
						'type' => 'text',
						'title' => __('Facebook', 'luxe_framework'),
						'subtitle' => __('Facebook URL', 'luxe_framework')
					),
			        array(
						'id' => 'google',
						'type' => 'text',
						'title' => __('Google', 'luxe_framework'),
						'subtitle' => __('Google URL', 'luxe_framework')
					),
			        array(
						'id' => 'skype',
						'type' => 'text',
						'title' => __('Skype', 'luxe_framework'),
						'subtitle' => __('Skype URL', 'luxe_framework')
					),
			        array(
						'id' => 'linkedin',
						'type' => 'text',
						'title' => __('Linkedin', 'luxe_framework'),
						'subtitle' => __('Linkedin URL', 'luxe_framework')
					),
			        array(
						'id' => 'deviantart',
						'type' => 'text',
						'title' => __('Deviantart', 'luxe_framework'),
						'subtitle' => __('Deviantart URL', 'luxe_framework')
					),
			        array(
						'id' => 'bing',
						'type' => 'text',
						'title' => __('Bing', 'luxe_framework'),
						'subtitle' => __('Bing URL', 'luxe_framework')
					),
			        array(
						'id' => 'twitter',
						'type' => 'text',
						'title' => __('Twitter', 'luxe_framework'),
						'subtitle' => __('Twitter URL', 'luxe_framework')
					),
			        array(
						'id' => 'myspace',
						'type' => 'text',
						'title' => __('Myspace', 'luxe_framework'),
						'subtitle' => __('Myspace URL', 'luxe_framework')
					),
			        array(
						'id' => 'flickr',
						'type' => 'text',
						'title' => __('Flickr', 'luxe_framework'),
						'subtitle' => __('Flickr URL', 'luxe_framework')
					),
			        array(
						'id' => 'tumblr',
						'type' => 'text',
						'title' => __('Tumblr', 'luxe_framework'),
						'subtitle' => __('Tumblr URL', 'luxe_framework')
					),
			        array(
						'id' => 'paypal',
						'type' => 'text',
						'title' => __('Paypal', 'luxe_framework'),
						'subtitle' => __('Paypal URL', 'luxe_framework')
					),
			        array(
						'id' => 'rss',
						'type' => 'text',
						'title' => __('Rss', 'luxe_framework'),
						'subtitle' => __('Rss URL', 'luxe_framework')
					),
			        array(
						'id' => 'stumbleupon',
						'type' => 'text',
						'title' => __('Stumbleupon', 'luxe_framework'),
						'subtitle' => __('Stumbleupon URL', 'luxe_framework')
					),
			        array(
						'id' => 'blogger',
						'type' => 'text',
						'title' => __('Blogger', 'luxe_framework'),
						'subtitle' => __('Blogger URL', 'luxe_framework')
					),
			        array(
						'id' => 'vimeo',
						'type' => 'text',
						'title' => __('Vimeo', 'luxe_framework'),
						'subtitle' => __('Vimeo URL', 'luxe_framework')
					),
			        array(
						'id' => 'wordpress',
						'type' => 'text',
						'title' => __('Wordpress', 'luxe_framework'),
						'subtitle' => __('Wordpress URL', 'luxe_framework')
					),
			        array(
						'id' => 'youtube',
						'type' => 'text',
						'title' => __('Youtube', 'luxe_framework'),
						'subtitle' => __('Youtube URL', 'luxe_framework')
					),
			        array(
						'id' => 'yahoo',
						'type' => 'text',
						'title' => __('Yahoo', 'luxe_framework'),
						'subtitle' => __('Yahoo URL', 'luxe_framework')
					),
			        array(
						'id' => 'aim',
						'type' => 'text',
						'title' => __('Aim', 'luxe_framework'),
						'subtitle' => __('Aim URL', 'luxe_framework')
					)
						
					)

				);   

			$this->sections[] = array(
				'type' => 'divide',
			);

			$this->sections[] = array(
				'icon' => 'el-icon-info-sign',
				'title' => __('Theme Updates', 'luxe_framework'),
				'desc' => __('', 'luxe_framework'),
				'fields' => array(
					array(
						'id'=>'envato-username',
						'type' => 'text',
						'title' => __('Envato Username', 'luxe_framework'),
						'subtitle' => __('', 'luxe_framework'),
						'desc' => __('', 'luxe_framework'),
						'default' => ''
						),	
					array(
						'id'=>'envato-apikey',
						'type' => 'text',
						'title' => __('Envato API Key', 'luxe_framework'),
						'subtitle' => __('Enter your Envato API key for verification', 'luxe_framework'),
						'desc' => __('For instructions on obtaining your API key <a href="http://themeluxe.com/images/api_key_2013_800.png">click here</a>', 'luxe_framework'),
						'default' => ''
						),	
					array(
						'id'=>'raw_new_info',
						'type' => 'raw',
						'content' => $item_info,
						)
					),   
				);


		}	

		public function setHelpTabs() {

			// Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
			$this->args['help_tabs'][] = array(
			    'id' => 'redux-opts-1',
			    'title' => __('Theme Information 1', 'luxe_framework'),
			    'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'luxe_framework')
			);

			$this->args['help_tabs'][] = array(
			    'id' => 'redux-opts-2',
			    'title' => __('Theme Information 2', 'luxe_framework'),
			    'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'luxe_framework')
			);

			// Set the help sidebar
			$this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'luxe_framework');

		}


		/**
			
			All the possible arguments for Redux.
			For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

		 **/
		public function setArguments() {
			
			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$this->args = array(
	            
	            // TYPICAL -> Change these values as you need/desire
				'opt_name'          	=> 'luxe_options', // This is where your data is stored in the database and also becomes your global variable name.
				'display_name'			=> $theme->get('Name'), // Name that appears at the top of your panel
				'display_version'		=> $theme->get('Version'), // Version that appears at the top of your panel
				'menu_type'          	=> 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'     	=> true, // Show the sections below the admin menu item or not
				'menu_title'			=> __( 'Theme Options', 'luxe_framework' ),
	            'page'		 	 		=> __( 'Theme Options', 'luxe_framework' ),
	            'google_api_key'   	 	=> 'AIzaSyB_rAxul-PBGJzKWkcOBbB8kj7p5USacRs', // Must be defined to add google fonts to the typography module
	            'global_variable'    	=> '', // Set a different name for your global variable other than the opt_name
	            'dev_mode'           	=> false, // Show the time the page took to load, etc
	            'customizer'         	=> true, // Enable basic customizer support

	            // OPTIONAL -> Give you extra features
	            'page_priority'      	=> null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	            'page_parent'        	=> 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	            'page_permissions'   	=> 'manage_options', // Permissions needed to access the options panel.
	            'menu_icon'          	=> '', // Specify a custom URL to an icon
	            'last_tab'           	=> '', // Force your panel to always open to a specific tab (by id)
	            'page_icon'          	=> 'icon-themes', // Icon displayed in the admin panel next to your menu_title
	            'page_slug'          	=> '_options', // Page slug used to denote the panel
	            'save_defaults'      	=> true, // On load save the defaults to DB before user clicks save or not
	            'default_show'       	=> false, // If true, shows the default value next to each field that is not the default value.
	            'default_mark'       	=> '', // What to print by the field's title if the value shown is default. Suggested: *


	            // CAREFUL -> These options are for advanced use only
	            'transient_time' 	 	=> 60 * MINUTE_IN_SECONDS,
	            'output'            	=> true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	            'output_tag'            	=> true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	            //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
	            //'footer_credit'      	=> '', // Disable the footer credit of Redux. Please leave if you can help it.
	            

	            // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	            'database'           	=> '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	            
	        
	            'show_import_export' 	=> true, // REMOVE
	            'system_info'        	=> false, // REMOVE
	            
	            'help_tabs'          	=> array(),
	            'help_sidebar'       	=> '', // __( '', $this->args['domain'] );            
				);


			// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.		
			$this->args['share_icons'][] = array(
			    'url' => 'https://themeluxe.com/support',
			    'title' => 'Visit our Support Forum', 
			    'icon' => 'el-icon-group'
			    // 'img' => '', // You can use icon OR img. IMG needs to be a full URL.
			);		
			$this->args['share_icons'][] = array(
			    'url' => 'http://themeforest.net/user/ThemeLuxe/follow',
			    'title' => 'Follow us on ThemeForest', 
			    'icon' => 'el-icon-wordpress'
			);
			$this->args['share_icons'][] = array(
			    'url' => 'https://twitter.com/ThemeLuxe',
			    'title' => 'Follow us on Twitter', 
			    'icon' => 'el-icon-twitter'
			);

			
	 
			// Panel Intro text -> before the form
			if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false ) {
				if (!empty($this->args['global_variable'])) {
					$v = $this->args['global_variable'];
				} else {
					$v = str_replace("-", "_", $this->args['opt_name']);
				}
				$this->args['intro_text'] = sprintf( __('', 'luxe_framework' ), $v );
			} else {
				$this->args['intro_text'] = __('', 'luxe_framework');
			}

			// Add content after the form.
			//$this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'luxe_framework');

		}
	}
	new Luxe_Options();

}


/** 

	Responsive CSS

 */
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

function rgb2hex($rgb) {
	$rgb = str_replace(array('rgba(', ')', ' '), '', $rgb);
	$arr = explode(',', $rgb);
	$hex = "#";
	$hex .= str_pad(dechex($arr[0]), 2, "0", STR_PAD_LEFT);
	$hex .= str_pad(dechex($arr[1]), 2, "0", STR_PAD_LEFT);
	$hex .= str_pad(dechex($arr[2]), 2, "0", STR_PAD_LEFT);

   return $hex; // returns the hex value including the number sign (#)
}

function luxe_responsive_css() {

	global $luxe_options;
	$accent = $luxe_options['accent'];
	$accent_rgb = hex2rgb($accent);
	$button_background = $luxe_options['button-background-color']['regular'];
	$button_background_hover = $luxe_options['button-background-color']['hover'];
	$alt_button_background = $luxe_options['alternate-button-background-color']['regular'];
	$alt_button_background_hover = $luxe_options['alternate-button-background-color']['hover'];
	$alt_button_text_color_hover = $luxe_options['alternate-button-text-color']['hover'];
	$header_height = $luxe_options['header-height']['height'];
	$header_scrolled_height = $luxe_options['header-scrolled-height']['height'];
	$heading_font_color = $luxe_options['heading-font']['color'];
	$header_background_color = $luxe_options['header-background-color']['color'];

	?>
	<style type="text/css" class="options-output-responsive">
	<?php if($luxe_options['preloader'] == 1) : ?>
	body { overflow: hidden; }
	<?php endif; ?>
	i { color: <?php echo $heading_font_color; ?>; }
	.sticky .post-main { border-bottom: 3px solid <?php echo $accent; ?>; }
	.luxe-page-navigation li:hover { border-color:<?php echo $accent; ?>; }
	.tagcloud a:hover { background-color:<?php echo $accent; ?>; }
	.tags:before { color: <?php echo $heading_font_color; ?>; }
	.luxe-post .video-button:hover { background-color: <?php echo $accent; ?>; color: #fff; }
	.portfolio-container .isotope .portfolio-overlay { background-color: rgba(<?php echo $accent_rgb[0].', '.$accent_rgb[1].', '.$accent_rgb[2]; ?>, 0.9); }
	.port_ajax_icons .prev-port-link:hover, .port_ajax_icons .next-port-link:hover, .port_ajax_icons .close-port-link:hover { background-color: <?php echo $accent; ?>; }
    .team-member .team-overlay { background-color: rgba(<?php echo $accent_rgb[0].', '.$accent_rgb[1].', '.$accent_rgb[2]; ?>, 0.9); }
    .team-member { border-color: <?php echo $accent; ?>; }
    .toggles-container .trigger.active a:before, .toggles-container .trigger a:hover { color: <?php echo $accent; ?>; }
	.button, .button.inverse:hover, input[type='submit'] { border-color: <?php echo $button_background; ?>; }
	.button:hover, .button.inverse, input[type='submit']:hover { border-color: <?php echo $button_background_hover; ?>; }
	.button.alt { border-color:<?php echo $alt_button_background; ?>; }
	.button.alt:hover .button-text { color:<?php echo $alt_button_text_color_hover; ?> !important; }
	.button.alt:hover { border-color:<?php echo $alt_button_background_hover; ?>; background-color:<?php echo $alt_button_background_hover; ?>;}
	.widget_wysija .wysija-submit { border-color: <?php echo $button_background_hover; ?> !important; color:<?php echo $button_background_hover; ?> !important;}
	.widget_wysija .wysija-submit:hover { border-color: #343434 !important; color:#343434 !important;}
	.social .socialbar .social-icons li a:hover { color: <?php echo $accent; ?> !important; }
	.luxe-post, .luxe-post.style2, .feature, .entry-content blockquote { border-color: <?php echo $accent; ?>; }
	#scroll-top {  background-color: <?php echo $accent; ?>; }

	.error404 #content { background-color: <?php echo $accent; ?>; }
	.luxe-post, .luxe-post.style2, .feature, .feature-style3, .pricing-box, { border-color: <?php echo $accent; ?>; }
	.pricing-box .pricing-header { background-color: <?php echo $accent; ?>; }
	.blog .post .article-footer, .archive .post .article-footer { border-color: <?php echo $accent; ?>; }
	blockquote { border-color: <?php echo $accent; ?>; }
	.luxe-page-navigation li.luxe-current:hover, .luxe-page-navigation li.luxe-current:hover span, .luxe-page-navigation li:hover a  { border-color: <?php echo $accent; ?>; color:<?php echo $accent; ?>; }
	.trigger.active a:before { color: <?php echo $accent; ?>; }

	@media only screen and (min-width: 768px) {
    	header[role='banner'] { height: <?php echo $header_height; ?>; }
    	header[role='banner'] .nav li { line-height: <?php echo $header_height; ?>; }
    	header[role='banner'] #logo { max-height: <?php echo $header_height; ?>; }
    	header[role='banner'].scrolled { height: <?php echo $header_scrolled_height; ?>; }
    	header[role='banner'].scrolled .nav li { line-height: <?php echo $header_scrolled_height; ?>; }
    	header[role='banner'].scrolled #logo img { max-height: <?php echo $header_scrolled_height; ?>; }
    	#content { margin-top: <?php echo $header_height; ?>; }
    }
	<?php if($luxe_options['header-shadow']): ?>
	header[role='banner']:before {
		display: block;
		position: absolute;
		content: "";
		width: 50%;
		height: 100%;
		right: 0;
		background-color: rgba(0,0,0,0.02);
		z-index: 0;
	}
	<?php endif; ?>

	/*********************
	IE STYLING
	*********************/  
	.lt-ie9 header[role='banner'] {
		background-color: <?php echo $header_background_color; ?>
	}
	.lt-ie9 header[role='banner'] .nav li a{
		line-height: <?php echo $header_height; ?>;
	}
	.lt-ie9 header[role='banner'].scrolled .nav li a{
		line-height: <?php echo $header_scrolled_height; ?>;
	}
	.lt-ie9 header[role='banner'] #logo img{
		max-height: <?php echo $header_height; ?>;
	}
	.lt-ie9 header[role='banner'].scrolled #logo img{
		max-height: <?php echo $header_scrolled_height; ?>;
	}
	.lt-ie9 #content {
		margin-top:<?php echo $header_height; ?>;
	}

	/*********************
	MOBILE HEADER SETTINGS
	*********************/  

	@media all and (max-width: 768px) {
		header[role='banner'] {
		    position: fixed;
		    top:0px;
		    height:<?php echo $header_scrolled_height; ?>;
		    width: 100%;
		}
		header[role='banner'] #top-logo { display: none !important; }
		header[role='banner'] #logo { display: block !important; }
		header[role='banner'] .nav li { line-height: <?php echo $header_scrolled_height; ?>; }
		header[role='banner'] #logo img{
		    max-height: <?php echo $header_scrolled_height; ?>; 
		}
		#main-nav-wrapper {
			background-color: <?php echo $header_background_color; ?>;
		    position: absolute;
		    display: none;
		    border: 0px;
		    padding: 0px 40px 10px 40px;
		    top: 100%;
		    right: 0px;
		    width: auto;
		    max-width: 100%;
		    width:100%;
		    margin-right: 0px;
		    margin-left:0px;
		    margin-top:0px;
		    text-align: left;
		    height: 350px;
		    overflow: hidden;
		}
		#main-nav {
			overflow-y: scroll;
			height: 320px;
		}
		<?php if($luxe_options['header-shadow']): ?>
		#main-nav:before {
			display: block;
			position: absolute;
			content: "";
			width: 50%;
			height: 100%;
			right: 0;
			top:0px;
			background-color: rgba(0,0,0,0.02);
			z-index: 0;
		}
		<?php endif; ?>
		#main-nav li {
			padding: 4px 10px;
		}
		#main-nav li:first-child {
			padding-top:10px;
		}
		#main-nav li a {
			line-height: 1em;
			border:0px;
		}
		#main-nav li ul.children li a{
			padding:0; padding-left:20px;
			padding-top: 5px;
			padding-bottom: 5px;
		}
		#content {
			margin-top: <?php echo $header_scrolled_height; ?>;
		}
	}
	</style>

	<?php 
}

add_action( 'wp_head', 'luxe_responsive_css', 151);

/** 

	Custom User CSS

 */
function luxe_custom_css() {

	global $luxe_options;

	$css = $luxe_options['custom-css'];

	$output = '<style type="text/css" class="options-output-custom-css">'.$css.'</style>';
	echo $output;
}

add_action( 'wp_head', 'luxe_custom_css', 152);

/** 

	Custom User JS

 */
function luxe_custom_user_js() {

	global $luxe_options;

	$js = $luxe_options['custom-js'];

	$output = '<script type="text/javascript">'.$js.'</script>';
	echo $output;
}

add_action( 'wp_footer', 'luxe_custom_user_js', 100);

/** 

	Meta Box Javascript

 */
function luxe_custom_js() {

	global $luxe_options;
	$header_scrolled_distance = str_replace('px', '', $luxe_options['header-scrolled-distance']['height']);
	$header_scrolled_height = str_replace('px', '', $luxe_options['header-scrolled-height']['height']);
	$header_height = str_replace('px', '', $luxe_options['header-height']['height']);
	$page_scrolling_speed = $luxe_options['page-scrolling-speed'];
	$page_scrolling_easing = $luxe_options['page-scrolling-easing'];
	?>
	<script type="text/javascript">
	/*-----------------------------------------------------------------------------------

	 	ScrollTo
	 
	-----------------------------------------------------------------------------------*/
	(function($) {
	  "use strict";
	  jQuery(document).ready(function($) {

	  		jQuery('a.scroll-link').click(function (e) {             
		        e.preventDefault();
		  		jQuery.scrollTo.window().queue([]).stop(); // Prevent scroll queue from building up
		        var dataSlide = $(this).attr('data-slide');
		        var dataName = $('div[data-name='+dataSlide+']');
		        if (typeof dataSlide !== 'undefined' && dataSlide !== false && dataName.length > 0 && <?php echo $luxe_options['header-resize'] == 1; ?>){
		            if(dataName.offset().top > <?php echo $header_scrolled_distance; ?>) {
		                var offsetHeight = 0 - <?php echo $header_scrolled_height; ?>;
		            }
		            else {
		                var offsetHeight = 0 - <?php echo $header_height; ?>;
		            }
		            <?php if (is_admin_bar_showing()) { ?>offsetHeight = offsetHeight - 32;<?php } ?>
		            jQuery(window).scrollTo(dataName, {duration:<?php echo $page_scrolling_speed; ?>, easing:'<?php echo $page_scrolling_easing; ?>', offset:offsetHeight, axis:'y' }, {queue:false});
		        }
		        else {
		            document.location.href= $(this).attr('data-parent') + '?slide=' + dataSlide;
		        }
	      	});

			//scroll to top function
	  		jQuery('#scroll-top').click(function (e) {             
		        e.preventDefault();
		  		jQuery.scrollTo.window().queue([]).stop(); // Prevent scroll queue from building up
		        var dataName = $('html');  
		        jQuery(window).scrollTo(dataName, {duration:<?php echo $page_scrolling_speed; ?>, easing:'<?php echo $page_scrolling_easing; ?>', axis:'y' }, {queue:false});
	      	});
		    jQuery(window).scroll(function($) {    
		       var scroll = jQuery(window).scrollTop();
		       if (scroll >= <?php echo $header_scrolled_distance; ?>) {
		           jQuery("#scroll-top").addClass("visible");
		       }
		       else {
		           jQuery("#scroll-top").removeClass("visible");
		       }
		   	});
	                        
	  });
	})(jQuery);

	/*-----------------------------------------------------------------------------------

	 	Header Options
	 
	-----------------------------------------------------------------------------------*/

	(function($) {
	  "use strict";
	    jQuery(window).scroll(function($) {    
	       var scroll = jQuery(window).scrollTop();
	       if (scroll >= <?php echo $header_scrolled_distance; ?>) {
	           jQuery("header[role='banner']").addClass("scrolled animated");
	       }
	       else {
	           jQuery("header[role='banner']").removeClass("scrolled animated");
	       }
	   	});
	})(jQuery);

	/*-----------------------------------------------------------------------------------

	  ScrollTo Slide GET
	 
	-----------------------------------------------------------------------------------*/
	<?php if(isset($_GET["slide"])): ?> 
	(function($) {
	  "use strict";

	  jQuery(window).load(function($) { 

	    function getSlide() {     

	        jQuery.scrollTo.window().queue([]).stop(); // Prevent scroll queue from building up
	        var dataSlide = '<?php echo sanitize_title($_GET["slide"]); ?>';
	        var dataName = jQuery('div[data-name='+dataSlide+']');
	        if (typeof dataSlide !== 'undefined' && dataSlide !== false && dataName.length > 0){
	            if(dataName.offset().top > <?php echo $header_scrolled_distance; ?>) {
	                var offsetHeight = 0 - <?php echo $header_scrolled_height; ?>;
	            }
	            else {
	                var offsetHeight = 0 - <?php echo $header_height; ?>;
	            }
	            var header = jQuery('#header-wrapper');
	            if (header.css('position') != 'fixed' || header.css('display') == 'none') { offsetHeight = 0; };      
	        
	            jQuery(window).scrollTo(dataName, {duration:<?php echo $page_scrolling_speed; ?>, easing:'<?php echo $page_scrolling_easing ?>', offset:offsetHeight, axis:'y' }, {queue:false});
	        }
	   }

	   setTimeout(getSlide, 1000)
	                   
	  });
	})(jQuery);
	<?php endif; ?>

	/*-----------------------------------------------------------------------------------

	    Preloader (keep at bottom)
	 
	-----------------------------------------------------------------------------------*/ 
	<?php if($luxe_options['preloader'] == 1) : ?>
	(function($) {
	    "use strict";

	        $(window).load(function() { // makes sure the whole site is loaded
	            $('#status').fadeOut(); // will first fade out the loading animation
	            $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
	            $('body').delay(350).css({'overflow':'visible'});
	        })


	})(jQuery);
	<?php endif; ?>

	</script>

	<?php
}

add_action( 'wp_footer', 'luxe_custom_js', 100);
