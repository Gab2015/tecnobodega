<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'tecnobd');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'tecnousuario');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'Tecnobodega2017');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'Ob;lQW+mkLWz yH;%`OMkcthg=QZX.X_`t,UCk%}q ^Kn>JvbQK&3jyEUK=$Ag,y'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', 'n&04|eMaA4l16v%BkdkXq(vtKR+;~)h7x^bD[?m2Ymzm3p}|{K8$^%2T|0fZf;YO'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', 'kmR8Z9zD,:P [AW_q+b@tR5`F7qXtO10iJszdfn9WM-7&+Q,[b;td}3`Dp5A>QJ$'); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', ']Vg Y!IG?OsUTa2e{ip`WkUqSltUol-Jl;;,k$k-gF3qr+TVzVV|UQWaS|V%(C]('); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', 'kf2L%ks()r|R^RKbN1~rQ`q[9%=X-Jyn{Jt@J_hyBI}35,Q{EPVkGqhDf0oXEk-s'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', 'pd^pK!$5h+W7pkI$DvGtt |(X8e<VRVq8_d$_wHl9$/$E .g*_:??T A[1WAErH:'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', 'T?le<,m||+UiOoq1*tKg;JBSMjpb*r:3w7m%%uu#M93)@#A^_}T4QB8bf/DP]d|:'); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', 'Hn~[.OiIdf|u>vb6tAnViT__}NvT<a!=[Q??S+MpQ<Z7a0:Ao~5Z7TE%)!@!!3]w'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'red_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

