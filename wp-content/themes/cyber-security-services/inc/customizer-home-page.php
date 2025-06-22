<?php
/**
 * Cyber Security Services: Customizer-home-page
 *
 * @subpackage Cyber Security Services
 * @since 1.0
 */

	//  Home Page Panel
	$wp_customize->add_panel( 'cyber_security_services_custompage_panel', array(
		'title' => esc_html__( 'Custom Page Settings', 'cyber-security-services' ),
		'priority' => 2,
	));
	// Social Media
    $wp_customize->add_section('cyber_security_services_urls',array(
        'title' => __('Social Media', 'cyber-security-services'),
        'priority' => 3,
        'panel' => 'cyber_security_services_custompage_panel',
    ) );
    $wp_customize->add_setting( 'cyber_security_services_section_social_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_social_heading', array(
		'label'       => esc_html__( 'Social Media Settings', 'cyber-security-services' ),
		'description' => __( 'Add social media links in the below feilds', 'cyber-security-services' ),			
		'section'     => 'cyber_security_services_urls',
		'settings'    => 'cyber_security_services_section_social_heading',
	) ) );
	$wp_customize->add_setting(
		'header_social_icon_enable',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new  Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'header_social_icon_enable',
			array(
				'settings'        => 'header_social_icon_enable',
				'section'         => 'cyber_security_services_urls',
				'label'           => __( 'Check to show social fields', 'cyber-security-services' ),
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'header_social_icon_enable', array(
		'selector' => '.links a i',
		'render_callback' => 'cyber_security_services_customize_partial_header_social_icon_enable',
	) );
	$wp_customize->add_setting( 'cyber_security_services_section_fb_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_fb_heading', array(
		'label'       => esc_html__( 'Facebook Settings', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_urls',
		'settings'    => 'cyber_security_services_section_fb_heading',
	) ) );
    $wp_customize->add_setting('cyber_security_services_facebook_icon',array(
		'default'	=> 'fab fa-facebook',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Cyber_Security_Services_Fontawesome_Icon_Chooser(
        $wp_customize,'cyber_security_services_facebook_icon',array(
		'label'	=> __('Add Icon','cyber-security-services'),
		'transport' => 'refresh',
		'section'	=> 'cyber_security_services_urls',
		'setting'	=> 'cyber_security_services_facebook_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('cyber_security_services_facebook',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('cyber_security_services_facebook',array(
		'label' => esc_html__('Add URL','cyber-security-services'),
		'section' => 'cyber_security_services_urls',
		'setting' => 'cyber_security_services_facebook',
		'type'    => 'url'
	));
	$wp_customize->add_setting(
		'cyber_security_services_header_facebook_target',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_header_facebook_target',
			array(
				'settings'        => 'cyber_security_services_header_facebook_target',
				'section'         => 'cyber_security_services_urls',
				'label'           => __( 'Open link in a new tab', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'cyber_security_services_section_twitter_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_twitter_heading', array(
		'label'       => esc_html__( 'Twitter Settings', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_urls',
		'settings'    => 'cyber_security_services_section_twitter_heading',
	) ) );
	$wp_customize->add_setting('cyber_security_services_twitter_icon',array(
		'default'	=> 'fab fa-x-twitter',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Cyber_Security_Services_Fontawesome_Icon_Chooser(
        $wp_customize,'cyber_security_services_twitter_icon',array(
		'label'	=> __('Add Icon','cyber-security-services'),
		'transport' => 'refresh',
		'section'	=> 'cyber_security_services_urls',
		'setting'	=> 'cyber_security_services_twitter_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->selective_refresh->add_partial( 'cyber_security_services_twitter', array(
		'selector' => '.social-icon a i',
		'render_callback' => 'cyber_security_services_customize_partial_cyber_security_services_twitter',
	) );
	$wp_customize->add_setting('cyber_security_services_twitter',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('cyber_security_services_twitter',array(
		'label' => esc_html__('Add URL','cyber-security-services'),
		'section' => 'cyber_security_services_urls',
		'setting' => 'cyber_security_services_twitter',
		'type'    => 'url'
	));
	$wp_customize->add_setting(
		'cyber_security_services_header_twt_target',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_header_twt_target',
			array(
				'settings'        => 'cyber_security_services_header_twt_target',
				'section'         => 'cyber_security_services_urls',
				'label'           => __( 'Open link in a new tab', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'cyber_security_services_section_linkedin_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_linkedin_heading', array(
		'label'       => esc_html__( 'Linkedin Settings', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_urls',
		'settings'    => 'cyber_security_services_section_linkedin_heading',
	) ) );
	$wp_customize->add_setting('cyber_security_services_linkedin_icon',array(
		'default'	=> 'fab fa-linkedin',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Cyber_Security_Services_Fontawesome_Icon_Chooser(
        $wp_customize,'cyber_security_services_linkedin_icon',array(
		'label'	=> __('Add Icon','cyber-security-services'),
		'transport' => 'refresh',
		'section'	=> 'cyber_security_services_urls',
		'setting'	=> 'cyber_security_services_linkedin_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('cyber_security_services_linkedin',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('cyber_security_services_linkedin',array(
		'label' => esc_html__('Add URL','cyber-security-services'),
		'section' => 'cyber_security_services_urls',
		'setting' => 'cyber_security_services_linkedin',
		'type'    => 'url'
	));
	$wp_customize->add_setting(
		'cyber_security_services_header_linkedin_target',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_header_linkedin_target',
			array(
				'settings'        => 'cyber_security_services_header_linkedin_target',
				'section'         => 'cyber_security_services_urls',
				'label'           => __( 'Open link in a new tab', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'cyber_security_services_section_pinterest_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_pinterest_heading', array(
		'label'       => esc_html__( 'Pinterest Settings', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_urls',
		'settings'    => 'cyber_security_services_section_pinterest_heading',
	) ) );
	$wp_customize->add_setting('cyber_security_services_pinterest_icon',array(
		'default'	=> 'fab fa-pinterest-p',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Cyber_Security_Services_Fontawesome_Icon_Chooser(
        $wp_customize,'cyber_security_services_pinterest_icon',array(
		'label'	=> __('Add Icon','cyber-security-services'),
		'transport' => 'refresh',
		'section'	=> 'cyber_security_services_urls',
		'setting'	=> 'cyber_security_services_pinterest_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('cyber_security_services_pinterest',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('cyber_security_services_pinterest',array(
		'label' => esc_html__('Add URL','cyber-security-services'),
		'section' => 'cyber_security_services_urls',
		'setting' => 'cyber_security_services_pinterest',
		'type'    => 'url'
	));
	$wp_customize->add_setting(
		'cyber_security_services_header_pinterest_target',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_header_pinterest_target',
			array(
				'settings'        => 'cyber_security_services_header_pinterest_target',
				'section'         => 'cyber_security_services_urls',
				'label'           => __( 'Open link in a new tab', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);

    //Slider
	$wp_customize->add_section( 'cyber_security_services_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'cyber-security-services' ),
    	'priority'   => 3,
    	'panel' => 'cyber_security_services_custompage_panel',
	) );
	$wp_customize->add_setting( 'cyber_security_services_section_slide_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_slide_heading', array(
		'label'       => esc_html__( 'Slider Settings', 'cyber-security-services' ),
		'description' => __( 'Slider Image Dimension ( 600px x 700px )', 'cyber-security-services' ),		
		'section'     => 'cyber_security_services_slider_section',
		'settings'    => 'cyber_security_services_section_slide_heading',
		'priority'       => 1,
	) ) );
	$wp_customize->add_setting('cyber_security_services_slide_heading',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('cyber_security_services_slide_heading',array(
		'label' => esc_html__('Slider Text','cyber-security-services'),
		'section' => 'cyber_security_services_slider_section',
		'setting' => 'cyber_security_services_slide_heading',
		'type'    => 'text',
		'priority'       => 1,
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= 'select';
	foreach($categories as $category){
	if($i==0){
	  $default = $category->slug;
	  $i++;
	}
	$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('cyber_security_services_post_setting',array(
		'default' => 'select',
		'sanitize_callback' => 'cyber_security_services_sanitize_select',
	));
	$wp_customize->add_control('cyber_security_services_post_setting',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => esc_html__('Select Category to display slider images','cyber-security-services'),
		'section' => 'cyber_security_services_slider_section',
		'priority'       => 1,
		
	));

	$wp_customize->add_setting('cyber_security_services_slider_count',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('cyber_security_services_slider_count',array(
		'label'	=> esc_html__('Slider Count','cyber-security-services'),
		'section'	=> 'cyber_security_services_slider_section',
		'type'		=> 'number',
		'priority'       => 1,
	));

	$wp_customize->add_setting('cyber_security_services_slider_heading_color', array(
	    'default' => '#ffffff',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cyber_security_services_slider_heading_color', array(
	    'section' => 'cyber_security_services_slider_section',
	    'label' => esc_html__('Slider Title Color', 'cyber-security-services'),
	 	'priority'    => 2,
	)));

	$wp_customize->add_setting(
		'cyber_security_services_slider_excerpt_show_hide',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_slider_excerpt_show_hide',
			array(
				'settings'        => 'cyber_security_services_slider_excerpt_show_hide',
				'section'         => 'cyber_security_services_slider_section',
				'label'           => __( 'Show Hide excerpt', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
				'priority'       => 3,
			)
		)
	);
	$wp_customize->add_setting('cyber_security_services_slider_excerpt_count',array(
		'default'=> 30,
		'transport' => 'refresh',
		'sanitize_callback' => 'cyber_security_services_sanitize_integer'
	));
	$wp_customize->add_control(new Cyber_Security_Services_Slider_Custom_Control( $wp_customize, 'cyber_security_services_slider_excerpt_count',array(
		'label' => esc_html__( 'Excerpt Limit','cyber-security-services' ),
		'section'=> 'cyber_security_services_slider_section',
		'settings'=>'cyber_security_services_slider_excerpt_count',
		'input_attrs' => array(
			'reset'			   => 30,
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
        'priority'       => 3,
	)));
	$wp_customize->add_setting('cyber_security_services_slider_excerpt_color', array(
	    'default' => '#a1b0d1',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cyber_security_services_slider_excerpt_color', array(
	    'section' => 'cyber_security_services_slider_section',
	    'label' => esc_html__('Slider Excerpt Color', 'cyber-security-services'),
	 	'priority'    => 4,
	)));
	$wp_customize->add_setting(
		'cyber_security_services_slider_button_show_hide',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_slider_button_show_hide',
			array(
				'settings'        => 'cyber_security_services_slider_button_show_hide',
				'section'         => 'cyber_security_services_slider_section',
				'label'           => __( 'Show Hide Button', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
				'priority'       => 5,
			)
		)
	);
	$wp_customize->add_setting('cyber_security_services_slider_read_more',array(
		'default' => 'Get Start Now',
		'sanitize_callback' => 'sanitize_text_field'
	)); 
	$wp_customize->add_control('cyber_security_services_slider_read_more',array(
		'label' => esc_html__('Button Text','cyber-security-services'),
		'section' => 'cyber_security_services_slider_section',
		'setting' => 'cyber_security_services_slider_read_more',
		'type'    => 'text',
		'priority'       => 5,
	));

	$wp_customize->add_setting('cyber_security_services_slider_content_alignment',array(
        'default' => 'LEFT-ALIGN',
        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
	));
	$wp_customize->add_control('cyber_security_services_slider_content_alignment',array(
		'type' => 'radio',
		'label'     => __('Slider Content Alignment', 'cyber-security-services'),
		'section' => 'cyber_security_services_slider_section',
		'type' => 'select',
		'choices' => array(
			'LEFT-ALIGN' => __('LEFT','cyber-security-services'),
            'CENTER-ALIGN' => __('CENTER','cyber-security-services'),
            'RIGHT-ALIGN' => __('RIGHT','cyber-security-services'),
		),
		'priority'   => 6,
	) );

	$wp_customize->add_setting('cyber_security_services_slider_overlay', array(
	    'default' => '#222222',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cyber_security_services_slider_overlay', array(
	    'section' => 'cyber_security_services_slider_section',
	    'label' => esc_html__('Slider Overlay Color', 'cyber-security-services'),
	 	'priority'    => 7,
	)));

	$wp_customize->add_setting('cyber_security_services_slider_opacity',array(
        'default' => '0.5',
        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
	));
	$wp_customize->add_control('cyber_security_services_slider_opacity',array(
		'type' => 'radio',
		'label'     => __('Slider Opacity', 'cyber-security-services'),
		'section' => 'cyber_security_services_slider_section',
		'type' => 'select',
		'choices' => array(
			'0' => __('0','cyber-security-services'),
			'0.1' => __('0.1','cyber-security-services'),
			'0.2' => __('0.2','cyber-security-services'),
			'0.3' => __('0.3','cyber-security-services'),
			'0.4' => __('0.4','cyber-security-services'),
			'0.5' => __('0.5','cyber-security-services'),
			'0.6' => __('0.6','cyber-security-services'),
			'0.7' => __('0.7','cyber-security-services'),
			'0.8' => __('0.8','cyber-security-services'),
			'0.9' => __('0.9','cyber-security-services'),
			'1' => __('1','cyber-security-services')
		),
	) );

	// About Section
	$wp_customize->add_section( 'cyber_security_services_services_section' , array(
    	'title'      => __( 'About Us Section Settings', 'cyber-security-services' ),
		'priority'   => 4,
		'panel' => 'cyber_security_services_custompage_panel',
	) );
	$wp_customize->add_setting( 'cyber_security_services_section_about_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_about_heading', array(
		'label'       => esc_html__( 'About Us Section Settings', 'cyber-security-services' ),	
		'section'     => 'cyber_security_services_services_section',
		'settings'    => 'cyber_security_services_section_about_heading',
	) ) );
	$wp_customize->add_setting(
		'cyber_security_services_about_show_hide',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_about_show_hide',
			array(
				'settings'        => 'cyber_security_services_about_show_hide',
				'section'         => 'cyber_security_services_services_section',
				'label'           => __( 'Check To Show Section', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
    $wp_customize->add_setting( 'cyber_security_services_about_images', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cyber_security_services_about_images', array(
        'label' => 'Upload Image',
        'section' => 'cyber_security_services_services_section',
        'settings' => 'cyber_security_services_about_images',
        'button_labels' => array(
            'select' => 'Select Image',
            'remove' => 'Remove Image',
            'change' => 'Change Image',
        )
    )));
    $wp_customize->add_setting( 'cyber_security_services_about_images1', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cyber_security_services_about_images1', array(
        'label' => 'Upload Image',
        'section' => 'cyber_security_services_services_section',
        'settings' => 'cyber_security_services_about_images1',
        'button_labels' => array(
            'select' => 'Select Image',
            'remove' => 'Remove Image',
            'change' => 'Change Image',
        )
    )));
    $wp_customize->add_setting( 'cyber_security_services_about_images2', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cyber_security_services_about_images2', array(
        'label' => 'Upload Image',
        'section' => 'cyber_security_services_services_section',
        'settings' => 'cyber_security_services_about_images2',
        'button_labels' => array(
            'select' => 'Select Image',
            'remove' => 'Remove Image',
            'change' => 'Change Image',
        )
    )));
    $wp_customize->add_setting('cyber_security_services_services_heading',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('cyber_security_services_services_heading',array(
		'label'	=> esc_html__('Add Heading','cyber-security-services'),
		'section'	=> 'cyber_security_services_services_section',
		'type'		=> 'text'
	));
	$wp_customize->add_setting('cyber_security_services_about_us_settigs',array(
		'sanitize_callback' => 'cyber_security_services_sanitize_dropdown_pages',
	));
	$wp_customize->add_control('cyber_security_services_about_us_settigs',array(
		'type'    => 'dropdown-pages',
		'label' => __('Select Page','cyber-security-services'),
		'section' => 'cyber_security_services_services_section',
	));

	//Footer
    $wp_customize->add_section( 'cyber_security_services_footer_copyright', array(
    	'title' => esc_html__( 'Footer Text', 'cyber-security-services' ),
    	'priority' => 6,
    	'panel' => 'cyber_security_services_custompage_panel',
	) );
	$wp_customize->add_setting( 'cyber_security_services_section_footer_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_footer_heading', array(
		'label'       => esc_html__( 'Footer Settings', 'cyber-security-services' ),		
		'section'     => 'cyber_security_services_footer_copyright',
		'settings'    => 'cyber_security_services_section_footer_heading',
		'priority'    => 1,
	) ) );
    $wp_customize->add_setting('cyber_security_services_footer_text',array(
			'default'	=> 'Cyber Security WordPress Theme',
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('cyber_security_services_footer_text',array(
			'label'	=> esc_html__('Copyright Text','cyber-security-services'),
			'section'	=> 'cyber_security_services_footer_copyright',
			'type'		=> 'textarea'
	));
	$wp_customize->add_setting('cyber_security_services_footer_content_alignment',array(
        'default' => 'CENTER-ALIGN',
        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
	));
	$wp_customize->add_control('cyber_security_services_footer_content_alignment',array(
		'type' => 'radio',
		'label'     => __('Footer Content Alignment', 'cyber-security-services'),
		'section' => 'cyber_security_services_footer_copyright',
		'type' => 'select',
		'choices' => array(
			'LEFT-ALIGN' => __('LEFT','cyber-security-services'),
            'CENTER-ALIGN' => __('CENTER','cyber-security-services'),
            'RIGHT-ALIGN' => __('RIGHT','cyber-security-services'),
		),
	) );

	$wp_customize->add_setting(
		'cyber_security_services_footer_widgets_show_hide',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_footer_widgets_show_hide',
			array(
				'settings'        => 'cyber_security_services_footer_widgets_show_hide',
				'section'         => 'cyber_security_services_footer_copyright',
				'label'           => __( 'Check To show Footer Widgets', 'cyber-security-services' ),
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting('cyber_security_services_footer_widget',array(
        'default' => '4',
        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
	));
	$wp_customize->add_control('cyber_security_services_footer_widget',array(
		'type' => 'radio',
		'label'     => __('Footer Per Column', 'cyber-security-services'),
		'section' => 'cyber_security_services_footer_copyright',
		'type' => 'select',
		'choices' => array(
			'1' => __('1','cyber-security-services'),
            '2' => __('2','cyber-security-services'),
            '3' => __('3','cyber-security-services'),
            '4' => __('4','cyber-security-services'),
		)
	) );
