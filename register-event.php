<?php
/**
 * Register Custom Post Type: Event
 *
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 * @link https://wordpress.stackexchange.com/questions/43970/adding-menu-order-column-to-custom-post-type-admin-screen
 *
 * @since 1.0.0
 */

if( ! function_exists( 'register_epk_event' ) ) {
	/**
	 * Register CPT: Event
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function register_epk_event() {
		register_post_type( 'epk_event', array(
			'label'               => __( 'Events' ),
			'labels'  => array(
				'name'                  => _x( 'Events', 'Post type general name' ),
				'singular_name'         => _x( 'Event', 'Post type singular name' ),
				'menu_name'             => _x( 'Events', 'Admin Menu text' ),
				'name_admin_bar'        => _x( 'Event', 'Add New on Toolbar' ),
				'add_new'               => __( 'Add Event' ),
				'add_new_item'          => __( 'Add New' ),
				'new_item'              => __( 'New Event' ),
				'edit_item'             => __( 'Edit Event' ),
				'view_item'             => __( 'View Event' ),
				'all_items'             => __( 'All Events' ),
				'search_items'          => __( 'Search Events' ),
				'parent_item_colon'     => __( 'Parent Events:' ),
				'not_found'             => __( 'No Events found.' ),
				'not_found_in_trash'    => __( 'No Events found in Trash.' ),
				'featured_image'        => _x( 'Event Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3' ),
				'set_featured_image'    => _x( 'Set Event Image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3' ),
				'remove_featured_image' => _x( 'Remove Event Image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3' ),
				'use_featured_image'    => _x( 'Use as Event Image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3' ),
				'archives'              => _x( 'Events', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4' ),
				'insert_into_item'      => _x( 'Insert into Event', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4' ),
				'uploaded_to_this_item' => _x( 'Uploaded to this Event', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4' ),
				'filter_items_list'     => _x( 'Filter Events List', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4' ),
				'items_list_navigation' => _x( 'Events List Navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4' ),
				'items_list'            => _x( 'Events List', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4' ),
			),
			'public'              => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'has_archive'         => false,
			'menu_icon'           => 'dashicons-calendar-alt',
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => true,
			'query_var'           => true,
			'capability_type'     => 'post',
			'hierarchical'        => true,
			'menu_position'       => 57,
			'rewrite'             => array(
				'slug'         => _x( 'event', 'CPT permalink slug' ),
				'with_front'   => false,
				'ep_mask'      => EP_PERMALINK,
				'permastruct'  => '/event/%event_id%',
			),
			'supports' => array(
				'title',
				'thumbnail',
			)
		) );
	}
	add_action( 'init', 'register_epk_event' );
}

if( ! function_exists( 'custom_epk_event_permalink' ) ) {
	function custom_epk_event_permalink($permalink, $post) {
		/**
		 * Custom permalink for EPK Event Singles
		 *
		 * @since 1.0.0
		 *
		 * @return string
		 */
		if($post->post_type === 'epk_event') {
			$kebab_title = strtolower(str_replace(' ', '-', get_the_title( $post->ID )));
			$permalink = str_replace($kebab_title, $post->ID, $permalink);
		}
		return $permalink;
	}
	add_filter('post_type_link', 'custom_epk_event_permalink', 10, 2);
}

/* Admin Editor (All Events) */
if( ! function_exists( 'remove_epk_event_column_date' ) ) {
	function remove_epk_event_column_date($columns) {
		/**
		 * Remove Date Column
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		unset($columns['date']);
		return $columns;
	}
	add_filter( 'manage_edit-epk_event_columns', 'remove_epk_event_column_date' );
}

if( ! function_exists( 'add_epk_event_column_start' ) ) {
	function add_epk_event_column_start($epk_event_columns) {
		/**
		 * Add Start Column
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		$epk_event_columns['start'] = "Start";
		return $epk_event_columns;
	}
	add_action( 'manage_epk_event_posts_columns', 'add_epk_event_column_start' );
}

if( ! function_exists( 'show_epk_event_column_start' ) ) {
	function show_epk_event_column_start($name){
		/**
		 * Show Start Column Values
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		global $post;

		switch ($name) {
			case 'start':
				$start = $post->start;
				echo date('F j, Y @ g:ia', strtotime($start));;
				break;
			default:
				break;
		}
	}
	add_action( 'manage_epk_event_posts_custom_column', 'show_epk_event_column_start' );
}

if( ! function_exists( 'make_epk_event_column_sortable_start' ) ) {
	function make_epk_event_column_sortable_start($columns){
		/**
		 * Make Start Column Sortable
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		$columns['start'] = 'start';
		return $columns;
	}
	add_filter( 'manage_edit-epk_event_sortable_columns', 'make_epk_event_column_sortable_start' );
}

if( ! function_exists( 'epk_event_start_column_sort' ) ) {
	function epk_event_start_column_sort($query) {
		/**
		 * Sort by Start Column
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		if( ! is_admin() || ! $query->is_main_query() ) {
			return;
		}
	
		$orderby = $query->get( 'orderby' );
	
		if( $orderby === 'start' ) {
			$query->set( 'meta_key', 'start' );
			$query->set( 'orderby', 'meta_value' );
		}
	}
	add_action( 'pre_get_posts', 'epk_event_start_column_sort' );
}

if( ! function_exists( 'epk_event_default_sort' ) ) {
	function epk_event_default_sort($query) {
		/**
		 * Default Sort for EPK Events: By Start, ASC
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		if( is_admin() && $query->is_main_query() && $query->get( 'post_type' ) === 'epk_event' ) {
			if( ! isset($_GET['orderby']) || empty($_GET['orderby'] )) {
				$query->set( 'orderby', 'meta_value' );
				$query->set( 'meta_key', 'start' );
				$query->set( 'order', 'asc' );
			}
		}
	}
	add_action( 'pre_get_posts', 'epk_event_default_sort' );
}

if( ! function_exists( 'remove_publish_date_from_epk_events' ) ) {
	function remove_publish_date_from_epk_events() {
		/**
		 * Remove Date Column from EPK Events
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		global $typenow;

		if( $typenow === 'epk_event' ) {
			// remove the date (i.e., published) filter
			echo '<style>.alignleft.actions select[name="m"], #post-query-submit{display:none;}</style>';
		}
	}
	add_action( 'restrict_manage_posts', 'remove_publish_date_from_epk_events' );
}

if( ! function_exists( 'disable_yoast_columns_epk_events' ) ) {
	function disable_yoast_columns_epk_events( $yoast_columns ) {
		/**
		 * Remove Yoast Columns from EPK Events
		 *
		 * @since 1.0.0
		 *
		 * @return array
		 */
		global $pagenow;

		if( $pagenow === 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'epk_event' ) {
			return false;
		}

		return $yoast_columns;
	}
	add_filter( 'wpseo_use_page_analysis', 'disable_yoast_columns_epk_events' );
}