<?php
namespace CraftRoster\Admin;


if (!defined('ABSPATH')) {
	exit;// Exit if accessed directly
}

class Post_Types {

	private static $instance = null;

	public function __construct() {

		// Register the posttype
		add_action('init', [$this, 'register_post_types_craft_roster']);

        // Admin Columns
        // add_filter('manage_company_posts_columns', [$this, 'company_columns']);
        // add_action('manage_company_posts_custom_column', [$this, 'company_custom_columns'], 10, 2);
	}


	public static function init() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	// Register the post type Craft Roster.
	public function register_post_types_craft_roster() {

		if (post_type_exists('craft_roster')) {
			return;
		}

		$labels = array(
			'name'                  => esc_html__( 'Craft Roster', 'craft_roster' ),
			'singular_name'         => esc_html__( 'Craft Roster', 'craft_roster' ),
			'add_new'               => esc_html__( 'Add New', 'craft_roster' ),
			'add_new_item'          => esc_html__( 'Add New Craft Roster', 'craft_roster' ),
			'edit_item'             => esc_html__( 'Edit Craft Roster', 'craft_roster' ),
			'new_item'              => esc_html__( 'New Craft Roster', 'craft_roster' ),
			'new_item_name'         => esc_html__( 'New Craft Roster Name', 'craft_roster' ),
			'all_items'             => esc_html__( 'All Craft Rosters', 'craft_roster' ),
			'view_item'             => esc_html__( 'View Craft Roster', 'craft_roster' ),
			'view_items'            => esc_html__( 'View Craft Rosters', 'craft_roster' ),
			'search_items'          => esc_html__( 'Search Craft Rosters', 'craft_roster' ),
			'not_found'             => esc_html__( 'No Craft Rosters found', 'craft_roster' ),
			'not_found_in_trash'    => esc_html__( 'No Craft Rosters found in Trash', 'craft_roster' ),
			'parent_item'           => esc_html__( 'Parent Craft Roster', 'craft_roster' ),
			'parent_item_colon'     => esc_html__( 'Parent Craft Roster:', 'craft_roster' ),
			'update_item'           => esc_html__( 'Update Craft Roster', 'craft_roster' ),
			'menu_name'             => esc_html__( 'craft_roster', 'craft_roster' ),
			'item_published'           => __( 'Craft Roster published.', 'craft_roster' ),
			'item_published_privately' => __( 'Craft Roster published privately.', 'craft_roster' ),
			'item_reverted_to_draft'   => __( 'Craft Roster reverted to draft.', 'craft_roster' ),
			'item_scheduled'           => __( 'Craft Roster scheduled.', 'craft_roster' ),
			'item_updated'             => __( 'Craft Roster updated.', 'craft_roster' ),
		);

		$supports = [ 'title', 'thumbnail', 'editor', 'excerpt', 'author', 'custom-fields', 'publicize' ];

		$args = array(
			'labels'                => $labels,
			'public'                => true,
			'publicly_queryable'    => true,
			'show_in_rest'          => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'craft_roster' ),
			'capability_type'       => 'post',
			'has_archive'           => true,
			'hierarchical'          => true,
			'map_meta_cap'          => true,
			'taxonomies'            => array(),
			'menu_position'         => 8,
			'supports'              => $supports,
			'yarpp_support'         => true,
			'menu_icon'             => 'dashicons-money',
			'show_admin_column'     => true,

		);

		register_post_type('craft_roster', $args); // Register the posttype `craft_roster`


		// Register post taxonomies Category
		register_taxonomy( 'craft_roster_cat', 'craft_roster', array(
			'public'                => true,
			'hierarchical'          => true,
            'show_ui'               => true,
			'show_admin_column'     => true,
            'show_in_nav_menus'     => true,
            'show_in_rest'          => true,
			'labels'                => array(
				'name'  => esc_html__( 'Categories', 'craft_roster'),
			)
		));


	}



    // Admin Columns
    // public function company_columns($columns) {

    //     if (empty($columns) && !is_array($columns)) {
    //         $columns = [];
    //     }

    //     unset($columns['cb'], $columns['title'], $columns['date'], $columns['author'], $columns['taxonomy-company_cat']);

    //     $show_columns = [];
    //     $show_columns['cb'] = '<input type="checkbox" />';
    //     $show_columns['title'] = esc_html__('Title', 'craft_roster');
    //     $show_columns['taxonomy-company_cat'] = esc_html__('Categories', 'craft_roster');
    //     $show_columns['author'] = esc_html__('Author', 'craft_roster');
    //     $show_columns['date'] = esc_html__('Date', 'craft_roster');

    //     return array_merge($show_columns, $columns);

    // }


    // Custom Columns Content
    // public function company_custom_columns($column, $post_id)
    // {
    //     switch ($column) {
    //         case 'taxonomy-company_cat':
    //             echo get_the_term_list($post_id, 'company_cat', '', ', ', '');
    //             break;
    //     }
    // }

}