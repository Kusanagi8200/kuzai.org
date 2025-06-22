<?php

	require get_template_directory() . '/inc/dashboard/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function cyber_security_services_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Ovation Elements', 'cyber-security-services' ),
			'slug'             => 'ovation-elements',
			'required'         => false,
			'force_activation' => false,
		)

	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'cyber_security_services_register_recommended_plugins' );