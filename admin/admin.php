<?php 
/**
 * Init Styles & scripts
 *
 * @return void
 */
function BESTOFBETS_PLUGIN_admin_styles_scripts() {

    wp_register_style( 'BESTOFBETS_PLUGIN-image-uplaoder', BESTOFBETS_PLUGIN_URL . 'admin/css/image-uploader.css', '', rand() );
    wp_enqueue_style( 'BESTOFBETS_PLUGIN-admin-style', BESTOFBETS_PLUGIN_URL . 'admin/css/admin.css', '', rand());
    wp_enqueue_style( 'bestofbets_horse_racing_api-custom-style', BESTOFBETS_PLUGIN_URL . 'admin/css/custom.css', '', rand());
    wp_enqueue_style( 'bestofbets_horse_racing_api-custom-responsive-style', BESTOFBETS_PLUGIN_URL . 'admin/css/custom-responsive.css', '', rand());

    wp_register_script( 'BESTOFBETS_PLUGIN-image-uploader', BESTOFBETS_PLUGIN_URL . 'admin/js/image-uploader.js', array('jquery'), rand(), true );
    wp_enqueue_script( 'BESTOFBETS_PLUGIN-admin-script', BESTOFBETS_PLUGIN_URL . 'admin/js/admin.js', array('jquery'), rand(), true );
    wp_enqueue_script( 'bestofbets_horse_racing_api-custom-script', BESTOFBETS_PLUGIN_URL . 'admin/js/custom.js', array('jquery'), rand(), true );

}
add_action( 'admin_enqueue_scripts', 'BESTOFBETS_PLUGIN_admin_styles_scripts' );
