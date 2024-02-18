<?php
namespace MRWPDocker\Inc\Controllers\Admin;
 class AddPostType{
    public function __construct(){
        add_action('init', [$this, 'init']);
    }
    public function init(){
        $this->register_dosc_cpt();
		$this->register_docs_taxonomy();
		$this->register_group_taxonomy();
    }
	public function register_docs_taxonomy(){
		register_taxonomy("category","wpdocker_docs", [
			"label"=> esc_html__("Docs Category","wpdocker"),
			'hierarchical' => true,
            'rewrite' => ['slug' => 'wpdocker_category'],
		]);
	}
	public function register_group_taxonomy(){
		register_taxonomy("group","wpdocker_docs", [
			"label"=> esc_html__("Docs Group","wpdocker"),
			'hierarchical' => true,
            'rewrite' => ['slug' => 'wpdocker_group'],
		]);
	}
    public function register_dosc_cpt() {
		$labels = [
			'name'               => _x( 'Docs', 'Post Type General Name', 'wpdocker' ),
			'singular_name'      => _x( 'Doc', 'Post Type Singular Name', 'wpdocker' ),
			'menu_name'          => __( 'WPDocker', 'wpdocker' ),
			'parent_item_colon'  => __( 'Parent Doc', 'wpdocker' ),
			'all_items'          => __( 'All Docs', 'wpdocker' ),
			'view_item'          => __( 'View Doc', 'wpdocker' ),
			'add_new_item'       => __( 'Add Doc', 'wpdocker' ),
			'add_new'            => __( 'Add New Doc', 'wpdocker' ),
			'edit_item'          => __( 'Edit Doc', 'wpdocker' ),
			'update_item'        => __( 'Update Doc', 'wpdocker' ),
			'search_items'       => __( 'Search Doc', 'wpdocker' ),
			'not_found'          => __( 'Not Doc found', 'wpdocker' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'wpdocker' ),
		];
		$args = [
			'label'               => esc_html__('Docs', "wpdocker"),
			'labels'              => $labels,
			'supports'            => [ 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes', 'comments', 'author', 'blocks' ],
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_icon'           => 'dashicons-book',
			'can_export'          => true,
			'has_archive'         => 'Docs',
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_in_rest'        => true,
			"rewrite"             => ["slug"  => "wpdocker_docs", "with_front" => true],
			"query_var"           => true,
			'map_meta_cap'        => true,
			"show_in_graphql"     => false,
		];
		register_post_type("wpdocker_docs", $args);
	}
}
