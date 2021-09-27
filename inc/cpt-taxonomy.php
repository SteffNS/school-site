<?php

function school_site_register_custom_post_types() {
        // Register Staff
        $labels = array(
            'name'                  => _x( 'Staff', 'post type general name' ),
            'singular_name'         => _x( 'Staff', 'post type singular name'),
            'menu_name'             => _x( 'Staff', 'admin menu' ),
            'name_admin_bar'        => _x( 'Staff', 'add new on admin bar' ),
            'add_new'               => _x( 'Add New', 'staff' ),
            'add_new_item'          => __( 'Add New Staff' ),
            'new_item'              => __( 'New Staff' ),
            'edit_item'             => __( 'Edit Staff' ),
            'view_item'             => __( 'View Staff' ),
            'all_items'             => __( 'All Staff' ),
            'search_items'          => __( 'Search Staff' ),
            'parent_item_colon'     => __( 'Parent Staff:' ),
            'not_found'             => __( 'No staff found.' ),
            'not_found_in_trash'    => __( 'No staff found in Trash.' ),
            'archives'              => __( 'Staff Archives'),
            'insert_into_item'      => __( 'Insert into staff'),
            'uploaded_to_this_item' => __( 'Uploaded to this staff'),
            'filter_item_list'      => __( 'Filter staff list'),
            'items_list_navigation' => __( 'Staff list navigation'),
            'items_list'            => __( 'Staff list'),
            'featured_image'        => __( 'Staff featured image'),
            'set_featured_image'    => __( 'Set staff featured image'),
            'remove_featured_image' => __( 'Remove staff featured image'),
            'use_featured_image'    => __( 'Use as featured image'),
        );
    
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => true,
            'show_in_admin_bar'  => true,
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'staff' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-universal-access',
            'supports'           => array( 'title'),
        );
        register_post_type( 'school_site_staff', $args );

        // Register Students
        $labels = array(
            'name'                  => _x( 'Students', 'post type general name' ),
            'singular_name'         => _x( 'Students', 'post type singular name'),
            'menu_name'             => _x( 'Students', 'admin menu' ),
            'name_admin_bar'        => _x( 'Students', 'add new on admin bar' ),
            'add_new'               => _x( 'Add New', 'student' ),
            'add_new_item'          => __( 'Add New Students' ),
            'new_item'              => __( 'New Student' ),
            'edit_item'             => __( 'Edit Students' ),
            'view_item'             => __( 'View Students' ),
            'all_items'             => __( 'All Students' ),
            'search_items'          => __( 'Search Students' ),
            'parent_item_colon'     => __( 'Parent Student:' ),
            'not_found'             => __( 'No students found.' ),
            'not_found_in_trash'    => __( 'No students found in Trash.' ),
            'archives'              => __( 'Student Archives'),
            'insert_into_item'      => __( 'Insert into student'),
            'uploaded_to_this_item' => __( 'Uploaded to this student'),
            'filter_item_list'      => __( 'Filter student list'),
            'items_list_navigation' => __( 'Student list navigation'),
            'items_list'            => __( 'Student list'),
            'featured_image'        => __( 'Student featured image'),
            'set_featured_image'    => __( 'Set student featured image'),
            'remove_featured_image' => __( 'Remove student featured image'),
            'use_featured_image'    => __( 'Use as featured image'),
        );
    
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => true,
            'show_in_admin_bar'  => true,
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'student' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-groups',
            'supports'           => array( 'title', 'editor', 'thumbnail'),
            'template'           => array( array( 'core/paragraph',), array('core/button', ) ),
            'template_lock'      => 'all',
        );
        register_post_type( 'school_site_student', $args );

}
add_action( 'init', 'school_site_register_custom_post_types' );

//Taxonomies
function school_site_register_taxonomies() {
    //Faculty Taxonomy
    $labels = array(
        'name'              => _x( 'Faculty Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Faculty Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Faculty Categories' ),
        'all_items'         => __( 'All Faculty Category' ),
        'parent_item'       => __( 'Parent Faculty Category' ),
        'parent_item_colon' => __( 'Parent Faculty Category:' ),
        'edit_item'         => __( 'Edit Faculty Category' ),
        'view_item'         => __( 'View Faculty Category' ),
        'update_item'       => __( 'Update Faculty Category' ),
        'add_new_item'      => __( 'Add New Faculty Category' ),
        'new_item_name'     => __( 'New Faculty Category Name' ),
        'menu_name'         => __( 'Faculty Category' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'faculty-categories' ),
    );
    register_taxonomy( 'school-site-faculty-category', array( 'school_site_staff' ), $args );

    //Administrative Taxonomy
    $labels = array(
        'name'              => _x( 'Admin Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Admin Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Admin Categories' ),
        'all_items'         => __( 'All Admin Category' ),
        'parent_item'       => __( 'Parent Admin Category' ),
        'parent_item_colon' => __( 'Parent Admin Category:' ),
        'edit_item'         => __( 'Edit Admin Category' ),
        'view_item'         => __( 'View Admin Category' ),
        'update_item'       => __( 'Update Admin Category' ),
        'add_new_item'      => __( 'Add New Admin Category' ),
        'new_item_name'     => __( 'New Admin Category Name' ),
        'menu_name'         => __( 'Admin Category' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'admin-categories' ),
    );
    register_taxonomy( 'school-site-admin-category', array( 'school_site_staff' ), $args );

    //Student Type
    $labels = array(
        'name'              => _x( 'Student Type Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Student Type Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Student Type Categories' ),
        'all_items'         => __( 'All Student Type Category' ),
        'parent_item'       => __( 'Parent Student Type Category' ),
        'parent_item_colon' => __( 'Parent Student Type Category:' ),
        'edit_item'         => __( 'Edit Student Type Category' ),
        'view_item'         => __( 'View Student Type Category' ),
        'update_item'       => __( 'Update Student Type Category' ),
        'add_new_item'      => __( 'Add New Student Type Category' ),
        'new_item_name'     => __( 'New Student Type Category Name' ),
        'menu_name'         => __( 'Student Type Category' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'student-type-categories' ),
    );
    register_taxonomy( 'school-site-student-type', array( 'school_site_student' ), $args );

}
add_action( 'init', 'school_site_register_taxonomies' );

function school_site_rewrite_flush() {
    school_site_register_custom_post_types();
    school_site_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'school_site_rewrite_flush' );