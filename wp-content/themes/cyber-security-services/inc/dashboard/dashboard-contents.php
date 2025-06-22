<?php
/**
 * Wizard
 *
 * @package Cyber_Security_Services_Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

class Cyber_Security_Services_Whizzie {
	
	protected $version = '1.1.0';
	
	/** @var string Current theme name, used as namespace in actions. */
	protected $cyber_security_services_theme_name = '';
	protected $cyber_security_services_theme_title = '';
	
	/** @var string Wizard page slug and title. */
	protected $cyber_security_services_page_slug = '';
	protected $cyber_security_services_page_title = '';
	
	/** @var array Wizard steps set by user. */
	protected $config_steps = array();
	
	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	 */
	protected $cyber_security_services_plugin_url = '';

	public $cyber_security_services_plugin_path;
	public $parent_slug;
	
	/**
	 * TGMPA instance storage
	 *
	 * @var object
	 */
	protected $tgmpa_instance;
	
	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	 */
	protected $tgmpa_menu_slug = 'tgmpa-install-plugins';
	
	/**
	 * TGMPA Menu url
	 *
	 * @var string
	 */
	protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';
	
	/**
	 * Constructor
	 *
	 * @param $config	Our config parameters
	 */
	public function __construct( $config ) {
		$this->set_vars( $config );
		$this->init();
	}
	
	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $config	Our config parameters
	 */
	public function set_vars( $config ) {
	
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/class-tgm-plugin-activation.php';
		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/tgm.php';

		if( isset( $config['cyber_security_services_page_slug'] ) ) {
			$this->cyber_security_services_page_slug = esc_attr( $config['cyber_security_services_page_slug'] );
		}
		if( isset( $config['cyber_security_services_page_title'] ) ) {
			$this->cyber_security_services_page_title = esc_attr( $config['cyber_security_services_page_title'] );
		}
		if( isset( $config['steps'] ) ) {
			$this->config_steps = $config['steps'];
		}
		
		$this->cyber_security_services_plugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->cyber_security_services_plugin_path );
		$this->cyber_security_services_plugin_url = trailingslashit( get_template_directory_uri() . $relative_url );

		$cyber_security_services_current_theme = wp_get_theme();

		$this->cyber_security_services_theme_title = $cyber_security_services_current_theme->get( 'Name' );
		$this->cyber_security_services_theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $cyber_security_services_current_theme->get( 'Name' ) ) );
		
		$this->cyber_security_services_page_slug = apply_filters( $this->cyber_security_services_theme_name . '_theme_setup_wizard_cyber_security_services_page_slug', $this->cyber_security_services_theme_name . '-wizard' );
		$this->parent_slug = apply_filters( $this->cyber_security_services_theme_name . '_theme_setup_wizard_parent_slug', '' );

	}
	
	/**
	 * Hooks and filters
	 * @since 1.0.0
	 */	
	public function init() {
		
		if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_setup_plugins', array( $this, 'setup_plugins' ) );
		add_action( 'wp_ajax_cyber_security_services_setup_widgets', array( $this, 'cyber_security_services_setup_widgets' ) );
		
	}
	
	public function enqueue_scripts() {
		wp_enqueue_style( 'cyber-security-services-dashboard-style', get_template_directory_uri() . '/inc/dashboard/assets/css/dashboard.css');
		wp_register_script( 'cyber-security-services-dashboard-script', get_template_directory_uri() . '/inc/dashboard/assets/js/dashboard.js', array( 'jquery' ), time() );
		wp_localize_script( 
			'cyber-security-services-dashboard-script',
			'whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'wpnonce' 		=> wp_create_nonce( 'whizzie_nonce' ),
				'verify_text'	=> esc_html( 'verifying', 'cyber-security-services' )
			)
		);
		wp_enqueue_script( 'cyber-security-services-dashboard-script' );
	}
	
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}
			
	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function get_tgmpa_instance() {
		$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}
	
	/**
	 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	 */
	public function set_tgmpa_url() {
		$this->tgmpa_menu_slug = ( property_exists( $this->tgmpa_instance, 'menu' ) ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
		$this->tgmpa_menu_slug = apply_filters( $this->cyber_security_services_theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->tgmpa_instance, 'parent_slug' ) && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->tgmpa_url = apply_filters( $this->cyber_security_services_theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->tgmpa_menu_slug );
	}
	
	/**
	 * Make a modal screen for the wizard
	 */
	public function menu_page() {
		add_theme_page( esc_html( $this->cyber_security_services_page_title ), esc_html( $this->cyber_security_services_page_title ), 'manage_options', $this->cyber_security_services_page_slug, array( $this, 'wizard_page' ) );
	}
	
	/**
	 * Make an interface for the wizard
	 */
	public function wizard_page() { 
		tgmpa_load_bulk_installer();

		if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
			die( esc_html__( 'Failed to find TGM', 'cyber-security-services' ) );
		}

		$url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );
		$method = '';
		$fields = array_keys( $_POST );

		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $url ), $method, false, false, $fields ) ) ) {
			return true;
		}

		if ( ! WP_Filesystem( $creds ) ) {
			request_filesystem_credentials( esc_url_raw( $url ), $method, true, false, $fields );
			return true;
		}

		$cyber_security_services_theme = wp_get_theme();
		$cyber_security_services_theme_title = $cyber_security_services_theme->get( 'Name' );

		?>
		<div class="getting-started__header">
			<div class="header-box-left">
				<h2><?php echo esc_html( $cyber_security_services_theme_title ); ?></h2>
				<p><?php esc_html_e('Version: ', 'cyber-security-services'); ?><?php echo esc_html($cyber_security_services_theme['Version']);?></p>
			</div>
			<div class="header-box-right">
				<div class="btn_box">
					<a class="button-primary" href="<?php echo esc_url( CYBER_SECURITY_SERVICES_FREE_DOC ); ?>" target="_blank"><?php esc_html_e('Theme Documentation', 'cyber-security-services'); ?></a>
					<a class="button-primary" href="<?php echo esc_url( CYBER_SECURITY_SERVICES_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support', 'cyber-security-services'); ?></a>
					<a class="button-primary" href="<?php echo esc_url( CYBER_SECURITY_SERVICES_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'cyber-security-services'); ?></a>
				</div>
			</div>
		</div>
		
		<div class="import-box">
			<div class="whizzie-wrap">
				<div class="demo_content">
					<?php
						$cyber_security_services_steps = $this->get_steps();
						echo '<ul class="whizzie-menu">';
						foreach ( $cyber_security_services_steps as $cyber_security_services_step ) {
							$class = 'step step-' . esc_attr( $cyber_security_services_step['id'] );
							echo '<li data-step="' . esc_attr( $cyber_security_services_step['id'] ) . '" class="' . esc_attr( $class ) . '">';
							printf( '<h2>%s</h2>', esc_html( $cyber_security_services_step['title'] ) );

							$content = call_user_func( array( $this, $cyber_security_services_step['view'] ) );
							if ( isset( $content['summary'] ) ) {
								printf(
									'<div class="summary">%s</div>',
									wp_kses_post( $content['summary'] )
								);
							}
							if ( isset( $content['detail'] ) ) {
								printf(
									'<div class="detail">%s</div>',
									wp_kses_post( $content['detail'] )
								);
							}
							if ( isset( $cyber_security_services_step['button_text'] ) && $cyber_security_services_step['button_text'] ) {
								printf( 
									'<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
									esc_attr( $cyber_security_services_step['callback'] ),
									esc_attr( $cyber_security_services_step['id'] ),
									esc_html( $cyber_security_services_step['button_text'] )
								);
							}
							echo '</li>';
						}
						echo '</ul>';
					?>
						
					<ul class="whizzie-nav">
						<?php
						$step_number = 1;	
						foreach ( $cyber_security_services_steps as $cyber_security_services_step ) {
							echo '<li class="nav-step-' . esc_attr( $cyber_security_services_step['id'] ) . '">';
							echo '<span class="step-number">' . esc_html( $step_number ) . '</span>';
							echo '</li>';
							$step_number++;
						}
						?>
						<div class="blank-border"></div>
					</ul>

					<div class="step-loading"><span class="spinner"></span></div>
				</div>
			</div>
		</div>

		<div class="wrap getting-started">
			<div class="box-container">
				<div class="box-left-main">
					<div class="leftbox">
						<h3><?php esc_html_e('Documentation','cyber-security-services'); ?></h3>
						<p><?php esc_html_e('To setup the cyber security service theme follow the below steps.','cyber-security-services'); ?></p>

						<h4><?php esc_html_e('1. Setup Logo','cyber-security-services'); ?></h4>
						<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Site Identity >> Upload your logo or Add site title and site description.','cyber-security-services'); ?></p>
						<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','cyber-security-services'); ?></a>

						<h4><?php esc_html_e('2. Setup Menus','cyber-security-services'); ?></h4>
						<p><?php esc_html_e('Go to dashboard >> Appearance >> Menus >> Create Menus >> Add pages, post or custom link then save it.','cyber-security-services'); ?></p>
						<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Add Menus','cyber-security-services'); ?></a>

						<h4><?php esc_html_e('3. Setup Social Icons','cyber-security-services'); ?></h4>
						<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Custom Page Settings >> Social Media >> Add social links.','cyber-security-services'); ?></p>
						<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=cyber_security_services_urls') ); ?>" target="_blank"><?php esc_html_e('Add Social Icons','cyber-security-services'); ?></a>

						<h4><?php esc_html_e('4. Setup Footer','cyber-security-services'); ?></h4>
						<p><?php esc_html_e('Go to dashboard >> Appearance >> Widgets >> Add widgets in footer 1, footer 2, footer 3, footer 4.','cyber-security-services'); ?></p>
						<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widgets','cyber-security-services'); ?></a>

						<h4><?php esc_html_e('5. Setup Footer Text','cyber-security-services'); ?></h4>
						<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Custom Page Settings >> Footer Text >> Add copyright text.','cyber-security-services'); ?></p>
						<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=cyber_security_services_footer_copyright') ); ?>" target="_blank"><?php esc_html_e('Footer Text','cyber-security-services'); ?></a>

						<h3><?php esc_html_e('Setup Home Page','cyber-security-services'); ?></h3>
						<p><?php esc_html_e('To setup the home page follow the below steps.','cyber-security-services'); ?></p>

						<h4><?php esc_html_e('1. Setup Page','cyber-security-services'); ?></h4>
						<p><?php esc_html_e('Go to dashboard >> Pages >> Add New Page >> Select "Custom Home Page" from templates. >> Publish it.','cyber-security-services'); ?></p>
						<a class="dashboard_add_new_page button-primary" href="<?php echo esc_url(admin_url( 'post-new.php?post_type=page' ) ); ?>" target="_blank"><?php esc_html_e('Add New Page','cyber-security-services'); ?></a>


						<h4><?php esc_html_e('2. Setup Slider','cyber-security-services'); ?></h4>
						<p><?php esc_html_e('Go to dashboard >> Post >> Add New Post >> Add title, content and featured image >> Publish it.','cyber-security-services'); ?></p>
						<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Custom Page Settings >> Slider Settings >> Select post.','cyber-security-services'); ?></p>
						<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=cyber_security_services_slider_section') ); ?>" target="_blank"><?php esc_html_e('Add Slider','cyber-security-services'); ?></a>

						<h4><?php esc_html_e('3. Setup About Us','cyber-security-services'); ?></h4>
						<p><?php esc_html_e('Go to dashboard >> Page >> Add New Page >> Add title, content and featured image >> Publish it.','cyber-security-services'); ?></p>
						<p><?php esc_html_e('Go to dashboard >> Appearance >> Customize >> Custom Page Settings >> About Us Section Settings >> Select page','cyber-security-services'); ?></p>
						<a class="button-primary" href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=cyber_security_services_services_section') ); ?>" target="_blank"><?php esc_html_e('Add About Us','cyber-security-services'); ?></a>
					</div>
	        	</div>
				<div class="box-right-main">
					<h3><?php echo esc_html(CYBER_SECURITY_SERVICES_THEME_NAME); ?></h3>
					<img class="cyber_security_services_img_responsive" style="width: 100%;" src="<?php echo esc_url( $cyber_security_services_theme->get_screenshot() ); ?>" />
					<div class="pro-links">
						<div class="pro-links-inner">
							<a class="button-primary livedemo" href="<?php echo esc_url( CYBER_SECURITY_SERVICES_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'cyber-security-services'); ?></a>
							<a class="button-primary buynow" href="<?php echo esc_url( CYBER_SECURITY_SERVICES_BUY_PRO ); ?>" target="_blank"><?php esc_html_e('Buy Now', 'cyber-security-services'); ?></a>
							<a class="button-primary docs" href="<?php echo esc_url( CYBER_SECURITY_SERVICES_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'cyber-security-services'); ?></a>
						</div>
							<a class="button-primary bundle-btn" href="<?php echo esc_url( CYBER_SECURITY_SERVICES_BUNDLE_LINK ); ?>" target="_blank"><?php esc_html_e('WordPress Theme Bundle (120+ Themes at Just $89)', 'cyber-security-services'); ?></a>
					</div>
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
			</div>
		</div>

		<?php
	}

	/**
	 * Set options for the steps
	 * Incorporate any options set by the theme dev
	 * Return the array for the steps
	 * @return Array
	 */
	public function get_steps() {
		$cyber_security_services_dev_steps = $this->config_steps;
		$cyber_security_services_steps = array( 
			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Install and Activate Recommended Plugins', 'cyber-security-services' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'Install Recommended Plugins', 'cyber-security-services' ),
				'can_skip'		=> true
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Begin With Demo Import', 'cyber-security-services' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'cyber_security_services_install_widgets',
				'button_text'	=> __( 'Begin With Demo Import', 'cyber-security-services' ),
				'can_skip'		=> false
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'Customize Your Site', 'cyber-security-services' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> ''
			)
		);
		
		// Iterate through each step and replace with dev config values
		if( $cyber_security_services_dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from dashboard-settings.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $cyber_security_services_dev_steps as $cyber_security_services_dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $cyber_security_services_dev_step['id'] ) ) {
					$id = $cyber_security_services_dev_step['id'];
					if( isset( $cyber_security_services_steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $cyber_security_services_dev_step[$element] ) ) {
								$cyber_security_services_steps[$id][$element] = $cyber_security_services_dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $cyber_security_services_steps;
	}

	/**
	 * Get the content for the plugins step
	 * @return $content Array
	 */
	public function get_step_plugins() {
		$plugins = $this->get_plugins();
		$content = array(); 
		
		// Add plugin name and type at the top
		$content['detail'] = '<div class="plugin-info">';
		$content['detail'] .= '<p><strong>Plugin</strong></p>';
		$content['detail'] .= '<p><strong>Type</strong></p>';
		$content['detail'] .= '</div>';
		
		// The detail element is initially hidden from the user
		$content['detail'] .= '<ul class="whizzie-do-plugins">';
		
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug=>$plugin ) {
				$content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $plugin['name'] ) . '<span>';
				$keys = array();
				if ( isset( $plugins['install'][ $slug ] ) ) {
					$keys[] = 'Installation';
				}
				if ( isset( $plugins['update'][ $slug ] ) ) {
					$keys[] = 'Update';
				}
				if ( isset( $plugins['activate'][ $slug ] ) ) {
					$keys[] = 'Activation';
				}
				$content['detail'] .= implode( ' and ', $keys ) . ' required';
				$content['detail'] .= '</span></li>';		}
		
		$content['detail'] .= '</ul>';
		
		return $content;
	}
	
	/**
	 * Print the content for the widgets step
	 * @since 1.1.0
	 */
	public function get_step_widgets() { ?> 
		<p class="note">
		    <?php
		    echo esc_html(
		        sprintf(
		            // Translators: %s refers to the theme or plugin name.
		            __( 'If your website is already live and containing data, please make a backup. This importer will override the %s\'s new customizable values.', 'cyber-security-services' ),
		            $this->cyber_security_services_theme_title
		        )
		    );
		    ?>
		</p>

	<?php }
	
	/**
	 * Print the content for the final step
	 */
	public function get_step_done() { ?>
			<h3><?php echo esc_html( 'Demo Import Successful' ); ?></h3>
			<div class="last_step_btns">
				<a target="_blank" href="<?php echo esc_url( get_home_url() ); ?>" class="button button-primary">
					<?php esc_html_e( 'View Site', 'cyber-security-services' ); ?>
				</a>
				<a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary">
					<?php esc_html_e( 'Customize Site', 'cyber-security-services' ); ?>
				</a>
				<a href="<?php echo esc_url(admin_url()); ?>" class="button button-primary">
					<?php esc_html_e( 'Done', 'cyber-security-services' ); ?>
				</a>
			</div>
	<?php }

	/**
	 * Get the plugins registered with TGMPA
	 */
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug=>$plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}

	/**
	 * Get the widgets.wie file from the /content folder
	 * @return Mixed	Either the file or false
	 * @since 1.1.0
	 */
	public function has_widget_file() {
		if( file_exists( $this->widget_file_url ) ) {
			return true;
		}
		return false;
	}
	
	public function setup_plugins() {
		if ( ! check_ajax_referer( 'whizzie_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
			wp_send_json_error( array( 'error' => 1, 'message' => esc_html__( 'No Slug Found','cyber-security-services' ) ) );
		}
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();
		
		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','cyber-security-services' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','cyber-security-services' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','cyber-security-services' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','cyber-security-services' ) ) );
		}
		exit;
	}


	
	/**
	 * Imports the Demo Content
	 * @since 1.1.0
	 */
	public function cyber_security_services_setup_widgets(){

		require get_theme_file_path( '/inc/dashboard/setup.php' ); 

	    exit;
	}
}