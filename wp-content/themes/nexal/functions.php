<?php

/**
 * Theme bootstrap functions.
 *
 * @package Nexal
 */

if ( ! function_exists( 'nexal_asset_url' ) ) {
    /**
     * Return nexal theme folder asset url
     * 
     * @param mixed $path
     * @return string
     */
    function nexal_asset_url( $path ) {
        return trailingslashit( get_stylesheet_directory_uri() ) . 'assets/' . $path;
    }

}

if ( ! function_exists( 'the_nexal_asset_url' ) ) {
    /**
     * Echo nexal theme folder asset url
     * 
     * @param mixed $path
     * @return void
     */
    function the_nexal_asset_url( $path ) {
        echo esc_url( nexal_asset_url( $path ) );
    }

}

if ( ! function_exists( 'nexal_register_block_pattern_category' ) ) {
    /**
     * Register nexal pattern category
     * 
     * @return void
     */
    function nexal_register_block_pattern_category() {
        if ( function_exists( 'register_block_pattern_category' ) ) {
            register_block_pattern_category( 'nexal', array(
                'label' => __( 'Nexal', 'nexal' )
            ) );
        }
    }

}

add_action( 'init', 'nexal_register_block_pattern_category' );

//
// Theme dashboard hook
//
if ( ! function_exists( 'nexal_theme_screenshot' ) ) {
    function nexal_theme_screenshot() {
        return trailingslashit( get_stylesheet_directory_uri() ) . 'screenshot.png';
    }

}
add_filter( 'plover_welcome_theme_screenshot', 'nexal_theme_screenshot' );

if ( ! function_exists( 'nexal_support_forum_url' ) ) {
    function nexal_support_forum_url() {
        return 'https://wordpress.org/support/theme/nexal/';
    }

}
add_filter( 'plover_theme_support_forum_url', 'nexal_support_forum_url' );

if ( ! function_exists( 'nexal_rate_us_url' ) ) {
    function nexal_rate_us_url() {
        return 'https://wordpress.org/support/theme/nexal/reviews/?rate=5#new-post';
    }

}
add_filter( 'plover_theme_rate_us_url', 'nexal_rate_us_url' );

if ( ! function_exists( 'nexal_default_color_mode' ) ) {
    function nexal_default_color_mode() {
        return 'dark';
    }

}
add_filter( 'plover_theme_default_color_mode', 'nexal_default_color_mode' );

// Incrémente les vues de la page d'accueil
function kuzai_count_homepage_views() {
    if ((is_front_page() || is_home()) && !is_admin()) {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/bot|crawl|slurp|spider/i', $user_agent)) return;

        $views = get_option('kuzai_homepage_views', 0);
        update_option('kuzai_homepage_views', ++$views);
    }
}
add_action('wp_head', 'kuzai_count_homepage_views');

// Affichage via shortcode
function kuzai_homepage_view_shortcode() {
    $views = get_option('kuzai_homepage_views', 0);
    return '<div class="kuzlab-home-views">👁️ ' . number_format_i18n($views) . ' AI AND ROBOTS LOOKED IN KUZAI</div>';
}
add_shortcode('count_views', 'kuzai_homepage_view_shortcode');

function kuzai_count_homepage_visits() {
    if (is_front_page() || is_home()) {
        $count = (int) get_option('kuzai_visit_count', 0);
        update_option('kuzai_visit_count', $count + 1);
    }
}
add_action('template_redirect', 'kuzai_count_homepage_visits');

function kuzai_display_visit_count() {
    $count = (int) get_option('kuzai_visit_count', 0);
    return "👁️  HUMAN WHO LOOKED IN KUZAI <strong>$count</strong>";
}
add_shortcode('kuzai_counter', 'kuzai_display_visit_count');
