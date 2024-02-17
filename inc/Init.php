<?php
namespace MRWPDocker\Inc;
use MRWPDocker\Inc\Controllers\PostType;
// Unique Class name WPDocker
if (!class_exists('Init')) {
    class Init
    {
        public function __construct()
        {
            //add_action('init', [$this, 'init']);
            //$this->file_includes();
            new PostType();

        }
        
        // Initialize the plugin
        public function init() {
            //add_action( 'admin_init', [ $this,'rt_remove_metabox'] );
        }

        // Include necessary files
        // public function file_includes() {
        //     //new Masudrana\Wpdocker\PostType();
        //     new PostType();
        // }
    }
}
