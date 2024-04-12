<?php 

/**
 * Create Post Type
 */
add_action( 'init', 'create_post_type_bestofbets' );
function create_post_type_bestofbets() {
    register_post_type( 'bestofbets_post_type',
    array(
        'labels' => array(
            'name' => __( 'Horse Racing API Settings' ),
            'singular_name' => __( 'Horse Racing API Setting' )
        ),
    'public' => true,
    'has_archive' => true,
    'capability_type' => 'post',
    'capabilities' => array(
        'create_posts' => true,
        ),
            'map_meta_cap' => true,
            'menu_position ' => 1,
            'menu_icon'           => 'dashicons-rest-api',
        )
    );

    remove_post_type_support( 'bestofbets_post_type', 'editor' );
}




add_action( 'init', 'create_post_type_bestofbets2' );
function create_post_type_bestofbets2() {
        if(wp_count_posts( 'bestofbets_post_type' )->publish > 0){
            unregister_post_type('bestofbets_post_type');
            register_post_type( 'bestofbets_post_type',
                array(
                    'labels' => array(
                        'name' => __( 'Horse Racing API Settings' ),
                        'singular_name' => __( 'Horse Racing API Setting' )
                    ),
                'public' => true,
                'has_archive' => true,
                'capability_type' => 'post',
                'capabilities' => array(
                    'create_posts' => false,
                ),
                'map_meta_cap' => true,
                'menu_position ' => 1,
                'menu_icon'           => 'dashicons-rest-api',
                )
            );
        
            remove_post_type_support( 'create_post_type_bestofbets2', 'editor' );
        }

}