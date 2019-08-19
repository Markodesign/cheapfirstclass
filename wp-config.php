<?php


/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'admin_cheapfirst');
define('DB_USER', 'admin_db');
define('DB_PASSWORD', 'x61aowU92T');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('AUTH_KEY',         '>*+26,]#N(eA.:~/yxN4fCYd>ob4P2T$~V]EsJSnu2%]d+OFT7]+Xq#.9/z%YZng');
define('SECURE_AUTH_KEY',  'T^m<dV%A|@#v:*[/|X u#(+Ue=r! l4_ecxjlYl2()GQbuz|iG}e$}OK><ku*DBe');
define('LOGGED_IN_KEY',    'Rmt2L>QX2<%8wDTEf`c>v[@Z+X%, 2D3DdjJD08-y<1%Mlq8hyW$&{=]u-d_t+b%');
define('NONCE_KEY',        'h|9D%nC_Wk,WkIYce-LhIg2IEIx@(S[K<sZI9?-otkT8n}+s4U`cyv8isI43j3/l');
define('AUTH_SALT',        'eJ3QKb1,;EWIIM+M+*3Tl.->@dmc+/{93WkPRU5f(jv&d2^wF+x4: O8FK6@Ett}');
define('SECURE_AUTH_SALT', '$+}-J*A-(o^FQw3;7MPb.0SZ,^:x.+Dp5%hABx,|G~$EO1&9_n,ct<g$n~^K;%zH');
define('LOGGED_IN_SALT',   'Y2zvz|B>au)<.pw[ds1zb/ouEOUXFU1SYIVFoO6.~uQ `q~7&e$D6bB-}oP3-zSo');
define('NONCE_SALT',       '}}@8sb&1n!#v+ake2DY)gj6!Qx7Ysm+zU/*M=%MWo@@E|XIGA#y!hd!!D{B!GxbS');

$table_prefix  = 'woodsf54h00yeah_';
define('WPLANG', '');
define('FS_METHOD', 'direct');
define('WP_POST_REVISIONS', false );
define('AUTOSAVE_INTERVAL', 240 );

define('WP_DEBUG', false);

@ini_set('display_errors', 0);
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');
