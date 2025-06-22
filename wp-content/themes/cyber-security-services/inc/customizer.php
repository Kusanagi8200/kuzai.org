<?php
/**
 * Cyber Security Services: Customizer
 *
 * @subpackage Cyber Security Services
 * @since 1.0
 */

function cyber_security_services_customize_register( $wp_customize ) {

	wp_enqueue_style('customizercustom_css', esc_url( get_template_directory_uri() ). '/assets/css/customizer.css');

	// fontawesome icon-picker

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	// Add custom control.
  	require get_parent_theme_file_path( 'inc/switch/control_switch.php' );

  	require get_parent_theme_file_path( 'inc/custom-control.php' );

  	//Register the sortable control type.
	$wp_customize->register_control_type( 'Cyber_Security_Services_Control_Sortable' );

  	// Add homepage customizer file
  	require get_template_directory() . '/inc/customizer-home-page.php';

  	add_action( 'customize_controls_enqueue_scripts', function() {
    	wp_enqueue_script(
	        'cyber-security-services-customizer-reset',
	        get_theme_file_uri() . '/assets/js/color-reset.js', // Ensure the JS file exists in your theme
	        array( 'customize-controls', 'jquery' ),
	        '1.0',
	        true
    	);
	} );


  	// pro section
 	$wp_customize->add_section('cyber_security_services_pro', array(
        'title'    => __('UPGRADE CYBER SECURITY PREMIUM', 'cyber-security-services'),
        'priority' => 1,
    ));
    $wp_customize->add_setting('cyber_security_services_pro', array(
        'default'           => null,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new Cyber_Security_Services_Pro_Control($wp_customize, 'cyber_security_services_pro', array(
        'label'    => __('Cyber Security Services PREMIUM', 'cyber-security-services'),
        'section'  => 'cyber_security_services_pro',
        'settings' => 'cyber_security_services_pro',
        'priority' => 1,
    )));

	//logo
	$wp_customize->add_setting('cyber_security_services_logo_max_height',array(
		'default'=> '100',
		'transport' => 'refresh',
		'sanitize_callback' => 'cyber_security_services_sanitize_integer'
	));
	$wp_customize->add_control(new Cyber_Security_Services_Slider_Custom_Control( $wp_customize, 'cyber_security_services_logo_max_height',array(
		'label'	=> esc_html__('Logo Width','cyber-security-services'),
		'section'=> 'title_tagline',
		'settings'=>'cyber_security_services_logo_max_height',
		'input_attrs' => array(
			'reset'            => 100,
            'step'             => 1,
			'min'              => 0,
			'max'              => 250,
        ),
        'priority' => 9,
	)));
	$wp_customize->add_setting('cyber_security_services_logo_title',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_logo_title',
			array(
				'settings'        => 'cyber_security_services_logo_title',
				'section'         => 'title_tagline',
				'label'           => __( 'Show Site Title', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('cyber_security_services_site_title_fontsize',array(
		'default'=> 25,
		'transport' => 'refresh',
		'sanitize_callback' => 'cyber_security_services_sanitize_integer'
	));
	$wp_customize->add_control(new Cyber_Security_Services_Slider_Custom_Control( $wp_customize, 'cyber_security_services_site_title_fontsize',array(
		'label' => esc_html__( 'Site Title font size','cyber-security-services' ),
		'section'=> 'title_tagline',
		'settings'=>'cyber_security_services_site_title_fontsize',
		'input_attrs' => array(
			'reset'			   => 25,
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
	)));
	$wp_customize->add_setting('cyber_security_services_logo_text',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_logo_text',
			array(
				'settings'        => 'cyber_security_services_logo_text',
				'section'         => 'title_tagline',
				'label'           => __( 'Show Site Tagline', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('cyber_security_services_site_tagline_fontsize',array(
		'default'=> 15,
		'transport' => 'refresh',
		'sanitize_callback' => 'cyber_security_services_sanitize_integer'
	));
	$wp_customize->add_control(new Cyber_Security_Services_Slider_Custom_Control( $wp_customize, 'cyber_security_services_site_tagline_fontsize',array(
		'label' => esc_html__( 'Site Tagline font size','cyber-security-services' ),
		'section'=> 'title_tagline',
		'settings'=>'cyber_security_services_site_tagline_fontsize',
		'input_attrs' => array(
			'reset'			   => 15,
            'step'             => 1,
			'min'              => 0,
			'max'              => 30,
        ),
	)));

	//colors
	if ( $wp_customize->get_section( 'colors' ) ) {
        $wp_customize->get_section( 'colors' )->title = __( 'Global Colors', 'cyber-security-services' );
        $wp_customize->get_section( 'colors' )->priority = 2;
    }

    $wp_customize->add_setting( 'cyber_security_services_reset_colors', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'transport'         => 'postMessage', 
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cyber_security_services_reset_colors', array(
	    'label'       => esc_html__( 'Reset Colors', 'cyber-security-services' ),
	    'section'     => 'colors',
	    'settings'    => 'cyber_security_services_reset_colors',
	    'type'        => 'button',
	    'input_attrs' => array(
	        'class' => 'button color-reset-btn',
	        'onclick' => 'resetColorsToDefault();', // Attach custom JS function
	    ),
	    'priority' => '2'
	) ) );

    $wp_customize->add_setting( 'cyber_security_services_global_color_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_global_color_heading', array(
			'label'       => esc_html__( 'Global Colors', 'cyber-security-services' ),
			'section'     => 'colors',
			'settings'    => 'cyber_security_services_global_color_heading',
			'priority'       => 1,

	) ) );

    $wp_customize->add_setting('cyber_security_services_primary_color', array(
	    'default' => '#0fa6c0',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cyber_security_services_primary_color', array(
	    'section' => 'colors',
	    'label' => esc_html__('Theme Color', 'cyber-security-services'),
	 
	)));

	$wp_customize->add_setting('cyber_security_services_secondary_color', array(
	    'default' => '#2dc8dc',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cyber_security_services_secondary_color', array(
	    'section' => 'colors',
	    'label' => esc_html__('Theme Secondary Color', 'cyber-security-services'),
	 
	)));

	$wp_customize->add_setting('cyber_security_services_heading_color', array(
	    'default' => '#222222',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cyber_security_services_heading_color', array(
	    'section' => 'colors',
	    'label' => esc_html__('Theme Heading Color', 'cyber-security-services'),
	 
	)));

	$wp_customize->add_setting('cyber_security_services_text_color', array(
	    'default' => '#63646d',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cyber_security_services_text_color', array(
	    'section' => 'colors',
	    'label' => esc_html__('Theme Text Color', 'cyber-security-services'),
	 
	)));

	$wp_customize->add_setting('cyber_security_services_primary_fade', array(
	    'default' => '#f2fafb',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cyber_security_services_primary_fade', array(
	    'section' => 'colors',
	    'label' => esc_html__('theme Color Light', 'cyber-security-services'),
	 
	)));

	$wp_customize->add_setting('cyber_security_services_footer_bg', array(
	    'default' => '#222222',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cyber_security_services_footer_bg', array(
	    'section' => 'colors',
	    'label' => esc_html__('Footer Bg color', 'cyber-security-services'),
	)));

	$wp_customize->add_setting('cyber_security_services_post_bg', array(
	    'default' => '#ffffff',
	    'sanitize_callback' => 'sanitize_hex_color',
	    'transport' => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cyber_security_services_post_bg', array(
	    'section' => 'colors',
	    'label' => esc_html__('sidebar/Blog Post Bg color', 'cyber-security-services'),
	)));

  	// typography
  	$wp_customize->add_section( 'cyber_security_services_typography_settings', array(
		'title'       => __( 'Typography Settings', 'cyber-security-services' ),
		'priority'       => 3,
	) );
	$cyber_security_services_font_choices = array(
		'' => 'Select',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);
	$wp_customize->add_setting( 'cyber_security_services_section_typo_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_typo_heading', array(
		'label'       => esc_html__( 'Typography Settings', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_typography_settings',
		'settings'    => 'cyber_security_services_section_typo_heading',
	) ) );
	$wp_customize->add_setting( 'cyber_security_services_headings_text', array(
		'sanitize_callback' => 'cyber_security_services_sanitize_fonts',
	));
	$wp_customize->add_control( 'cyber_security_services_headings_text', array(
		'type' => 'select',
		'description' => __('Select your suitable font for the headings.', 'cyber-security-services'),
		'section' => 'cyber_security_services_typography_settings',
		'choices' => $cyber_security_services_font_choices
	));
	$wp_customize->add_setting( 'cyber_security_services_body_text', array(
		'sanitize_callback' => 'cyber_security_services_sanitize_fonts'
	));
	$wp_customize->add_control( 'cyber_security_services_body_text', array(
		'type' => 'select',
		'description' => __( 'Select your suitable font for the body.', 'cyber-security-services' ),
		'section' => 'cyber_security_services_typography_settings',
		'choices' => $cyber_security_services_font_choices
	) );

	// Theme General Settings
    $wp_customize->add_section('cyber_security_services_theme_settings',array(
        'title' => __('Theme General Settings', 'cyber-security-services'),
        'priority' => 3,
    ) );
    $wp_customize->add_setting( 'cyber_security_services_section_sticky_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_sticky_heading', array(
		'label'       => esc_html__( 'Sticky Header Settings', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_theme_settings',
		'settings'    => 'cyber_security_services_section_sticky_heading',
	) ) );
    $wp_customize->add_setting(
		'cyber_security_services_sticky_header',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new cyber_security_services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_sticky_header',
			array(
				'settings'        => 'cyber_security_services_sticky_header',
				'section'         => 'cyber_security_services_theme_settings',
				'label'           => __( 'Show Sticky Header', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'cyber_security_services_section_loader_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_loader_heading', array(
		'label'       => esc_html__( 'Loader Settings', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_theme_settings',
		'settings'    => 'cyber_security_services_section_loader_heading',
	) ) );
	$wp_customize->add_setting(
		'cyber_security_services_theme_loader',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_theme_loader',
			array(
				'settings'        => 'cyber_security_services_theme_loader',
				'section'         => 'cyber_security_services_theme_settings',
				'label'           => __( 'Show Site Loader', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting('cyber_security_services_loader_style',array(
        'default' => 'style_one',
        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
	));
	$wp_customize->add_control('cyber_security_services_loader_style',array(
        'type' => 'select',
        'label' => __('Select Loader Design','cyber-security-services'),
        'section' => 'cyber_security_services_theme_settings',
        'choices' => array(
            'style_one' => __('Circle','cyber-security-services'),
            'style_two' => __('Bar','cyber-security-services'),
        ),
	) );
	
	$wp_customize->add_setting( 'cyber_security_services_section_theme_width_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_theme_width_heading', array(
		'label'       => esc_html__( 'Theme Width Setting', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_theme_settings',
		'settings'    => 'cyber_security_services_section_theme_width_heading',
	) ) );
	$wp_customize->add_setting('cyber_security_services_width_options',array(
        'default' => 'full_width',
        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
	));
	$wp_customize->add_control('cyber_security_services_width_options',array(
        'type' => 'select',
        'label' => __('Theme Width Option','cyber-security-services'),
        'section' => 'cyber_security_services_theme_settings',
        'choices' => array(
            'full_width' => __('Fullwidth','cyber-security-services'),
            'Container' => __('Container','cyber-security-services'),
            'container_fluid' => __('Container Fluid','cyber-security-services'),
        ),
	) );
	$wp_customize->add_setting( 'cyber_security_services_section_menu_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_menu_heading', array(
		'label'       => esc_html__( 'Menu Settings', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_theme_settings',
		'settings'    => 'cyber_security_services_section_menu_heading',
	) ) );
	$wp_customize->add_setting('cyber_security_services_menu_text_transform',array(
        'default' => 'UPPERCASE',
        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
	));
	$wp_customize->add_control('cyber_security_services_menu_text_transform',array(
        'type' => 'select',
        'label' => __('Menus Text Transform','cyber-security-services'),
        'section' => 'cyber_security_services_theme_settings',
        'choices' => array(
            'CAPITALISE' => __('CAPITALISE','cyber-security-services'),
            'UPPERCASE' => __('UPPERCASE','cyber-security-services'),
            'LOWERCASE' => __('LOWERCASE','cyber-security-services'),
        ),
	) );
	$wp_customize->add_setting('cyber_security_services_menu_fontsize',array(
		'default'=> 14,
		'transport' => 'refresh',
		'sanitize_callback' => 'cyber_security_services_sanitize_integer'
	));
	$wp_customize->add_control(new Cyber_Security_Services_Slider_Custom_Control( $wp_customize, 'cyber_security_services_menu_fontsize',array(
		'label' => esc_html__( 'menu font size','cyber-security-services' ),
		'section'=> 'cyber_security_services_theme_settings',
		'settings'=>'cyber_security_services_menu_fontsize',
		'input_attrs' => array(
			'reset'			   => 14,
            'step'             => 1,
			'min'              => 0,
			'max'              => 20,
        ),
	)));

	$wp_customize->add_setting( 'cyber_security_services_section_scroll_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_scroll_heading', array(
		'label'       => esc_html__( 'Scroll Top Settings', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_theme_settings',
		'settings'    => 'cyber_security_services_section_scroll_heading',
	) ) );
	$wp_customize->add_setting(
		'cyber_security_services_scroll_enable',
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
			'cyber_security_services_scroll_enable',
			array(
				'settings'        => 'cyber_security_services_scroll_enable',
				'section'         => 'cyber_security_services_theme_settings',
				'label'           => __( 'Show Scroll Top', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('cyber_security_services_scroll_options',array(
        'default' => 'right_align',
        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
	));
	$wp_customize->add_control('cyber_security_services_scroll_options',array(
		'type' => 'radio',
		'label'     => __('Scroll Top Alignment', 'cyber-security-services'),
		'section' => 'cyber_security_services_theme_settings',
		'type' => 'select',
		'choices' => array(
			'left_align' => __('LEFT','cyber-security-services'),
			'center_align' => __('CENTER','cyber-security-services'),
			'right_align' => __('RIGHT','cyber-security-services'),
		)
	) );
	$wp_customize->add_setting('cyber_security_services_scroll_top_icon',array(
		'default'	=> 'fas fa-chevron-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new  Cyber_Security_Services_Fontawesome_Icon_Chooser(
        $wp_customize,'cyber_security_services_scroll_top_icon',array(
		'label'	=> __('Add Scroll Top Icon','cyber-security-services'),
		'transport' => 'refresh',
		'section'	=> 'cyber_security_services_theme_settings',
		'setting'	=> 'cyber_security_services_scroll_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'cyber_security_services_section_cursor_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_cursor_heading', array(
		'label'       => esc_html__( 'Cursor Setting', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_theme_settings',
		'settings'    => 'cyber_security_services_section_cursor_heading',
	) ) );

	$wp_customize->add_setting(
		'cyber_security_services_enable_custom_cursor',
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
			'cyber_security_services_enable_custom_cursor',
			array(
				'settings'        => 'cyber_security_services_enable_custom_cursor',
				'section'         => 'cyber_security_services_theme_settings',
				'label'           => __( 'show custom cursor', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting( 'cyber_security_services_section_animation_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_animation_heading', array(
		'label'       => esc_html__( 'Animation Setting', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_theme_settings',
		'settings'    => 'cyber_security_services_section_animation_heading',
	) ) );

	$wp_customize->add_setting(
		'cyber_security_services_animation_enable',
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
			'cyber_security_services_animation_enable',
			array(
				'settings'        => 'cyber_security_services_animation_enable',
				'section'         => 'cyber_security_services_theme_settings',
				'label'           => __( 'show/Hide Animation', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);

	// Post Layouts
	$wp_customize->add_panel( 'cyber_security_services_post_panel', array(
		'title' => esc_html__( 'Post Layout', 'cyber-security-services' ),
		'priority' => 4,
	));

	$wp_customize->add_section('cyber_security_services_blog_meta',array(
        'title' => __('Blog Meta', 'cyber-security-services'), 
        'panel' => 'cyber_security_services_post_panel',       
    ) );

    $wp_customize->add_setting( 'cyber_security_services_section_blog_meta_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_blog_meta_heading', array(
		'label'       => esc_html__( 'Blog Meta Settings', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_blog_meta',
		'settings'    => 'cyber_security_services_section_blog_meta_heading',
	) ) );

	$wp_customize->add_setting('cyber_security_services_date',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_date',
			array(
				'settings'        => 'cyber_security_services_date',
				'section'         => 'cyber_security_services_blog_meta',
				'label'           => __( 'Show Date', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'cyber_security_services_date', array(
		'selector' => '.date-box',
		'render_callback' => 'cyber_security_services_customize_partial_cyber_security_services_date',
	) );
	$wp_customize->add_setting('cyber_security_services_date_icon',array(
		'default'	=> 'far fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Cyber_Security_Services_Fontawesome_Icon_Chooser(
        $wp_customize,'cyber_security_services_date_icon',array(
		'label'	=> __('date Icon','cyber-security-services'),
		'transport' => 'refresh',
		'section'	=> 'cyber_security_services_blog_meta',
		'setting'	=> 'cyber_security_services_date_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('cyber_security_services_date_type',array(
        'default' => 'published',
        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
	));
	$wp_customize->add_control('cyber_security_services_date_type',array(
		'type' => 'radio',
		'label'     => __('Date Format', 'cyber-security-services'),
		'section' => 'cyber_security_services_blog_meta',
		'type' => 'select',
		'choices' => array(
			'published' => __('published date','cyber-security-services'),
            'modified' => __('modified date','cyber-security-services'),
		),
	) );



	$wp_customize->add_setting('cyber_security_services_sticky_icon',array(
		'default'	=> 'fas fa-thumb-tack',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Cyber_Security_Services_Fontawesome_Icon_Chooser(
        $wp_customize,'cyber_security_services_sticky_icon',array(
		'label'	=> __('Sticky Post Icon','cyber-security-services'),
		'transport' => 'refresh',
		'section'	=> 'cyber_security_services_blog_meta',
		'setting'	=> 'cyber_security_services_sticky_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('cyber_security_services_admin',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_admin',
			array(
				'settings'        => 'cyber_security_services_admin',
				'section'         => 'cyber_security_services_blog_meta',
				'label'           => __( 'Show Author/Admin', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'cyber_security_services_admin', array(
		'selector' => '.entry-author',
		'render_callback' => 'cyber_security_services_customize_partial_cyber_security_services_admin',
	) );
	$wp_customize->add_setting('cyber_security_services_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Cyber_Security_Services_Fontawesome_Icon_Chooser(
        $wp_customize,'cyber_security_services_author_icon',array(
		'label'	=> __('Author Icon','cyber-security-services'),
		'transport' => 'refresh',
		'section'	=> 'cyber_security_services_blog_meta',
		'setting'	=> 'cyber_security_services_author_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('cyber_security_services_comment',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_comment',
			array(
				'settings'        => 'cyber_security_services_comment',
				'section'         => 'cyber_security_services_blog_meta',
				'label'           => __( 'Show Comment', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'cyber_security_services_comment', array(
		'selector' => '.entry-comments',
		'render_callback' => 'cyber_security_services_customize_partial_cyber_security_services_comment',
	) );
	$wp_customize->add_setting('cyber_security_services_comment_icon',array(
		'default'	=> 'fas fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Cyber_Security_Services_Fontawesome_Icon_Chooser(
        $wp_customize,'cyber_security_services_comment_icon',array(
		'label'	=> __('comment Icon','cyber-security-services'),
		'transport' => 'refresh',
		'section'	=> 'cyber_security_services_blog_meta',
		'setting'	=> 'cyber_security_services_comment_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('cyber_security_services_tag',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_tag',
			array(
				'settings'        => 'cyber_security_services_tag',
				'section'         => 'cyber_security_services_blog_meta',
				'label'           => __( 'Show tag count', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'cyber_security_services_tag', array(
		'selector' => '.tags',
		'render_callback' => 'cyber_security_services_customize_partial_cyber_security_services_tag',
	) );
	$wp_customize->add_setting('cyber_security_services_tag_icon',array(
		'default'	=> 'fas fa-tags',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Cyber_Security_Services_Fontawesome_Icon_Chooser(
        $wp_customize,'cyber_security_services_tag_icon',array(
		'label'	=> __('tag Icon','cyber-security-services'),
		'transport' => 'refresh',
		'section'	=> 'cyber_security_services_blog_meta',
		'setting'	=> 'cyber_security_services_tag_icon',
		'type'		=> 'icon'
	)));
    $wp_customize->add_section('cyber_security_services_layout',array(
        'title' => __('Single-Post Layout', 'cyber-security-services'),
        'panel' => 'cyber_security_services_post_panel',
    ) );
    $wp_customize->add_setting( 'cyber_security_services_section_post_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_post_heading', array(
		'label'       => esc_html__( 'Single Post Structure', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_layout',
		'settings'    => 'cyber_security_services_section_post_heading',
	) ) );
	$wp_customize->add_setting( 'cyber_security_services_single_post_option',
		array(
			'default' => 'single_right_sidebar',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Cyber_Security_Services_Radio_Image_Control( $wp_customize, 'cyber_security_services_single_post_option',
		array(
			'type'=>'select',
			'label' => __( 'select Single Post Page Layout', 'cyber-security-services' ),
			'section' => 'cyber_security_services_layout',
			'choices' => array(

				'single_right_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/2column.jpg',
					'name' => __( 'Right Sidebar', 'cyber-security-services' )
				),
				'single_left_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/left.png',
					'name' => __( 'Left Sidebar', 'cyber-security-services' )
				),
				'single_full_width' => array(
					'image' => get_template_directory_uri().'/assets/images/1column.jpg',
					'name' => __( 'One Column', 'cyber-security-services' )
				),
			)
		)
	) );
	$wp_customize->add_setting('cyber_security_services_single_post_tag',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_single_post_tag',
			array(
				'settings'        => 'cyber_security_services_single_post_tag',
				'section'         => 'cyber_security_services_layout',
				'label'           => __( 'Show Tags', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'cyber_security_services_single_post_tag', array(
		'selector' => '.single-tags',
		'render_callback' => 'cyber_security_services_customize_partial_cyber_security_services_single_post_tag',
	) );
	$wp_customize->add_setting('cyber_security_services_similar_post',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Cyber_Security_Services_Customizer_Customcontrol_Switch(
			$wp_customize,
			'cyber_security_services_similar_post',
			array(
				'settings'        => 'cyber_security_services_similar_post',
				'section'         => 'cyber_security_services_layout',
				'label'           => __( 'Show Similar post', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('cyber_security_services_similar_text',array(
		'default' => 'Explore More',
		'sanitize_callback' => 'sanitize_text_field'
	)); 
	$wp_customize->add_control('cyber_security_services_similar_text',array(
		'label' => esc_html__('Similar Post Heading','cyber-security-services'),
		'section' => 'cyber_security_services_layout',
		'setting' => 'cyber_security_services_similar_text',
		'type'    => 'text'
	));
	$wp_customize->add_section('cyber_security_services_archieve_post_layot',array(
        'title' => __('Archieve-Post Layout', 'cyber-security-services'),
        'panel' => 'cyber_security_services_post_panel',
    ) );
	$wp_customize->add_setting( 'cyber_security_services_section_archive_post_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_archive_post_heading', array(
		'label'       => esc_html__( 'Archieve Post Structure', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_archieve_post_layot',
		'settings'    => 'cyber_security_services_section_archive_post_heading',
	) ) );
    $wp_customize->add_setting( 'cyber_security_services_post_option',
		array(
			'default' => 'right_sidebar',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Cyber_Security_Services_Radio_Image_Control( $wp_customize, 'cyber_security_services_post_option',
		array(
			'type'=>'select',
			'label' => __( 'select Post Page Layout', 'cyber-security-services' ),
			'section' => 'cyber_security_services_archieve_post_layot',
			'choices' => array(
				'right_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/2column.jpg',
					'name' => __( 'Right Sidebar', 'cyber-security-services' )
				),
				'left_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/left.png',
					'name' => __( 'Left Sidebar', 'cyber-security-services' )
				),
				'one_column' => array(
					'image' => get_template_directory_uri().'/assets/images/1column.jpg',
					'name' => __( 'One Column', 'cyber-security-services' )
				),
				'three_column' => array(
					'image' => get_template_directory_uri().'/assets/images/3column.jpg',
					'name' => __( 'Three Column', 'cyber-security-services' )
				),
				'four_column' => array(
					'image' => get_template_directory_uri().'/assets/images/4column.jpg',
					'name' => __( 'Four Column', 'cyber-security-services' )
				),
				'grid_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/grid-sidebar.jpg',
					'name' => __( 'Grid-Right-Sidebar Layout', 'cyber-security-services' )
				),
				'grid_left_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/grid-left.png',
					'name' => __( 'Grid-Left-Sidebar Layout', 'cyber-security-services' )
				),
				'grid_post' => array(
					'image' => get_template_directory_uri().'/assets/images/grid.jpg',
					'name' => __( 'Grid Layout', 'cyber-security-services' )
				)
			)
		)
	) );
	$wp_customize->add_setting('cyber_security_services_grid_column',array(
        'default' => '3_column',
        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
	));
	$wp_customize->add_control('cyber_security_services_grid_column',array(
		'type' => 'radio',
		'label'     => __('Grid Post Per Row', 'cyber-security-services'),
		'section' => 'cyber_security_services_archieve_post_layot',
		'type' => 'select',
		'choices' => array(
			'1_column' => __('1','cyber-security-services'),
            '2_column' => __('2','cyber-security-services'),
            '3_column' => __('3','cyber-security-services'),
            '4_column' => __('4','cyber-security-services'),
		)
	) );
	$wp_customize->add_setting('archieve_post_order', array(
        'default' => array('title', 'image', 'meta','excerpt','btn'),
        'sanitize_callback' => 'cyber_security_services_sanitize_sortable',
    ));
    $wp_customize->add_control(new Cyber_Security_Services_Control_Sortable($wp_customize, 'archieve_post_order', array(
    	'label' => esc_html__('Post Order', 'cyber-security-services'),
        'description' => __('Drag & Drop post items to re-arrange the order and also hide and show items as per the need by clicking on the eye icon.', 'cyber-security-services') ,
        'section' => 'cyber_security_services_archieve_post_layot',
        'choices' => array(
            'title' => __('title', 'cyber-security-services') ,
            'image' => __('media', 'cyber-security-services') ,
            'meta' => __('meta', 'cyber-security-services') ,
            'excerpt' => __('excerpt', 'cyber-security-services') ,
            'btn' => __('Read more', 'cyber-security-services') ,
        ) ,
    )));
	$wp_customize->add_setting('cyber_security_services_post_excerpt',array(
		'default'=> 30,
		'transport' => 'refresh',
		'sanitize_callback' => 'cyber_security_services_sanitize_integer'
	));
	$wp_customize->add_control(new Cyber_Security_Services_Slider_Custom_Control( $wp_customize, 'cyber_security_services_post_excerpt',array(
		'label' => esc_html__( 'Excerpt Limit','cyber-security-services' ),
		'section'=> 'cyber_security_services_archieve_post_layot',
		'settings'=>'cyber_security_services_post_excerpt',
		'input_attrs' => array(
			'reset'			   => 30,
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));
	$wp_customize->add_setting('cyber_security_services_read_more_text',array(
		'default' => 'Read More',
		'sanitize_callback' => 'sanitize_text_field'
	)); 
	$wp_customize->add_control('cyber_security_services_read_more_text',array(
		'label' => esc_html__('Read More Text','cyber-security-services'),
		'section' => 'cyber_security_services_archieve_post_layot',
		'setting' => 'cyber_security_services_read_more_text',
		'type'    => 'text'
	));

	$wp_customize->add_section('cyber_security_services_blog_pagination',array(
        'title' => __('Pagination', 'cyber-security-services'), 
        'panel' => 'cyber_security_services_post_panel',       
    ) );

	$wp_customize->add_setting('cyber_security_services_pagination_type',array(
        'default' => 'numbered',
        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
	));
	$wp_customize->add_control('cyber_security_services_pagination_type',array(
		'type' => 'radio',
		'label'     => __('Blog Pagination', 'cyber-security-services'),
		'section' => 'cyber_security_services_blog_pagination',
		'type' => 'select',
		'choices' => array(
			'default' => __('Previous/Next','cyber-security-services'),
            'numbered' => __('Numbered','cyber-security-services'),
		),
	) );

	$wp_customize->add_setting('cyber_security_services_single_post_pagination_type',array(
        'default' => 'default',
        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
	));
	$wp_customize->add_control('cyber_security_services_single_post_pagination_type',array(
		'type' => 'radio',
		'label'     => __('Post Pagination', 'cyber-security-services'),
		'section' => 'cyber_security_services_blog_pagination',
		'type' => 'select',
		'choices' => array(
			'default' => __('Previous/Next','cyber-security-services'),
            'post-name' => __('Post Title','cyber-security-services'),
		),
	) );

	// header-image
	$wp_customize->add_setting( 'cyber_security_services_section_header_image_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_header_image_heading', array(
		'label'       => esc_html__( 'Header Image Settings', 'cyber-security-services' ),
		'section'     => 'header_image',
		'settings'    => 'cyber_security_services_section_header_image_heading',
		'priority'    =>'1',
	) ) );

	$wp_customize->add_setting('cyber_security_services_show_header_image',array(
        'default' => 'on',
        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
	));
	$wp_customize->add_control('cyber_security_services_show_header_image',array(
        'type' => 'select',
        'label' => __('Select Option','cyber-security-services'),
        'section' => 'header_image',
        'choices' => array(
            'on' => __('With Header Image','cyber-security-services'),
            'off' => __('Without Header Image','cyber-security-services'),
        ),
	) );

	// breadcrumb setting
	$wp_customize->add_section('cyber_security_services_breadcrumb_settings',array(
        'title' => __('Breadcrumb Settings', 'cyber-security-services'),
        'priority' => 4
    ) );
	$wp_customize->add_setting( 'cyber_security_services_section_breadcrumb_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_breadcrumb_heading', array(
		'label'       => esc_html__( ' theme Breadcrumb Settings', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_breadcrumb_settings',
		'settings'    => 'cyber_security_services_section_breadcrumb_heading',
	) ) );
	$wp_customize->add_setting(
		'cyber_security_services_enable_breadcrumb',
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
			'cyber_security_services_enable_breadcrumb',
			array(
				'settings'        => 'cyber_security_services_enable_breadcrumb',
				'section'         => 'cyber_security_services_breadcrumb_settings',
				'label'           => __( 'Show Breadcrumb', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('cyber_security_services_breadcrumb_separator', array(
        'default' => ' / ',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('cyber_security_services_breadcrumb_separator', array(
        'label' => __('Breadcrumb Separator', 'cyber-security-services'),
        'section' => 'cyber_security_services_breadcrumb_settings',
        'type' => 'text',
    ));
	$wp_customize->add_setting( 'cyber_security_services_single_breadcrumb_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_single_breadcrumb_heading', array(
		'label'       => esc_html__( 'Single post & Page', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_breadcrumb_settings',
		'settings'    => 'cyber_security_services_single_breadcrumb_heading',
	) ) );
	$wp_customize->add_setting(
		'cyber_security_services_single_enable_breadcrumb',
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
			'cyber_security_services_single_enable_breadcrumb',
			array(
				'settings'        => 'cyber_security_services_single_enable_breadcrumb',
				'section'         => 'cyber_security_services_breadcrumb_settings',
				'label'           => __( 'Show Breadcrumb', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	if ( class_exists( 'WooCommerce' ) ) { 
		$wp_customize->add_setting( 'cyber_security_services_woocommerce_breadcrumb_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_woocommerce_breadcrumb_heading', array(
			'label'       => esc_html__( 'Woocommerce Breadcrumb', 'cyber-security-services' ),
			'section'     => 'cyber_security_services_breadcrumb_settings',
			'settings'    => 'cyber_security_services_woocommerce_breadcrumb_heading',
		) ) );
		$wp_customize->add_setting(
			'cyber_security_services_woocommerce_enable_breadcrumb',
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
				'cyber_security_services_woocommerce_enable_breadcrumb',
				array(
					'settings'        => 'cyber_security_services_woocommerce_enable_breadcrumb',
					'section'         => 'cyber_security_services_breadcrumb_settings',
					'label'           => __( 'Show Breadcrumb', 'cyber-security-services' ),				
					'choices'		  => array(
						'1'      => __( 'On', 'cyber-security-services' ),
						'off'    => __( 'Off', 'cyber-security-services' ),
					),
					'active_callback' => '',
				)
			)
		);
		$wp_customize->add_setting('woocommerce_breadcrumb_separator', array(
	        'default' => ' / ',
	        'sanitize_callback' => 'sanitize_text_field',
	    ));
	    $wp_customize->add_control('woocommerce_breadcrumb_separator', array(
	        'label' => __('Breadcrumb Separator', 'cyber-security-services'),
	        'section' => 'cyber_security_services_breadcrumb_settings',
	        'type' => 'text',
	    ));
	}

	// woocommerce
	if ( class_exists( 'WooCommerce' ) ) { 
		$wp_customize->add_section('cyber_security_services_woocoomerce_section',array(
	        'title' => __('Custom Woocommerce Settings', 'cyber-security-services'),
	        'panel' => 'woocommerce',
	        'priority' => 4,
	    ) );
		$wp_customize->add_setting( 'cyber_security_services_section_shoppage_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_shoppage_heading', array(
			'label'       => esc_html__( 'Sidebar Settings', 'cyber-security-services' ),
			'section'     => 'cyber_security_services_woocoomerce_section',
			'settings'    => 'cyber_security_services_section_shoppage_heading',
		) ) );
		$wp_customize->add_setting( 'cyber_security_services_shop_page_sidebar',
			array(
				'default' => 'right_sidebar',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control( new Cyber_Security_Services_Radio_Image_Control( $wp_customize, 'cyber_security_services_shop_page_sidebar',
			array(
				'type'=>'select',
				'label' => __( 'Show Shop Page Sidebar', 'cyber-security-services' ),
				'section'     => 'cyber_security_services_woocoomerce_section',
				'choices' => array(

					'right_sidebar' => array(
						'image' => get_template_directory_uri().'/assets/images/2column.jpg',
						'name' => __( 'Right Sidebar', 'cyber-security-services' )
					),
					'left_sidebar' => array(
						'image' => get_template_directory_uri().'/assets/images/left.png',
						'name' => __( 'Left Sidebar', 'cyber-security-services' )
					),
					'full_width' => array(
						'image' => get_template_directory_uri().'/assets/images/1column.jpg',
						'name' => __( 'Full Width', 'cyber-security-services' )
					),
				)
			)
		) );
		$wp_customize->add_setting( 'cyber_security_services_wocommerce_single_page_sidebar',
			array(
				'default' => 'right_sidebar',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control( new Cyber_Security_Services_Radio_Image_Control( $wp_customize, 'cyber_security_services_wocommerce_single_page_sidebar',
			array(
				'type'=>'select',
				'label'           => __( 'Show Single Product Page Sidebar', 'cyber-security-services' ),
				'section'     => 'cyber_security_services_woocoomerce_section',
				'choices' => array(

					'right_sidebar' => array(
						'image' => get_template_directory_uri().'/assets/images/2column.jpg',
						'name' => __( 'Right Sidebar', 'cyber-security-services' )
					),
					'left_sidebar' => array(
						'image' => get_template_directory_uri().'/assets/images/left.png',
						'name' => __( 'Left Sidebar', 'cyber-security-services' )
					),
					'full_width' => array(
						'image' => get_template_directory_uri().'/assets/images/1column.jpg',
						'name' => __( 'Full Width', 'cyber-security-services' )
					),
				)
			)
		) );
		$wp_customize->add_setting( 'cyber_security_services_section_archieve_product_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_archieve_product_heading', array(
			'label'       => esc_html__( 'Archieve Product Settings', 'cyber-security-services' ),
			'section'     => 'cyber_security_services_woocoomerce_section',
			'settings'    => 'cyber_security_services_section_archieve_product_heading',
		) ) );
		$wp_customize->add_setting('cyber_security_services_archieve_item_columns',array(
	        'default' => '3',
	        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
		));
		$wp_customize->add_control('cyber_security_services_archieve_item_columns',array(
	        'type' => 'select',
	        'label' => __('Select No of Columns','cyber-security-services'),
	        'section' => 'cyber_security_services_woocoomerce_section',
	        'choices' => array(
	            '1' => __('One Column','cyber-security-services'),
	            '2' => __('Two Column','cyber-security-services'),
	            '3' => __('Three Column','cyber-security-services'),
	            '4' => __('four Column','cyber-security-services'),
	            '5' => __('Five Column','cyber-security-services'),
	            '6' => __('Six Column','cyber-security-services'),
	        ),
		) );
		$wp_customize->add_setting( 'cyber_security_services_archieve_shop_perpage', array(
			'default'              => 6,
			'type'                 => 'theme_mod',
			'transport' 		   => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_sanitize_number_absint',
			'sanitize_js_callback' => 'absint',
		) );
		$wp_customize->add_control( 'cyber_security_services_archieve_shop_perpage', array(
			'label'       => esc_html__( 'Display Products','cyber-security-services' ),
			'section'     => 'cyber_security_services_woocoomerce_section',
			'type'        => 'number',
			'input_attrs' => array(
				'step'             => 1,
				'min'              => 0,
				'max'              => 30,
			),
		) );
		$wp_customize->add_setting( 'cyber_security_services_section_related_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_related_heading', array(
			'label'       => esc_html__( 'Related Product Settings', 'cyber-security-services' ),
			'section'     => 'cyber_security_services_woocoomerce_section',
			'settings'    => 'cyber_security_services_section_related_heading',
		) ) );
		$wp_customize->add_setting('cyber_security_services_related_item_columns',array(
	        'default' => '3',
	        'sanitize_callback' => 'cyber_security_services_sanitize_choices'
		));
		$wp_customize->add_control('cyber_security_services_related_item_columns',array(
	        'type' => 'select',
	        'label' => __('Select No of Columns','cyber-security-services'),
	        'section' => 'cyber_security_services_woocoomerce_section',
	        'choices' => array(
	            '1' => __('One Column','cyber-security-services'),
	            '2' => __('Two Column','cyber-security-services'),
	            '3' => __('Three Column','cyber-security-services'),
	            '4' => __('four Column','cyber-security-services'),
	            '5' => __('Five Column','cyber-security-services'),
	            '6' => __('Six Column','cyber-security-services'),
	        ),
		) );
		$wp_customize->add_setting( 'cyber_security_services_related_shop_perpage', array(
			'default'              => 3,
			'type'                 => 'theme_mod',
			'transport' 		   => 'refresh',
			'sanitize_callback'    => 'cyber_security_services_sanitize_number_absint',
			'sanitize_js_callback' => 'absint',
		) );
		$wp_customize->add_control( 'cyber_security_services_related_shop_perpage', array(
			'label'       => esc_html__( 'Display Products','cyber-security-services' ),
			'section'     => 'cyber_security_services_woocoomerce_section',
			'type'        => 'number',
			'input_attrs' => array(
				'step'             => 1,
				'min'              => 0,
				'max'              => 10,
			),
		) );
		$wp_customize->add_setting(
			'cyber_security_services_related_product',
			array(
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'theme_supports'       => '',
				'default'              => '1',
				'transport'            => 'refresh',
				'sanitize_callback'    => 'cyber_security_services_callback_sanitize_switch',
			)
		);
		$wp_customize->add_control(new Cyber_Security_Services_Customizer_Customcontrol_Switch($wp_customize,'cyber_security_services_related_product',
			array(
				'settings'        => 'cyber_security_services_related_product',
				'section'         => 'cyber_security_services_woocoomerce_section',
				'label'           => __( 'Show Related Products', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		));
	}
	
	// mobile width
	$wp_customize->add_section('cyber_security_services_mobile_options',array(
        'title' => __('Mobile Media settings', 'cyber-security-services'),
        'priority' => 4,
    ) );
    $wp_customize->add_setting( 'cyber_security_services_section_mobile_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_mobile_heading', array(
		'label'       => esc_html__( 'Mobile Media settings', 'cyber-security-services' ),
		'section'     => 'cyber_security_services_mobile_options',
		'settings'    => 'cyber_security_services_section_mobile_heading',
		'priority' => 1,
	) ) );
	$wp_customize->add_setting('cyber_security_services_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Cyber_Security_Services_Fontawesome_Icon_Chooser(
        $wp_customize,'cyber_security_services_menu_icon',array(
		'label'	=> __('Menu Icon','cyber-security-services'),
		'transport' => 'refresh',
		'section'	=> 'cyber_security_services_mobile_options',
		'setting'	=> 'cyber_security_services_menu_icon',
		'type'		=> 'icon'
	))); 
	$wp_customize->add_setting(
		'cyber_security_services_slider_button_mobile_show_hide',
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
			'cyber_security_services_slider_button_mobile_show_hide',
			array(
				'settings'        => 'cyber_security_services_slider_button_mobile_show_hide',
				'section'         => 'cyber_security_services_mobile_options',
				'label'           => __( 'Show Slider Button', 'cyber-security-services' ),
				'description' => __('Control wont function if the button is off in the main slider settings.', 'cyber-security-services') ,				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting(
		'cyber_security_services_scroll_enable_mobile',
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
			'cyber_security_services_scroll_enable_mobile',
			array(
				'settings'        => 'cyber_security_services_scroll_enable_mobile',
				'section'         => 'cyber_security_services_mobile_options',
				'label'           => __( 'Show Scroll Top', 'cyber-security-services' ),
				'description' => __('Control wont function if scroll-top is off in the main settings.', 'cyber-security-services') ,				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'cyber_security_services_section_mobile_breadcrumb_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Cyber_Security_Services_Customizer_Customcontrol_Section_Heading( $wp_customize, 'cyber_security_services_section_mobile_breadcrumb_heading', array(
		'label'       => esc_html__( 'Mobile Breadcrumb settings', 'cyber-security-services' ),
		'description' => __('Controls wont function if the breadcrumb is off in the main breadcrumb settings.', 'cyber-security-services') ,
		'section'     => 'cyber_security_services_mobile_options',
		'settings'    => 'cyber_security_services_section_mobile_breadcrumb_heading',
	) ) );
	$wp_customize->add_setting(
		'cyber_security_services_enable_breadcrumb_mobile',
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
			'cyber_security_services_enable_breadcrumb_mobile',
			array(
				'settings'        => 'cyber_security_services_enable_breadcrumb_mobile',
				'section'         => 'cyber_security_services_mobile_options',
				'label'           => __( 'Theme Breadcrumb', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting(
		'cyber_security_services_single_enable_breadcrumb_mobile',
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
			'cyber_security_services_single_enable_breadcrumb_mobile',
			array(
				'settings'        => 'cyber_security_services_single_enable_breadcrumb_mobile',
				'section'         => 'cyber_security_services_mobile_options',
				'label'           => __( 'Single Post & Page', 'cyber-security-services' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'cyber-security-services' ),
					'off'    => __( 'Off', 'cyber-security-services' ),
				),
				'active_callback' => '',
			)
		)
	);
	if ( class_exists( 'WooCommerce' ) ) {
		$wp_customize->add_setting(
			'cyber_security_services_woocommerce_enable_breadcrumb_mobile',
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
				'cyber_security_services_woocommerce_enable_breadcrumb_mobile',
				array(
					'settings'        => 'cyber_security_services_woocommerce_enable_breadcrumb_mobile',
					'section'         => 'cyber_security_services_mobile_options',
					'label'           => __( 'wooCommerce Breadcrumb', 'cyber-security-services' ),				
					'choices'		  => array(
						'1'      => __( 'On', 'cyber-security-services' ),
						'off'    => __( 'Off', 'cyber-security-services' ),
					),
					'active_callback' => '',
				)
			)
		);
	}

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'cyber_security_services_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'cyber_security_services_customize_partial_blogdescription',
	) );

	//front page
	$num_sections = apply_filters( 'cyber_security_services_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$wp_customize->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'cyber_security_services_sanitize_dropdown_pages',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'cyber-security-services' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'cyber-security-services' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'cyber_security_services_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'cyber_security_services_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
add_action( 'customize_register', 'cyber_security_services_customize_register' );

function cyber_security_services_customize_partial_blogname() {
	bloginfo( 'name' );
}
function cyber_security_services_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
function cyber_security_services_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}
function cyber_security_services_is_view_with_layout_option() {
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

/* Pro control */
if (class_exists('WP_Customize_Control') && !class_exists('Cyber_Security_Services_Pro_Control')):
    class Cyber_Security_Services_Pro_Control extends WP_Customize_Control{

    public function render_content(){?>
        <label style="overflow: hidden; zoom: 1;">
	        <div class="col-md upsell-btn">
                <a href="<?php echo esc_url( CYBER_SECURITY_SERVICES_BUY_PRO ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE CYBER SECURITY PREMIUM','cyber-security-services');?> </a>
	        </div>
            <div class="col-md">
                <img class="cyber_security_services_img_responsive " src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png">
            </div>
	        <div class="col-md">
	            <h3 style="margin-top:10px; margin-left: 20px; font-size:12px; text-decoration:underline; color:#333;"><?php esc_html_e('Cyber Security Services PREMIUM - Features', 'cyber-security-services'); ?></h3>
                <ul style="padding-top:10px">
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'cyber-security-services');?> </li>
                    <li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'cyber-security-services');?> </li>
                   	<li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'cyber-security-services');?> </li>
                   	<li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'cyber-security-services');?> </li>
                   	<li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'cyber-security-services');?> </li>
                   	<li class="upsell-cyber_security_services"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'cyber-security-services');?> </li>
                </ul>
        	</div>
		    <div class="col-md upsell-btn upsell-btn-bottom">
	            <a href="<?php echo esc_url( CYBER_SECURITY_SERVICES_BUNDLE_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('WP Theme Bundle (120+ Themes)','cyber-security-services');?> </a>
		    </div>
        </label>
    <?php } }
endif;
