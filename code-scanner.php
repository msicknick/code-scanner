<?php

/*
 *  Plugin Name:  Code Scanner
 *  Plugin URI:   https://github.com/msicknick/code-scanner/
 *  Description:  Scans WordPress plugin, theme, and core directories for malicious code injections.
 *  Version:      1.0.0
 *  Author:       Magda Sicknick
 *  Author URI:   https://www.msicknick.com/
 *  License:      GPL2
 *  License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 *  Text Domain:  code-scanner
 */

/**
 * Exit if accessed directly
 * @since 1.0.0
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * DEFINE PATHS
 */
define('CS_MS_PATH', plugin_dir_path(__FILE__));
define('CS_MS_VIEWS_PATH', CS_MS_PATH . 'views/');
define('CS_MS_INCLUDES_PATH', CS_MS_PATH . 'includes/');

/**
 * DEFINE URLS
 */
define('CS_MS_URL', plugin_dir_url(__FILE__));
define('CS_MS_JS_URL', CS_MS_URL . 'assets/js/');
define('CS_MS_CSS_URL', CS_MS_URL . 'assets/css/');
define('CS_MS_IMAGES_URL', CS_MS_URL . 'assets/images/');
define('CS_MS_GITHUB_URL', 'https://github.com/msicknick/');

/**
 * FUNCTIONS
 */
require_once(CS_MS_INCLUDES_PATH . 'code-scanner-functions.php');

/**
 * FRONT END
 */
require_once(CS_MS_INCLUDES_PATH . 'code-scanner.php');
if (is_admin()) {
    add_action('plugins_loaded', array('Code_Scanner', 'init'));
}


 