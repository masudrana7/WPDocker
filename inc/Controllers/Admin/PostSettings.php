<?php
    namespace MRWPDocker\Inc\Controllers\Admin;
    if ( ! defined( 'ABSPATH' ) ) {
        exit( 'This script cannot be accessed directly.' );
    }
    
    class PostSettings {
        public function __construct() {
            add_action('init', array( $this,'init') );
        }

        public function init(){
            // Manage Custom Column Id
            add_filter('manage_wpdocker_docs_posts_columns', [ $this, 'add_wpdocker_docs_posts_id']);
            add_action( 'manage_wpdocker_docs_posts_custom_column', [ $this, 'manage_wpdocker_docs_posts_custom_id'], 10, 2);

            // Manage Custom Column Id Sortable
            add_filter( 'manage_edit-wpdocker_docs_sortable_columns', [ $this,'manage_id_sortable_columns'] );

            // Manage Custom Column  Thumbnails
            add_filter('manage_wpdocker_docs_posts_columns', [ $this, 'add_wpdocker_docs_thumbnail']);
            add_action( 'manage_wpdocker_docs_posts_custom_column', [ $this, 'manage_wpdocker_docs_thumbnail_column'], 10, 2);

            // Manage Custom Column  View Count
            add_filter('manage_wpdocker_docs_posts_columns', [ $this, 'add_wpdocker_docs_view_count']);
            add_action( 'manage_wpdocker_docs_posts_custom_column', [ $this, 'manage_wpdocker_docs_posts_view_column'], 10, 2);

            // WP Head View Post Column
            add_action('wp_head', [ $this, 'count_view']);

            // Display View Count in the content
            add_filter('the_content', [ $this, 'display_view_count_content'], 999);
            
        }


        // Manage Custom Column Id
        public function manage_wpdocker_docs_posts_custom_id( $column, $post_id ){
            if($column == 'id'){
                echo $post_id;
            }
        }

        public function add_wpdocker_docs_posts_id ( $columns ) {
            $new_columns = [];
            foreach ( $columns as $key => $value){
                if( $key == 'cb'){
                    $new_columns[ $key] = $value;
                    $new_columns['id'] = __('ID', 'wpdocker');
                } else{
                     $new_columns[ $key] = $value;
                }
            }
            return $new_columns;
        }

        // Manage Custom Column Id Sortable
        function manage_id_sortable_columns($columns) {
            $columns['id'] = __('ID', 'wpdocker');
             $columns['view_count'] = __('View Count', 'wpdocker');
            return $columns;
        }

        // Manage Custom Column  Thumbnails
        public function manage_wpdocker_docs_thumbnail_column($column, $post_id){
            if($column == 'thumbnail'){
                echo get_the_post_thumbnail($post_id, [ 50,50]);
            } 
        }

        public function add_wpdocker_docs_thumbnail ( $columns ){
            $new_columns = [];
            foreach ( $columns as $key => $value ) {
                if( $key == 'title'){
                    $new_columns[ $key] = $value;
                    $new_columns[ 'thumbnail' ] = __('Thumbnail', 'wpdocker');
                }else{
                    $new_columns[ $key] = $value;
                }
            }
            return $new_columns;
        }

        // Manage Custom Column  View Count
        public function manage_wpdocker_docs_posts_view_column( $column, $post_id ) {
            if( $column == 'view_count'){
                $view_count = get_post_meta( $post_id,'view_count', true );
                $view_count = $view_count ? $view_count: 0;
                echo $view_count;
            }
        }
        
        public function add_wpdocker_docs_view_count( $columns){
            $columns[ 'view_count'] = __('View Cound','wpdocker');
            return $columns;
        }

        // WP Head View Post Column
        public function count_view(){
            if(is_single()){
                $view_count = get_post_meta( get_the_ID(),'view_count', true );
                $view_count = $view_count ? $view_count : 0;
                $view_count++;
                update_post_meta(get_the_ID(), 'view_count', $view_count);
            }
        }
        // View Post Count in frontend
        public function display_view_count_content($content){
            if(is_single()){
                $id = get_the_ID();
                $view_count = get_post_meta( $id,'view_count', true );
                $view_count = $view_count ? $view_count : 0;
                $custom_content  = '<div style = "padding: 12px 20px 14px; border: 1px solid #ddd;">';
                $custom_content .= '<p style = "margin: 0">'.__('Total View:', 'wpdocker').' '.$view_count.'</p>';
                $custom_content .= '</div>';
                return $content . $custom_content;
            }

        }
    }

