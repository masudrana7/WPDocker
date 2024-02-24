<?php
namespace MRWPDocker\Inc;
use MRWPDocker\Inc\Controllers\Admin\AddPostType;
use MRWPDocker\Inc\Controllers\Admin\PostSettings;
use MRWPDocker\Inc\Controllers\Admin\AddPostMeta;
// Unique Class name WPDocker
if (!class_exists('Init')) {
    class Init
    {
        public function __construct()
        {
            new PostSettings();
            new AddPostType();
            new AddPostMeta();
        }
    }
}
