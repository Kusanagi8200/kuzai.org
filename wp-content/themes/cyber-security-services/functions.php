<?php
/**
 * Cyber Security Services functions and definitions
 *
 * @subpackage Cyber Security Services
 * @since 1.0
 */


// theme setup
function cyber_security_services_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( "align-wide" );
	add_theme_support( "wp-block-styles" );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( 'title-tag' );
	add_theme_support('custom-background',array(
		'default-color' => 'ffffff',
	));
	add_image_size( 'cyber-security-services-featured-image', 2000, 1200, true );
	add_image_size( 'cyber-security-services-thumbnail-avatar', 100, 100, true );

	define( 'THEME_DIR', dirname( __FILE__ ) );

	load_theme_textdomain( 'cyber-security-services', get_template_directory() . '/languages' );

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'cyber-security-services' ),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio','quote',) );
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );

		if ( ! defined( 'CYBER_SECURITY_SERVICES_SUPPORT' ) ) {
	define('CYBER_SECURITY_SERVICES_SUPPORT',__('https://wordpress.org/support/theme/cyber-security-services/','cyber-security-services'));
	}
	if ( ! defined( 'CYBER_SECURITY_SERVICES_REVIEW' ) ) {
	define('CYBER_SECURITY_SERVICES_REVIEW',__('https://wordpress.org/support/theme/cyber-security-services/reviews/','cyber-security-services'));
	}
	if ( ! defined( 'CYBER_SECURITY_SERVICES_LIVE_DEMO' ) ) {
	define('CYBER_SECURITY_SERVICES_LIVE_DEMO',__('https://trial.ovationthemes.com/cyber-security-services/','cyber-security-services'));
	}
	if ( ! defined( 'CYBER_SECURITY_SERVICES_BUY_PRO' ) ) {
	define('CYBER_SECURITY_SERVICES_BUY_PRO',__('https://www.ovationthemes.com/products/wordpress-cyber-security-theme','cyber-security-services'));
	}
	if ( ! defined( 'CYBER_SECURITY_SERVICES_PRO_DOC' ) ) {
	define('CYBER_SECURITY_SERVICES_PRO_DOC',__('https://trial.ovationthemes.com/docs/ot-cyber-security-services-pro-doc/','cyber-security-services'));
	}
	if ( ! defined( 'CYBER_SECURITY_SERVICES_FREE_DOC' ) ) {
	define('CYBER_SECURITY_SERVICES_FREE_DOC',__('https://trial.ovationthemes.com/docs/ot-cyber-security-services-free-doc/','cyber-security-services'));
	}
	if ( ! defined( 'CYBER_SECURITY_SERVICES_THEME_NAME' ) ) {
	define('CYBER_SECURITY_SERVICES_THEME_NAME',__('Premium Cyber Security Theme','cyber-security-services'));
	}
	if ( ! defined( 'CYBER_SECURITY_SERVICES_BUNDLE_LINK' ) ) {
	define('CYBER_SECURITY_SERVICES_BUNDLE_LINK',__('https://www.ovationthemes.com/products/wordpress-bundle','cyber-security-services'));
	}
	require get_template_directory() . '/inc/dashboard/dashboard-settings.php';
}
add_action( 'after_setup_theme', 'cyber_security_services_setup' );

//woocommerce//
//shop page no of columns
function cyber_security_services_woocommerce_loop_columns() {
	
	$retrun = get_theme_mod( 'cyber_security_services_archieve_item_columns', 3 );
    
    return $retrun;
}
add_filter( 'loop_shop_columns', 'cyber_security_services_woocommerce_loop_columns' );
function cyber_security_services_woocommerce_products_per_page() {

		$retrun = get_theme_mod( 'cyber_security_services_archieve_shop_perpage', 6 );
    
    return $retrun;
}
add_filter( 'loop_shop_per_page', 'cyber_security_services_woocommerce_products_per_page' );
// related products
function cyber_security_services_related_products_args( $args ) {
    $defaults = array(
        'posts_per_page' => get_theme_mod( 'cyber_security_services_related_shop_perpage', 3 ),
        'columns'        => get_theme_mod( 'cyber_security_services_related_item_columns', 3),
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'cyber_security_services_related_products_args' );

// breadcrumb seperator
function cyber_security_services_woocommerce_breadcrumb_separator($cyber_security_services_defaults) {
    $cyber_security_services_separator = get_theme_mod('woocommerce_breadcrumb_separator', ' / ');

    // Update the separator
    $cyber_security_services_defaults['delimiter'] = $cyber_security_services_separator;

    return $cyber_security_services_defaults;
}
add_filter('woocommerce_breadcrumb_defaults', 'cyber_security_services_woocommerce_breadcrumb_separator');

//add animation class
if ( class_exists( 'WooCommerce' ) ) { 
	add_filter('post_class', function($cyber_security_services_classes, $class, $product_id) {
	    if( is_shop() || is_product_category() ){
	        
	        $cyber_security_services_classes = array_merge(['wow','zoomIn'], $cyber_security_services_classes);
	    }
	    return $cyber_security_services_classes;
	},10,3);
}
//woocommerce-end//

// Get start function

// Enqueue scripts and styles
function cyber_security_services_enqueue_admin_script($hook) {
    // Admin JS
    wp_enqueue_script('cyber-security-services-admin-js', get_theme_file_uri('/assets/js/cyber-security-services-admin.js'), array('jquery'), true);
    wp_localize_script(
		'cyber-security-services-admin-js',
		'cyber_security_services',
		array(
			'admin_ajax'	=>	admin_url('admin-ajax.php'),
			'wpnonce'			=>	wp_create_nonce('cyber_security_services_dismissed_notice_nonce')
		)
	);
	wp_enqueue_script('cyber-security-services-admin-js');

    wp_localize_script( 'cyber-security-services-admin-js', 'cyber_security_services_scripts_localize',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action('admin_enqueue_scripts', 'cyber_security_services_enqueue_admin_script');

//dismiss function 
add_action( 'wp_ajax_cyber_security_services_dismissed_notice_handler', 'cyber_security_services_ajax_notice_dismiss_fuction' );

function cyber_security_services_ajax_notice_dismiss_fuction() {
	if (!wp_verify_nonce($_POST['wpnonce'], 'cyber_security_services_dismissed_notice_nonce')) {
		exit;
	}
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

//get start box
function cyber_security_services_custom_admin_notice() {
    // Check if the notice is dismissed
    if ( ! get_option('dismissed-get_started_notice', FALSE ) )  {
        // Check if not on the theme documentation page
        $cyber_security_services_current_screen = get_current_screen();
        $cyber_security_services_theme = wp_get_theme();
        $cyber_security_services_theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $cyber_security_services_theme->get( 'Name' ) ) );
		$cyber_security_services_demo_page_slug = apply_filters( $cyber_security_services_theme_name . '_theme_setup_wizard_cyber_security_services_page_slug', $cyber_security_services_theme_name . '-wizard' );
		$cyber_security_services_expected_screen_id = 'appearance_page_' . $cyber_security_services_demo_page_slug;
        if ( $cyber_security_services_current_screen && $cyber_security_services_current_screen->id !== $cyber_security_services_expected_screen_id ) { ?>
            <div class="notice notice-info is-dismissible" data-notice="get_started_notice">
                <div class="notice-div">
                    <div>
                        <p class="theme-name"><?php echo esc_html($cyber_security_services_theme->get('Name')); ?></p>
                        <p><?php _e('For information and detailed instructions, check out our theme documentation.', 'cyber-security-services'); ?></p>
                    </div>
                    <div class="notice-buttons-box">
                        <a class="button-primary livedemo" href="<?php echo esc_url( CYBER_SECURITY_SERVICES_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'cyber-security-services'); ?></a>
                        <a class="button-primary buynow" href="<?php echo esc_url( CYBER_SECURITY_SERVICES_BUY_PRO ); ?>" target="_blank"><?php esc_html_e('Buy Now', 'cyber-security-services'); ?></a>
                        <a class="button-primary theme-install" href="<?php echo esc_url( 'themes.php?page=' . $cyber_security_services_demo_page_slug ); ?>"><?php _e( 'Begin Installation', 'cyber-security-services' ); ?></a>
                    </div>
                </div>
            </div>
        <?php
        }
    }
}
add_action('admin_notices', 'cyber_security_services_custom_admin_notice');

//after switch theme
add_action('after_switch_theme', 'cyber_security_services_after_switch_theme');
function cyber_security_services_after_switch_theme () {
    update_option('dismissed-get_started_notice', FALSE );
}
//get-start-function-end//

// tag count
function cyber_security_services_display_post_tag_count() {
    $cyber_security_services_tags = get_the_tags();
    $cyber_security_services_tag_count = ($cyber_security_services_tags) ? count($cyber_security_services_tags) : 0;
    $cyber_security_services_tag_text = ($cyber_security_services_tag_count === 1) ? 'tag' : 'tags';
    echo $cyber_security_services_tag_count . ' ' . $cyber_security_services_tag_text;
}

// Date formatting
function cyber_security_services_display_shop_date() {
    // Get the date type option
    $cyber_security_services_date_type = get_theme_mod( 'cyber_security_services_date_type', 'published' );

    // Determine the date to display based on the type
    if ( $cyber_security_services_date_type === 'modified' && get_the_modified_time( 'U' ) !== get_the_time( 'U' ) ) {
        $cyber_security_services_date_to_display = get_the_modified_date( get_option( 'date_format' ) );
    } else {
        $cyber_security_services_date_to_display = get_the_date( get_option( 'date_format' ) );
    }

    // Output the date HTML

    echo esc_html( $cyber_security_services_date_to_display );
}

//media post format
function cyber_security_services_get_media($cyber_security_services_type = array()){
	$cyber_security_services_content = apply_filters( 'the_content', get_the_content() );
  	$output = false;

  // Only get media from the content if a playlist isn't present.
  if ( false === strpos( $cyber_security_services_content, 'wp-playlist-script' ) ) {
    $output = get_media_embedded_in_content( $cyber_security_services_content, $cyber_security_services_type );
    return $output;
  }
}

// front page template
function cyber_security_services_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'cyber_security_services_front_page_template' );

// excerpt function
function cyber_security_services_custom_excerpt() {
    $cyber_security_services_excerpt = get_the_excerpt();
    $cyber_security_services_plain_text_excerpt = wp_strip_all_tags($cyber_security_services_excerpt);
    
    // Get dynamic word limit from theme mod
    $cyber_security_services_word_limit = esc_attr(get_theme_mod('cyber_security_services_post_excerpt', '30'));
    
    // Limit the number of words
    $cyber_security_services_limited_excerpt = implode(' ', array_slice(explode(' ', $cyber_security_services_plain_text_excerpt), 0, $cyber_security_services_word_limit));

    echo esc_html($cyber_security_services_limited_excerpt);
}

// typography
function cyber_security_services_fonts_scripts() {
	$cyber_security_services_headings_font = esc_html(get_theme_mod('cyber_security_services_headings_text'));
	$cyber_security_services_body_font = esc_html(get_theme_mod('cyber_security_services_body_text'));

	if( $cyber_security_services_headings_font ) {
		wp_enqueue_style( 'cyber-security-services-headings-fonts', '//fonts.googleapis.com/css?family='. $cyber_security_services_headings_font );
	} else {
		wp_enqueue_style( 'cyber-security-services-source-sans', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
	}
	if( $cyber_security_services_body_font ) {
		wp_enqueue_style( 'cyber-security-services-body-fonts', '//fonts.googleapis.com/css?family='. $cyber_security_services_body_font );
	} else {
		wp_enqueue_style( 'cyber-security-services-source-body', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,700,600');
	}
}
add_action( 'wp_enqueue_scripts', 'cyber_security_services_fonts_scripts' );

// Footer Text
function cyber_security_services_copyright_link() {
    $cyber_security_services_footer_text = get_theme_mod('cyber_security_services_footer_text', esc_html__('Cyber Security WordPress Theme', 'cyber-security-services'));
    $cyber_security_services_credit_link = esc_url('https://www.ovationthemes.com/products/free-cyber-security-wordpress-theme');

    echo '<a href="' . $cyber_security_services_credit_link . '" target="_blank">' . esc_html($cyber_security_services_footer_text) . '<span class="footer-copyright">' . esc_html__(' By Ovation Themes', 'cyber-security-services') . '</span></a>';
}

// custom sanitizations
// dropdown
function cyber_security_services_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}
// slider custom control
if ( ! function_exists( 'cyber_security_services_sanitize_integer' ) ) {
	function cyber_security_services_sanitize_integer( $input ) {
		return (int) $input;
	}
}
// range contol
function cyber_security_services_sanitize_number_absint( $number, $setting ) {

	// Ensure input is an absolute integer.
	$number = absint( $number );

	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;

	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}
// select post page
function cyber_security_services_sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
// toggle switch
function cyber_security_services_callback_sanitize_switch( $value ) {
	// Switch values must be equal to 1 of off. Off is indicator and should not be translated.
	return ( ( isset( $value ) && $value == 1 ) ? 1 : 'off' );
}
//choices control
function cyber_security_services_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}
// Sanitize Sortable control.
function cyber_security_services_sanitize_sortable( $val, $setting ) {
	if ( is_string( $val ) || is_numeric( $val ) ) {
		return array(
			esc_attr( $val ),
		);
	}
	$sanitized_value = array();
	foreach ( $val as $item ) {
		if ( isset( $setting->manager->get_control( $setting->id )->choices[ $item ] ) ) {
			$sanitized_value[] = esc_attr( $item );
		}
	}
	return $sanitized_value;
}

// widgets
function cyber_security_services_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'cyber-security-services' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'cyber-security-services' ),
		'before_widget' => '<section id="%1$s" class="widget wow zoomIn %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'cyber-security-services' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'cyber-security-services' ),
		'before_widget' => '<section id="%1$s" class="widget wow zoomIn %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'cyber-security-services' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'cyber-security-services' ),
		'before_widget' => '<section id="%1$s" class="widget wow zoomIn %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'cyber-security-services' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'cyber-security-services' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'cyber-security-services' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'cyber-security-services' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'cyber-security-services' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'cyber-security-services' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'cyber-security-services' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'cyber-security-services' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'cyber_security_services_widgets_init' );

//Enqueue scripts and styles.
function cyber_security_services_scripts() {

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'jost',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' ),
		array(),
		'1.0'
	);

	//Bootstarp
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/assets/css/bootstrap.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'cyber-security-services-style', get_stylesheet_uri() );

	// rtl
	wp_style_add_data( 'cyber-security-services-style', 'rtl', 'replace' );

	// Theme Customize CSS.
	require get_parent_theme_file_path( 'inc/extra_customization.php' );
	wp_add_inline_style( 'cyber-security-services-style',$cyber_security_services_custom_style );

	//font-awesome
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri().'/assets/css/fontawesome-all.css' );

	//Owl Carousel CSS
	wp_enqueue_style( 'owl.carousel-style', get_template_directory_uri().'/assets/css/owl.carousel.css' );

	// Block Style
	wp_enqueue_style( 'cyber-security-services-block-style', esc_url( get_template_directory_uri() ).'/assets/css/blocks.css' );

	//Custom JS
	wp_enqueue_script( 'cyber-security-services-custom.js', get_theme_file_uri( '/assets/js/theme-script.js' ), array( 'jquery' ), true );

	//Nav Focus JS
	wp_enqueue_script( 'cyber-security-services-navigation-focus', get_theme_file_uri( '/assets/js/navigation-focus.js' ), array( 'jquery' ), true );

	//Bootstarp JS
	wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array( 'jquery' ),true );

	//Owl Carousel JS
	wp_enqueue_script( 'owl.carousel-js', get_theme_file_uri( '/assets/js/owl.carousel.js' ), array( 'jquery' ),true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if (get_option('cyber_security_services_animation_enable', false) !== 'off') {
		//wow.js
		wp_enqueue_script( 'cyber-security-services-wow-js', get_theme_file_uri( '/assets/js/wow.js' ), array( 'jquery' ), true );

		//animate.css
		wp_enqueue_style( 'cyber-security-services-animate-css', get_template_directory_uri().'/assets/css/animate.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'cyber_security_services_scripts' );


function cyber_security_services_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'cyber-security-services-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/css/editor-blocks.css' );
}
add_action( 'enqueue_block_editor_assets', 'cyber_security_services_block_editor_styles' );

# Load scripts and styles.(fontawesome)
add_action( 'customize_controls_enqueue_scripts', 'cyber_security_services_customize_controls_register_scripts' );
function cyber_security_services_customize_controls_register_scripts() {
	
	wp_enqueue_style( 'cyber-security-services-ctypo-customize-controls-style', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );
}

// enque files
require get_parent_theme_file_path( '/inc/custom-header.php' );
require get_parent_theme_file_path( '/inc/template-tags.php' );
require get_parent_theme_file_path( '/inc/template-functions.php' );
require get_parent_theme_file_path( '/inc/customizer.php' );
require get_parent_theme_file_path( '/inc/typofont.php' );
require get_parent_theme_file_path( '/inc/breadcrumb.php' );
require get_parent_theme_file_path( 'inc/sortable/sortable_control.php' );
