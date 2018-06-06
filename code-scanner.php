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
 *  Text Domain:  cs
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
define('CS_PATH', plugin_dir_path(__FILE__));
define('CS_VIEWS_PATH', CS_PATH . 'views/');
define('CS_CLASSES_PATH', CS_PATH . 'includes/classes/');
define('CS_FUNCTIONS_PATH', CS_PATH . 'includes/functions/');

/**
 * DEFINE URLS
 */
define('CS_URL', plugin_dir_url(__FILE__));
define('CS_JS_URL', CS_URL . 'assets/js/');
define('CS_CSS_URL', CS_URL . 'assets/css/');
define('CS_IMAGES_URL', CS_URL . 'assets/images/');
define('CS_GITHUB_URL', 'https://github.com/msicknick/');

/**
 * FUNCTIONS
 */
require_once(CS_FUNCTIONS_PATH . 'helpers.php');

/**
 * FRONT END
 */
require_once(CS_CLASSES_PATH . 'code-scanner.php');
if (is_admin()) {
    add_action('plugins_loaded', array('Code_Scanner', 'init'));
}


 