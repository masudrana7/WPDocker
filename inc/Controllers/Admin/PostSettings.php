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
            add_filter('manage_wpdocker_docs_posts_columns', [ $this, 'manage_wpdocker_docs_posts_id']);
            add_filter('manage_wpdocker_docs_posts_columns', [ $this, 'manage_wpdocker_docs_posts_columns']);
            add_filter('manage_wpdocker_docs_posts_columns', [ $this, 'add_wpdocker_docs_view_count']);
            add_filter( 'manage_edit-wpdocker_docs_sortable_columns', [ $this,'manage_id_sortable_columns'] );
            add_action( 'manage_wpdocker_docs_posts_custom_column', [ $this, 'manage_wpdocker_docs_posts_custom_id'], 10, 2);
            add_action( 'manage_wpdocker_docs_posts_custom_column', [ $this, 'manage_wpdocker_docs_posts_custom_column'], 10, 2);
            add_action( 'manage_wpdocker_docs_posts_custom_column', [ $this, 'manage_wpdocker_docs_posts_view_column'], 10, 2);
            add_action('wp_head', [ $this, 'count_view']);
        }

        public function count_view(){
            if(is_single()){
                $view_count = get_post_meta( get_the_ID(),'view_count', true );
                $view_count = $view_count ? $view_count : 0;
                $view_count++;
                update_post_meta(get_the_ID(), 'view_count', $view_count);
            }
        }

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

        function manage_id_sortable_columns($columns) {
            $columns['id'] = __('ID', 'wpdocker');
             $columns['view_count'] = __('View Count', 'wpdocker');
            return $columns;
        }

        public function manage_wpdocker_docs_posts_custom_id( $column, $post_id ){
            if($column == 'id'){
                echo $post_id;
            }
        }

        public function manage_wpdocker_docs_posts_id ( $columns ) {
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

        public function manage_wpdocker_docs_posts_columns ( $columns ){
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

        public function manage_wpdocker_docs_posts_custom_column($column, $post_id){
            if($column == 'thumbnail'){
                echo get_the_post_thumbnail($post_id, [ 50,50]);
            } 
        }
    }

