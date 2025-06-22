<?php
/**
 * Settings for demo import
 *
 */

/**
 * Define constants
 **/
if ( ! defined( 'WHIZZIE_DIR' ) ) {
	define( 'WHIZZIE_DIR', dirname( __FILE__ ) );
}
require trailingslashit( WHIZZIE_DIR ) . 'dashboard-contents.php';
$cyber_security_services_current_theme = wp_get_theme();
$cyber_security_services_theme_title = $cyber_security_services_current_theme->get( 'Name' );


/**
 * Make changes below
 **/

// Change the title and slug of your wizard page
$config['cyber_security_services_page_slug'] 	= 'cyber-security-services';
$config['cyber_security_services_page_title']	= 'Begin Installation';

$config['steps'] = array(
	'plugins' => array(
		'id'			=> 'plugins',
		'title'			=> __( 'Install and Activate Recommended Plugins', 'cyber-security-services' ),
		'icon'			=> 'admin-plugins',
		'button_text'	=> __( 'Install Recommended Plugins', 'cyber-security-services' ),
		'can_skip'		=> true
	),
	'widgets' => array(
		'id'			=> 'widgets',
		'title'			=> __( 'Begin With Demo Import', 'cyber-security-services' ),
		'icon'			=> 'welcome-widgets-menus',
		'button_text'	=> __( 'Begin With Demo Import', 'cyber-security-services' ),
		'can_skip'		=> true
	),
	'done' => array(
		'id'			=> 'done',
		'title'			=> __( 'Customize Your Site', 'cyber-security-services' ),
		'icon'			=> 'yes',
	)
);

/**
 * This kicks off the wizard
 **/
if( class_exists( 'Cyber_Security_Services_Whizzie' ) ) {
	$Cyber_Security_Services_Whizzie = new Cyber_Security_Services_Whizzie( $config );
}