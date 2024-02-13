<?php
/**
 * Plugin Name:       WPDocker
 * Plugin URI:        https://www.softcoders.net/
 * Description:       Documentation and Knowledge Base plugin for WordPress.
 * Version:           1.0.0
 * Author:            Softcoders
 * Author URI:        https://www.softcoders.net/
 * Text Domain:       wpdocker
 * Domain Path:       /languages
 */
require_once __DIR__ . '/vendor/autoload.php';
use Masudrana\Wpdocker\PostType;
use Masudrana\Wpdocker\Admin\AdminSettings;
// Unique Class name WPDocker
if (!class_exists('WPDocker')) {
    class WPDocker
    {
        public function __construct()
        {
            add_action('init', [$this, 'init']);
            $this->file_includes();
            new AdminSettings();
        }
        
        // Initialize the plugin
        public function init() {
            add_action( 'admin_init', [ $this,'rt_remove_metabox'] );
        }

        // Include necessary files
        public function file_includes() {
            //new Masudrana\Wpdocker\PostType();
            new PostType();
        }

        // Remove the metabox containing the taxonomy from the right sidebar
        public function rt_remove_metabox() {
            if ( is_admin() ) {
                add_action( 'add_meta_boxes', [ $this, 'remove_taxonomy_metabox' ] );
            }
        }

        // Callback function to remove the taxonomy metabox
        public function remove_taxonomy_metabox() {
            remove_meta_box( 'wpdocker_docs_groupdiv', 'wpdocker_docs', 'side' );
        }
    }
    new WPDocker();
}


