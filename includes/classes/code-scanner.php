<?php

if (!class_exists('Code_Scanner')) {

    class Code_Scanner {

        const VERSION = '1.0.0';

        protected $plugin_slug;
        protected $plugin_basename;
        protected $home_path = null;
        protected $plugin_screen_hook_suffix = null;
        protected $plugins_root_dir = null;
        protected $themes_root_dir = null;
        protected $wp_root_dir = null;
        protected $code_injections = array();
        protected static $instance = null;

        public function __construct() {
            $this->plugin_slug = "code-scanner";
            $this->plugin_basename = plugin_basename($this->plugin_slug . '.php');

            $this->home_path = ABSPATH;
            $this->plugins_root_dir = $this->home_path . 'wp-content/plugins';
            $this->themes_root_dir = $this->home_path . 'wp-content/themes';
            $this->wp_root_dir = $this->home_path;

            $this->code_injections = array("\$_REQUEST['password']", "wp-tmp.php", "change_domain", "\$wp_auth_key");

            // Load plugin menu
            add_action('admin_menu', array($this, 'add_plugin_menu'));

            // Load admin style sheet and JavaScript.
            add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));
            add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        }

        /**
         * Get instance of class
         * 
         * @since 1.0.0
         */
        public static function get_instance() {
            if (null == self::$instance) {
                self::$instance = new self;
            }

            return self::$instance;
        }

        /**
         * Initialize class
         *
         * @since 1.0.0
         */
        public function init() {
            self::get_instance();
        }

        /**
         * Load CSS files
         *
         * @since 1.0.0
         */
        public function enqueue_admin_styles() {
            if (!isset($this->plugin_screen_hook_suffix)) {
                return;
            }

            $screen = get_current_screen();
            if ($this->plugin_screen_hook_suffix == $screen->id) {
                wp_enqueue_style($this->plugin_slug . '-admin-styles', CS_CSS_URL . 'admin.css', array(), Code_Scanner::VERSION);
                wp_enqueue_style($this->plugin_slug . '-fontawesome', CS_CSS_URL . 'font-awesome.min.css', array(), Code_Scanner::VERSION);
            }
        }

        /**
         * Load JS files
         *
         * @since 1.0.0
         */
        public function enqueue_admin_scripts() {
            if (!isset($this->plugin_screen_hook_suffix)) {
                return;
            }

            $screen = get_current_screen();
            if ($this->plugin_screen_hook_suffix == $screen->id) {
                wp_enqueue_script($this->plugin_slug . '-admin-script', CS_JS_URL . 'admin.js', array(), Code_Scanner::VERSION);
            }
        }

        /**
         * Add plugin in Tools menu
         *
         * @since 1.0.0
         */
        public function add_plugin_menu() {
            $this->plugin_screen_hook_suffix = add_management_page(
                    __('Code Scanner', $this->plugin_slug), __('Code Scanner', $this->plugin_slug), 'manage_options', $this->plugin_slug, array($this, 'load_admin_page')
            );
        }

        /**
         * Load settings page
         *
         * @since 1.0.0
         */
        public function load_admin_page() {
            include_once(CS_VIEWS_PATH . 'admin.php');
        }
        
        /**
         * Load result html
         * 
         * @since 1.0.0
         */
        
        public function load_result($dir_type) {
        /*
         * $type: theme, plugin, core
         */

            switch ($dir_type) {
                case "theme":
                    $scan_results = cs_scan_directory($this->themes_root_dir, $this->code_injections);
                    break;
                case "plugin":
                    $scan_results = cs_scan_directory($this->plugins_root_dir, $this->code_injections);
                    break;
                case "core":
                    $scan_results = cs_scan_directory($this->wp_root_dir, $this->code_injections);
                    break;
            }

                $directories = $scan_results['directories'];

            if ($scan_results['file_error_count'] > 0) { ?>
                <div class="cs-error-count">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Possible malicious code found in <?php echo $scan_results['file_error_count']; ?> files (<?php echo $scan_results['dir_error_count']; ?> directories).
                </div> 
            <?php } else { ?>
                <div class="cs-no-errors">
                    <i class="fa fa-check-circle" aria-hidden="true"></i> No errors were found in this directory.
                </div> 
            <?php } ?>  

                <?php foreach ($directories as $directory => $files) { ?>
                    <div class='cs-directory-container'>
                        <div class='cs-directory' onclick="cs_showHideSlide('spn-<?php echo $directory; ?>', 'div-<?php echo $directory; ?>');"><i class='fa fa-folder-open-o' aria-hidden='true' style='margin-right:10px;'></i><?php echo $directory; ?>
                            <span class='cs-toggle-button dashicons dashicons-arrow-up' id='<?php echo "spn-" . $directory; ?>'></span>
                        </div>
                        <div style="display:none;" id='div-<?php echo $directory; ?>'>
                            <?php
                            foreach ($files AS $file => $errors) {
                                $filename = substr($file, strrpos($file, '/') + 1);
                                ?>
                                <div class='cs-file-container'>                    
                                    <div class='cs-file' onclick="cs_showHideSlide(<?php echo "'spn-" . $directory . "-" . str_replace(".php", "", $filename) . "', 'div-" . $directory . "-" . str_replace(".php", "", $filename) . "'"; ?>);">
                                        <i class='fa fa-file-o' aria-hidden='true' style='margin-right:10px;'></i><b><?php echo $filename; ?></b>
                                        <?php if($dir_type != 'core') { ?>
                                        <span style='margin-left:5px;font-size:13px;'><a href='#' onclick="window.open('<?php echo cs_get_edit_link($dir_type, $directory, $filename); ?>');event.stopPropagation();">Edit</a></span>
                                        <?php } ?>
                                        <span class='cs-toggle-button dashicons dashicons-arrow-down' id='<?php echo "spn-" . $directory . "-" . str_replace(".php", "", $filename); ?>'></span>
                                    </div>
                                    <div class='cs-lines-container' id='<?php echo "div-" . $directory . "-" . str_replace(".php", "", $filename); ?>'>
                                        <?php foreach ($errors AS $error) { ?>
                                            <div class='cs-line-container'>
                                                <div class='cs-line-index'><?php echo $error['line_index']; ?></div>
                                                <div class='cs-line'><?php echo preg_replace("/(" . preg_quote($error['injection']) . ")/", "<span class=\"cs-line-injection\">$1</span>", $error['line']); ?></div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } 
        } 

    }

    Code_Scanner::init();
}