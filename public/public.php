<?php 
/**
 * Init Styles & scripts
 */
function BESTOFBETS_PLUGIN_public_styles_scripts() {

    wp_enqueue_style( 'bestofbets_horse_racing_api-flags-style', BESTOFBETS_PLUGIN_URL . 'public/css/flags/freakflags.css', '', rand());
    wp_enqueue_style( 'bestofbets_horse_racing_api-bootstrap-style', BESTOFBETS_PLUGIN_URL . 'public/css/bootstrap-min.css', '', rand());
    wp_enqueue_style( 'bestofbets_horse_racing_api-all-race-cards-style', BESTOFBETS_PLUGIN_URL . 'inc/shortcodes/includes/css/all-racecards.css', '', rand());
    wp_enqueue_style( 'bestofbets_horse_racing_api-search-by-horse-name-style', BESTOFBETS_PLUGIN_URL . 'inc/shortcodes/includes/css/search-by-horse-name.css', '', rand());
    wp_enqueue_style( 'bestofbets_horse_racing_api-all-race-cards-responsive-style', BESTOFBETS_PLUGIN_URL . 'inc/shortcodes/includes/css/all-racecards-responsive.css', '', rand());
    wp_enqueue_style( 'bestofbets_horse_racing_api-public-style', BESTOFBETS_PLUGIN_URL . 'public/css/public.css', '', rand());
    wp_enqueue_style( 'bestofbets_horse_racing_api-custom-style', BESTOFBETS_PLUGIN_URL . 'public/css/custom.css', '', rand());
    wp_enqueue_style( 'bestofbets_horse_racing_api-custom-responsive-style', BESTOFBETS_PLUGIN_URL . 'public/css/custom-responsive.css', '', rand());


    wp_enqueue_script( 'bestofbets_horse_racing_api-public-script', BESTOFBETS_PLUGIN_URL . 'public/js/public.js', array('jquery'), rand(), true );
    wp_enqueue_script( 'bestofbets_horse_racing_api-custom-script', BESTOFBETS_PLUGIN_URL . 'public/js/custom.js', array('jquery'), rand(), true );


    // wp_register_style('bestofbets_horse_racing_api-image-uploader', BESTOFBETS_PLUGIN_URL . 'admin/css/image-uploader.css', '', rand());
    // wp_register_script('bestofbets_horse_racing_api-image-uploader', BESTOFBETS_PLUGIN_URL . 'admin/js/image-uploader.js', array('jquery'), rand(), true );


}
add_action( 'wp_enqueue_scripts', 'BESTOFBETS_PLUGIN_public_styles_scripts' );