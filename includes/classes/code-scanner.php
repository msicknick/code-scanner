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
            // Settings link
            add_filter( "plugin_action_links_" . plugin_basename( CS_PATH . 'code-scanner.php' ), array( $this, 'add_settings_link' ) );

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
                wp_enqueue_style($this->plugin_slug . '-admin-styles', CS_CSS_URL . 'admin.css', array(), self::VERSION);
                wp_enqueue_style($this->plugin_slug . '-fontawesome', CS_CSS_URL . 'font-awesome.min.css', array(), self::VERSION);
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
                wp_enqueue_script($this->plugin_slug . '-admin-script', CS_JS_URL . 'admin.js', array(), self::VERSION);
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
         * Add link in Plugins screen
         *
         * @since 1.0.0
         */
        public function add_settings_link($links) {
            $settings_link = '<a href="' . esc_url(get_admin_url(null, 'tools.php?page=code-scanner')) . '">' . "Open Scanner" . '</a>';
            array_unshift($links, $settings_link);
            return $links;
        }

        /**
         * Load settings page
         *
         * @since 1.0.0
         */
        public function load_admin_page() {
            include_once(CS_VIEWS_PATH . 'admin.php');
        }

    }

    Code_Scanner::init();
}