<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'DNta<*aWX4,yRrIo`(@YpduM@$y@r2JVBAZ$^i}2Q#1O(#s[#6qY$HbJfJlS56[I');
define('SECURE_AUTH_KEY',  'Ox*&Yq&U|DJMQd8_d^bZuo1XScfGhaVg.Fy3IQHnPC 6A?;N}Ike,K1F9}YG?!*z');
define('LOGGED_IN_KEY',    'u$utBtAX5[uQ5]cuymj,Jn%pO36_f1d,0hB`>dIrggWBeBVIPh<:!Q7X .{b +O+');
define('NONCE_KEY',        ',z5n*^2FneP!)9&+|2,:b282)9v{$|:6d)kW.:`HW`7|_7tNtik?AV%^130]yX|L');
define('AUTH_SALT',        'i{iB2er3,nvn<t!H9WW*[!/&,gjC6H,_88?L|2aG7+;;^,,_1#}[l!T6;#GyO)-b');
define('SECURE_AUTH_SALT', '3Ggb-YH!(;u{!4U6 lm:Y)RGcS5 <FGrFi9~h875+sTJ$}[$zD2+eb#_K6S9;KI2');
define('LOGGED_IN_SALT',   'wah{mcxWTTiND> EIHw=U(?1KfjED_47G4Qba{:[a!0&58sGE*M^68<Z{P6Yz3!(');
define('NONCE_SALT',       '?*,a>QpHl+m@Vvzbe^knzFf[<LHYP#${E;w.&|qT$z+RW_RX],~G-}M)H!#MQrC:');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
