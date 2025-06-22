<?php
/**
 * The header for our theme
 *
 * @subpackage Cyber Security Services
 * @since 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else {
	    do_action( 'wp_body_open' );
	}
?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cyber-security-services' ); ?></a>
	<?php if( get_option('cyber_security_services_theme_loader',true) != 'off'){ ?>
		<?php $cyber_security_services_loader_option = get_theme_mod( 'cyber_security_services_loader_style','style_one');
		if($cyber_security_services_loader_option == 'style_one'){ ?>
			<div id="preloader" class="circle">
				<div id="loader"></div>
			</div>
		<?php }
		else if($cyber_security_services_loader_option == 'style_two'){ ?>
			<div id="preloader">
				<div class="spinner">
					<div class="rect1"></div>
					<div class="rect2"></div>
					<div class="rect3"></div>
					<div class="rect4"></div>
					<div class="rect5"></div>
				</div>
			</div>
		<?php }?>
	<?php }?>
	<div id="page" class="site">
		<div class="wrap_figure wow slideInDown">
			<div class="menubarr py-2">
				<div class="menu_header">
					<div class="container">
						<div class="row mx-0">
							<div class="col-lg-2 col-md-4 col-sm-4 col-12 align-self-center mb-2 mb-md-0">
								<div class="logo py-3 py-lg-0">
							        <?php if ( has_custom_logo() ) : ?>
					            		<?php the_custom_logo(); ?>
						            <?php endif; ?>
					              	<?php $blog_info = get_bloginfo( 'name' ); ?>
										<?php if( get_option('cyber_security_services_logo_title',false) != 'off'){ ?>
							                <?php if ( ! empty( $blog_info ) ) : ?>
							                  	<?php if ( is_front_page() && is_home() ) : ?>
							                    	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							                  	<?php else : ?>
						                      		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						                  		<?php endif; ?>
							                <?php endif; ?>
										<?php } ?>
						                <?php
					                  		$description = get_bloginfo( 'description', 'display' );
						                  	if ( $description || is_customize_preview() ) :
						                ?>
										<?php if( get_option('cyber_security_services_logo_text',true) != 'off'){ ?>
						                  	<p class="site-description">
						                    	<?php echo esc_html($description); ?>
						                  	</p>
										<?php } ?>
					              	<?php endif; ?>
							    </div>
							</div>
							<div class="col-lg-6 col-md-2 col-sm-2 col-3 align-self-center">
								
									<div class="toggle-menu gb_menu text-center">
										<button onclick="cyber_security_services_gb_Menu_open()" class="gb_toggle p-2"><i class="<?php echo esc_attr(get_theme_mod('cyber_security_services_menu_icon','fas fa-bars')); ?>"></i></button>
									</div>
							
				   				<?php get_template_part('template-parts/navigation/navigation'); ?>
							</div>
							<div class="col-lg-1 col-md-2 col-sm-1 col-3 align-self-center">
								<div class="header-search">
	              					<div class="header-search-wrapper">
						                <span class="search-main">
						                    <i class="search-icon fas fa-search"></i>
						                </span>
						                <span class="search-close-icon"><i class="fas fa-xmark"></i>
						                </span>
						                <div class="search-form-main clearfix">
						                  <?php get_search_form(); ?>
						                </div>
	              					</div>
	            				</div>
							</div>
							<div class="col-lg-3 col-md-4 col-sm-5  col-6 align-self-center">
								<?php if( get_option('header_social_icon_enable',false) != 'off'){ ?>
									 <?php
												$cyber_security_services_header_facebook_target = esc_attr(get_option('cyber_security_services_header_facebook_target','true'));
									            $cyber_security_services_header_twt_target = esc_attr(get_option('cyber_security_services_header_twt_target','true'));
									            $cyber_security_services_header_linkedin_target = esc_attr(get_option('cyber_security_services_header_linkedin_target','true'));
									            $cyber_security_services_header_pinterest_target = esc_attr(get_option('cyber_security_services_header_pinterest_target','true'));
									            
			          							?> 
									<div class="linksbox text-md-end text-center">
										<?php if( get_theme_mod('cyber_security_services_facebook') != ''){ ?>
								            <a target="<?php echo $cyber_security_services_header_facebook_target !='off' ? '_blank' : '' ?>" href="<?php echo esc_url(get_theme_mod('cyber_security_services_facebook','')); ?>">
								              <i class="<?php echo esc_attr(get_theme_mod('cyber_security_services_facebook_icon','fab fa-facebook')); ?>"></i>
								            </a>
							          	<?php }?>
										<?php if( get_theme_mod('cyber_security_services_twitter') != ''){ ?>
								            <a target="<?php echo $cyber_security_services_header_twt_target !='off' ? '_blank' : '' ?>" href="<?php echo esc_url(get_theme_mod('cyber_security_services_twitter','')); ?>">
								              <i class="<?php echo esc_attr(get_theme_mod('cyber_security_services_twitter_icon','fab fa-x-twitter')); ?>"></i>
								            </a>
								        <?php }?>
							          	<?php if( get_theme_mod('cyber_security_services_linkedin') != ''){ ?>
								            <a target="<?php echo $cyber_security_services_header_linkedin_target !='off' ? '_blank' : '' ?>" href="<?php echo esc_url(get_theme_mod('cyber_security_services_linkedin','')); ?>">
								              <i class="<?php echo esc_attr(get_theme_mod('cyber_security_services_linkedin_icon','fab fa-linkedin')); ?>"></i>
								            </a>
							          	<?php }?>
									    <?php if( get_theme_mod('cyber_security_services_pinterest') != ''){ ?>
								            <a target="<?php echo $cyber_security_services_header_pinterest_target !='off' ? '_blank' : '' ?>" href="<?php echo esc_url(get_theme_mod('cyber_security_services_pinterest','')); ?>">
								              <i class="<?php echo esc_attr(get_theme_mod('cyber_security_services_pinterest_icon','fab fa-pinterest-p')); ?>"></i>
								            </a>
									    <?php }?>
									</div>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>