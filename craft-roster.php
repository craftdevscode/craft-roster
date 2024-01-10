<?php
/**
 * Plugin Name: Craft Roster
 * Description: Craft Roster: Stores user information for efficient roster management in WordPress.
 * Plugin URI: https://craftdevs.net/craft-roster
 * Author: craftdevs
 * Author URI: https://craftdevs.net/craft-roster
 * Version: 1.0.0
 * Requires at least: 5.0
 * Requires PHP: 7.4
 * Text Domain: craft-roster
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Ensure the script is not accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Make sure the same class is not loaded.
if ( ! class_exists( 'CraftRoster' ) ) {

	//require_once __DIR__ . '/vendor/autoload.php';

	/**
	 * Class CraftRoster
	 */
	final class CraftRoster {

		/**
		 * CraftRoster Version
		 *
		 * Holds the version of the plugin.
		 *
		 * @var string The plugin version.
		 */
		const VERSION = '1.0.0';

		/**
		 * The plugin path
		 *
		 * @var string
		 */
		public $plugin_path;

        /**
         * Initializes a singleton instances
         * @return false|CraftRoster
         */
        public static function init() {
            static $instance = false;
            if ( ! $instance ) {
                $instance = new self();
            }

            return $instance;
        }

		/**
		 * Constructor.
		 *
		 * Initialize the CraftRoster plugin
		 *
		 * @access public
		 */
		private function __construct() {

            register_activation_hook( __FILE__, [ $this, 'activate' ] );

			$this->define_constants(); // Define constants.

			$this->core_includes(); //Include the required files.

			add_action( 'init', [ $this, 'i18n' ] );
			add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );

		}

		/**
		 * Load Textdomain
		 *
		 * Load plugin localization files.
		 */
		public function i18n() {
			load_plugin_textdomain( 'craft-roster', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}

		/**
		 * Include Files
		 *
		 * Load core files required to run the plugin.
		 */
		public function core_includes() {

            // Functions
            // require_once __DIR__ . '/includes/functions.php';

			//Post Type
			require_once __DIR__ . '/includes/Admin/Post_Types.php';
		}

		/**
		 * Define constants
		 */
		public function define_constants() {
			define( 'CRAFTROSTER_VERSION', self::VERSION );
			define( 'CRAFTROSTER_FILE', __FILE__ );
			define( 'CRAFTROSTER_PATH', __DIR__ );
			define( 'CRAFTROSTER_URL', plugins_url( '', CRAFTROSTER_FILE ) );
			define( 'CRAFTROSTER_CSS', CRAFTROSTER_URL . '/assets/css' );
			define( 'CRAFTROSTER_JS', CRAFTROSTER_URL . '/assets/js' );
			define( 'CRAFTROSTER_IMG', CRAFTROSTER_URL . '/assets/images' );
			define( 'CRAFTROSTER_VEND', CRAFTROSTER_URL . '/assets/vendors' );
		}

		/**
		 * Initializes the plugin
		 * @return void
		 */
		public function init_plugin() {

			if ( is_admin() ) {
				new CraftRoster\Admin\Admin();
                new CraftRoster\Admin\Assets();
			} else {
				new CraftRoster\Public\Frontend();
                new CraftRoster\Public\Assets();
			}
            new CraftRoster\Admin\Post_Types();

		}

        
		/**
		 * Do stuff upon plugin activation
		 */
		public function activate() {
			//Insert the installation time into the database
			$installed = get_option( 'CraftRoster_installed' );
			if ( ! $installed ) {
				update_option( 'CraftRoster_installed', time() );
			}
			update_option( 'craft_roster_version', CRAFTROSTER_VERSION );
		}

		/**
		 * Get the plugin path.
		 *
		 * @return string
		 */
		public function plugin_path() {

			if ( $this->plugin_path ) {
				return $this->plugin_path;
			}

			return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );

		}


		/**
		 * Get the plugin url.
		 *
		 * @return string
		 */
		public function template_path() {

			return $this->plugin_path() . '/templates/';

		}
		
	}
}

/**
 * @return CraftRoster|false
 */
if ( ! function_exists( 'CraftRoster' ) ) {
	/**
	 * Load CraftRoster
	 *
	 * Main instance of CraftRoster
	 */
	function CraftRoster() {
		return CraftRoster::init();
	}

	// Kick of the plugin
	CraftRoster();
}

