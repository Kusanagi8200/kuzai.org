<?php

$cyber_security_services_custom_style= "";	

//Scroll-top-position 

$cyber_security_services_scroll_options = get_theme_mod( 'cyber_security_services_scroll_options','right_align');

if($cyber_security_services_scroll_options == 'right_align'){

$cyber_security_services_custom_style .='.scrollup{';

	$cyber_security_services_custom_style .='';

$cyber_security_services_custom_style .='}';

}else if($cyber_security_services_scroll_options == 'center_align'){

$cyber_security_services_custom_style .='.scrollup{';

	$cyber_security_services_custom_style .='right: 0; left:0; margin: 0 auto; top:85% !important';

$cyber_security_services_custom_style .='}';

}else if($cyber_security_services_scroll_options == 'left_align'){

$cyber_security_services_custom_style .='.scrollup{';

	$cyber_security_services_custom_style .='right: auto; left:5%; margin: 0 auto';

$cyber_security_services_custom_style .='}';
}

if (false === get_option('cyber_security_services_sticky_header')) {
	add_option('cyber_security_services_sticky_header', 'off');
}

// Define the custom CSS based on the 'cyber_security_services_sticky_header' option

if (get_option('cyber_security_services_sticky_header', 'off') !== 'on') {
    $cyber_security_services_custom_style .= '.menu_header.fixed {';
    $cyber_security_services_custom_style .= 'position: static;';
    $cyber_security_services_custom_style .= '}';
}

if (get_option('cyber_security_services_sticky_header', 'off') !== 'off') {
    $cyber_security_services_custom_style .= '.menu_header.fixed {';
    $cyber_security_services_custom_style .= 'position: fixed; background: var(--theme-primary-color);';
    $cyber_security_services_custom_style .= '}';

    $cyber_security_services_custom_style .= '.admin-bar .fixed {';
    $cyber_security_services_custom_style .= ' margin-top: 32px;';
    $cyber_security_services_custom_style .= '}';

}

// max-height

$cyber_security_services_logo_max_height = get_theme_mod('cyber_security_services_logo_max_height','100');

if($cyber_security_services_logo_max_height != false){

$cyber_security_services_custom_style .='.custom-logo-link img{';

	$cyber_security_services_custom_style .='max-height: '.esc_html($cyber_security_services_logo_max_height).'px;';

$cyber_security_services_custom_style .='}';
}

//text-transform

$cyber_security_services_text_transform = get_theme_mod( 'cyber_security_services_menu_text_transform','UPPERCASE');
if($cyber_security_services_text_transform == 'CAPITALISE'){

$cyber_security_services_custom_style .='nav#top_gb_menu ul li a{';

	$cyber_security_services_custom_style .='text-transform: capitalize ;';

$cyber_security_services_custom_style .='}';

}else if($cyber_security_services_text_transform == 'UPPERCASE'){

$cyber_security_services_custom_style .='nav#top_gb_menu ul li a{';

	$cyber_security_services_custom_style .='text-transform: uppercase ;';

$cyber_security_services_custom_style .='}';

}else if($cyber_security_services_text_transform == 'LOWERCASE'){

$cyber_security_services_custom_style .='nav#top_gb_menu ul li a{';

	$cyber_security_services_custom_style .='text-transform: lowercase ;';

$cyber_security_services_custom_style .='}';
}

//Slider-content-alignment

$cyber_security_services_slider_content_alignment = get_theme_mod( 'cyber_security_services_slider_content_alignment','LEFT-ALIGN');

if($cyber_security_services_slider_content_alignment == 'LEFT-ALIGN'){

$cyber_security_services_custom_style .='.slider-box{';

	$cyber_security_services_custom_style .='text-align:left;';

$cyber_security_services_custom_style .='}';


}else if($cyber_security_services_slider_content_alignment == 'CENTER-ALIGN'){

$cyber_security_services_custom_style .='.slider-box{';

	$cyber_security_services_custom_style .='text-align:center;';

$cyber_security_services_custom_style .='}';


}else if($cyber_security_services_slider_content_alignment == 'RIGHT-ALIGN'){

$cyber_security_services_custom_style .='.slider-box{';

	$cyber_security_services_custom_style .='text-align:right;';

$cyber_security_services_custom_style .='}';

}

// theme-Width
	
$cyber_security_services_theme_width = get_theme_mod( 'cyber_security_services_width_options','full_width');

if($cyber_security_services_theme_width == 'full_width'){

$cyber_security_services_custom_style .='body{';

	$cyber_security_services_custom_style .='max-width: 100%;';

$cyber_security_services_custom_style .='}';

}else if($cyber_security_services_theme_width == 'Container'){

$cyber_security_services_custom_style .='body{';

	$cyber_security_services_custom_style .='width: 100%; padding-right: 15px; padding-left: 15px;  margin-right: auto !important; margin-left: auto !important;';

$cyber_security_services_custom_style .='}';

$cyber_security_services_custom_style .='@media screen and (min-width: 601px){';

$cyber_security_services_custom_style .='body{';

    $cyber_security_services_custom_style .='max-width: 720px;';
    
$cyber_security_services_custom_style .='} }';

$cyber_security_services_custom_style .='@media screen and (min-width: 992px){';

$cyber_security_services_custom_style .='body{';

    $cyber_security_services_custom_style .='max-width: 960px;';
    
$cyber_security_services_custom_style .='} }';

$cyber_security_services_custom_style .='@media screen and (min-width: 1200px){';

$cyber_security_services_custom_style .='body{';

    $cyber_security_services_custom_style .='max-width: 1140px;';
    
$cyber_security_services_custom_style .='} }';

$cyber_security_services_custom_style .='@media screen and (min-width: 1400px){';

$cyber_security_services_custom_style .='body{';

    $cyber_security_services_custom_style .='max-width: 1320px;';
    
$cyber_security_services_custom_style .='} }';

$cyber_security_services_custom_style .='@media screen and (max-width:600px){';

$cyber_security_services_custom_style .='body{';

    $cyber_security_services_custom_style .='max-width: 100%; padding-right:0px; padding-left: 0px';
    
$cyber_security_services_custom_style .='} }';

}else if($cyber_security_services_theme_width == 'container_fluid'){

$cyber_security_services_custom_style .='body{';

	$cyber_security_services_custom_style .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';

$cyber_security_services_custom_style .='}';

$cyber_security_services_custom_style .='@media screen and (max-width:600px){';

$cyber_security_services_custom_style .='body{';

    $cyber_security_services_custom_style .='max-width: 100%; padding-right:0px; padding-left: 0px';
    
$cyber_security_services_custom_style .='} }';
}

//related products
if( get_option( 'cyber_security_services_related_product',true) != 'on') {

$cyber_security_services_custom_style .='.related.products{';

	$cyber_security_services_custom_style .='display: none;';
	
$cyber_security_services_custom_style .='}';
}

if( get_option( 'cyber_security_services_related_product',true) != 'off') {

$cyber_security_services_custom_style .='.related.products{';

	$cyber_security_services_custom_style .='display: block;';
	
$cyber_security_services_custom_style .='}';
}

// footer text alignment
$cyber_security_services_footer_content_alignment = get_theme_mod( 'cyber_security_services_footer_content_alignment','CENTER-ALIGN');

if($cyber_security_services_footer_content_alignment == 'LEFT-ALIGN'){

$cyber_security_services_custom_style .='.site-info{';

	$cyber_security_services_custom_style .='text-align:left; padding-left: 30px;';

$cyber_security_services_custom_style .='}';

$cyber_security_services_custom_style .='.site-info a{';

	$cyber_security_services_custom_style .='padding-left: 30px;';

$cyber_security_services_custom_style .='}';


}else if($cyber_security_services_footer_content_alignment == 'CENTER-ALIGN'){

$cyber_security_services_custom_style .='.site-info{';

	$cyber_security_services_custom_style .='text-align:center;';

$cyber_security_services_custom_style .='}';


}else if($cyber_security_services_footer_content_alignment == 'RIGHT-ALIGN'){

$cyber_security_services_custom_style .='.site-info{';

	$cyber_security_services_custom_style .='text-align:right; padding-right: 30px;';

$cyber_security_services_custom_style .='}';

$cyber_security_services_custom_style .='.site-info a{';

	$cyber_security_services_custom_style .='padding-right: 30px;';

$cyber_security_services_custom_style .='}';

}

// slider button
$mobile_button_setting = get_option('cyber_security_services_slider_button_mobile_show_hide', '1');
$main_button_setting = get_option('cyber_security_services_slider_button_show_hide', '1');

$cyber_security_services_custom_style .= '#slider .home-btn {';

if ($main_button_setting == 'off') {
    $cyber_security_services_custom_style .= 'display: none;';
}

$cyber_security_services_custom_style .= '}';

// Add media query for mobile devices
$cyber_security_services_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_button_setting == 'off' || $mobile_button_setting == 'off') {
    $cyber_security_services_custom_style .= '#slider .home-btn { display: none; }';
}
$cyber_security_services_custom_style .= '}';


// scroll button
$mobile_scroll_setting = get_option('cyber_security_services_scroll_enable_mobile', '1');
$main_scroll_setting = get_option('cyber_security_services_scroll_enable', '1');

$cyber_security_services_custom_style .= '.scrollup {';

if ($main_scroll_setting == 'off') {
    $cyber_security_services_custom_style .= 'display: none;';
}

$cyber_security_services_custom_style .= '}';

// Add media query for mobile devices
$cyber_security_services_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_scroll_setting == 'off' || $mobile_scroll_setting == 'off') {
    $cyber_security_services_custom_style .= '.scrollup { display: none; }';
}
$cyber_security_services_custom_style .= '}';

// theme breadcrumb
$mobile_breadcrumb_setting = get_option('cyber_security_services_enable_breadcrumb_mobile', '1');
$main_breadcrumb_setting = get_option('cyber_security_services_enable_breadcrumb', '1');

$cyber_security_services_custom_style .= '.archieve_breadcrumb {';

if ($main_breadcrumb_setting == 'off') {
    $cyber_security_services_custom_style .= 'display: none;';
}

$cyber_security_services_custom_style .= '}';

// Add media query for mobile devices
$cyber_security_services_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_breadcrumb_setting == 'off' || $mobile_breadcrumb_setting == 'off') {
    $cyber_security_services_custom_style .= '.archieve_breadcrumb { display: none; }';
}
$cyber_security_services_custom_style .= '}';

// single post and page breadcrumb
$mobile_single_breadcrumb_setting = get_option('cyber_security_services_single_enable_breadcrumb_mobile', '1');
$main_single_breadcrumb_setting = get_option('cyber_security_services_single_enable_breadcrumb', '1');

$cyber_security_services_custom_style .= '.single_breadcrumb {';

if ($main_single_breadcrumb_setting == 'off') {
    $cyber_security_services_custom_style .= 'display: none;';
}

$cyber_security_services_custom_style .= '}';

// Add media query for mobile devices
$cyber_security_services_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_single_breadcrumb_setting == 'off' || $mobile_single_breadcrumb_setting == 'off') {
    $cyber_security_services_custom_style .= '.single_breadcrumb { display: none; }';
}
$cyber_security_services_custom_style .= '}';

// woocommerce breadcrumb
$mobile_woo_breadcrumb_setting = get_option('cyber_security_services_woocommerce_enable_breadcrumb_mobile', '1');
$main_woo_breadcrumb_setting = get_option('cyber_security_services_woocommerce_enable_breadcrumb', '1');

$cyber_security_services_custom_style .= '.woocommerce-breadcrumb {';

if ($main_woo_breadcrumb_setting == 'off') {
    $cyber_security_services_custom_style .= 'display: none;';
}

$cyber_security_services_custom_style .= '}';

// Add media query for mobile devices
$cyber_security_services_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_woo_breadcrumb_setting == 'off' || $mobile_woo_breadcrumb_setting == 'off') {
    $cyber_security_services_custom_style .= '.woocommerce-breadcrumb { display: none; }';
}
$cyber_security_services_custom_style .= '}';


//colors
$color = get_theme_mod('cyber_security_services_primary_color', '#0fa6c0');
$color_secondary = get_theme_mod('cyber_security_services_secondary_color', '#2dc8dc');
$color_heading = get_theme_mod('cyber_security_services_heading_color', '#222222');
$color_text = get_theme_mod('cyber_security_services_text_color', '#63646d');
$color_fade = get_theme_mod('cyber_security_services_primary_fade', '#f2fafb');
$color_footer_bg = get_theme_mod('cyber_security_services_footer_bg', '#222222');
$color_post_bg = get_theme_mod('cyber_security_services_post_bg', '#ffffff');
$slider_overlay = get_theme_mod( 'cyber_security_services_slider_overlay','#222222');


$cyber_security_services_custom_style .= ":root {";
    $cyber_security_services_custom_style .= "--theme-primary-color: {$color};";
    $cyber_security_services_custom_style .= "--theme-secondary-color: {$color_secondary};";
    $cyber_security_services_custom_style .= "--theme-heading-color: {$color_heading};";
    $cyber_security_services_custom_style .= "--theme-text-color: {$color_text};";
    $cyber_security_services_custom_style .= "--theme-primary-fade: {$color_fade};";
    $cyber_security_services_custom_style .= "--theme-footer-color: {$color_footer_bg};";
    $cyber_security_services_custom_style .= "--post-bg-color: {$color_post_bg};";
    $cyber_security_services_custom_style .= "--slider-overlay: {$slider_overlay};";
$cyber_security_services_custom_style .= "}";

$cyber_security_services_slider_opacity = get_theme_mod( 'cyber_security_services_slider_opacity','0.5');

if($cyber_security_services_slider_opacity == '0'){
$cyber_security_services_custom_style .='.slide-box img {';
    $cyber_security_services_custom_style .='opacity: 0';
$cyber_security_services_custom_style .='}';

}else if($cyber_security_services_slider_opacity == '0.1'){
$cyber_security_services_custom_style .='.slide-box img {';
    $cyber_security_services_custom_style .='opacity: 0.1';
$cyber_security_services_custom_style .='}';

}else if($cyber_security_services_slider_opacity == '0.2'){
$cyber_security_services_custom_style .='.slide-box img {';
    $cyber_security_services_custom_style .='opacity: 0.2';
$cyber_security_services_custom_style .='}';

}else if($cyber_security_services_slider_opacity == '0.3'){
$cyber_security_services_custom_style .='.slide-box img {';
    $cyber_security_services_custom_style .='opacity: 0.3';
$cyber_security_services_custom_style .='}';

}else if($cyber_security_services_slider_opacity == '0.4'){
$cyber_security_services_custom_style .='.slide-box img {';
    $cyber_security_services_custom_style .='opacity: 0.4';
$cyber_security_services_custom_style .='}';

}else if($cyber_security_services_slider_opacity == '0.5'){
$cyber_security_services_custom_style .='.slide-box img {';
    $cyber_security_services_custom_style .='opacity: 0.5';
$cyber_security_services_custom_style .='}';

}else if($cyber_security_services_slider_opacity == '0.6'){
$cyber_security_services_custom_style .='.slide-box img {';
    $cyber_security_services_custom_style .='opacity: 0.6';
$cyber_security_services_custom_style .='}';

}else if($cyber_security_services_slider_opacity == '0.7'){
$cyber_security_services_custom_style .='.slide-box img {';
    $cyber_security_services_custom_style .='opacity: 0.7';
$cyber_security_services_custom_style .='}';

}else if($cyber_security_services_slider_opacity == '0.8'){
$cyber_security_services_custom_style .='.slide-box img {';
    $cyber_security_services_custom_style .='opacity: 0.8';
$cyber_security_services_custom_style .='}';

}
else if($cyber_security_services_slider_opacity == '0.9'){
$cyber_security_services_custom_style .='.slide-box img {';
    $cyber_security_services_custom_style .='opacity: 0.9';
$cyber_security_services_custom_style .='}';

}
else if($cyber_security_services_slider_opacity == '1'){
$cyber_security_services_custom_style .='.slide-box img {';
    $cyber_security_services_custom_style .='opacity: 1';
$cyber_security_services_custom_style .='}';

}

$cyber_security_services_slider_heading_color = get_theme_mod( 'cyber_security_services_slider_heading_color','#ffffff');
$cyber_security_services_custom_style .='h2.slider-title {';
$cyber_security_services_custom_style .='color: '.esc_attr($cyber_security_services_slider_heading_color).';';
$cyber_security_services_custom_style .='}';

$cyber_security_services_slider_excerpt_color = get_theme_mod( 'cyber_security_services_slider_excerpt_color','#a1b0d1');
$cyber_security_services_custom_style .='.slide-inner-box p {';
$cyber_security_services_custom_style .='color: '.esc_attr($cyber_security_services_slider_excerpt_color).';';
$cyber_security_services_custom_style .='}';

//-------------------title-font-size----//  
$cyber_security_services_site_title_fontsize = get_theme_mod('cyber_security_services_site_title_fontsize','25');

if($cyber_security_services_site_title_fontsize != false){

$cyber_security_services_custom_style .='.logo h1,.site-title,.site-title a,.logo h1 a{';

    $cyber_security_services_custom_style .='font-size: '.esc_html($cyber_security_services_site_title_fontsize).'px;';

$cyber_security_services_custom_style .='}';
}

//-------------------tagline-font-size----//  
$cyber_security_services_site_tagline_fontsize = get_theme_mod('cyber_security_services_site_tagline_fontsize','15');

if($cyber_security_services_site_tagline_fontsize != false){

$cyber_security_services_custom_style .='p.site-description{';

    $cyber_security_services_custom_style .='font-size: '.esc_html($cyber_security_services_site_tagline_fontsize).'px;';

$cyber_security_services_custom_style .='}';
}

//-------------------menu-font-size----//  
$cyber_security_services_menu_fontsize = get_theme_mod('cyber_security_services_menu_fontsize','14');

if($cyber_security_services_menu_fontsize != false){

$cyber_security_services_custom_style .='.gb_nav_menu li a{';

    $cyber_security_services_custom_style .='font-size: '.esc_html($cyber_security_services_menu_fontsize).'px;';

$cyber_security_services_custom_style .='}';
}