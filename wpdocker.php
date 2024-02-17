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

if(! defined('ABSPATH')){
    die;
}

if(file_exists(dirname(__FILE__).'/vendor/autoload.php')){
    require_once dirname(__FILE__).'/vendor/autoload.php';
}

if(class_exists('MRWPDocker\\Inc\\Init')){
    new MRWPDocker\Inc\Init();
}



