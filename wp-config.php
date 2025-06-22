<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'kuzai' );

/** Database username */
define( 'DB_USER', 'wpuser' );

/** Database password */
define( 'DB_PASSWORD', 'krgv39EDdiiSUo9o@CY7rWX' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '6{@(CHM~O352^5QhcA>]<#Ms:#V umxncxXN#ozO28|-/tG:+Ih3;BuRhlk5SyLZ' );
define( 'SECURE_AUTH_KEY',  'n9B<TNN}Y-wDc[;g^yN;1(]}iF($BMrkY[<HS1iCYVctYC.{&S(I7+N-BZrsIecm' );
define( 'LOGGED_IN_KEY',    '$Bc!7T&(jE@pYScq^i:vzVL%8W861b>x9YB*BwyE9,fLHD9V7dzPsL+S_AQucF=2' );
define( 'NONCE_KEY',        'i# k5bk@,~(b*T_ZmxmU_GsYUQD[Zd==OoAW4JHz F^_:Tu#<&.BAvU(Xc5CslzI' );
define( 'AUTH_SALT',        'akIY-oTmKzW*?N8h^9yEQgrouzWh.r*`6I%XGzOr5Q?|]OrOuL%~wBb4In*e4# B' );
define( 'SECURE_AUTH_SALT', 'M<#UI{ky@:D(x/JJ{BNXy4[<2.ue<!Xh1Yh0nltd[[K0Nqy7.x6%:Ku867N^Rgc~' );
define( 'LOGGED_IN_SALT',   ';=R&{F3bB#9qNY%o9p8ypNqVK:bc>{^36R}Y%_2msc;|;Adk?;dvm48kKH7w zte' );
define( 'NONCE_SALT',       '5(v./o++[Z51.? a2mFW(|T<%o.Jeo~+ ;`B,+E{,SXd Yrn*fpgGy1-MU;RN?B`' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
