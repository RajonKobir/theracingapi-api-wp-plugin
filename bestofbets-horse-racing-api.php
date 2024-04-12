<?php
/*
 * Plugin Name: BestOfBets Horse Racing API
 * Plugin URI: 
 * Description: BestOfBets Horse Racing API connects 3rd party API
 * Author: Media Vita
 * Version: 1.0.0
 * Author URI: https://mediavita.co.uk/
 * Text Domain: BestOfBets
 * License: GPL2+
 * Domain Path: 
**/


//  no direct access 
if( !defined('ABSPATH') ) : exit(); endif;


// Define plugin constants 
define( 'BESTOFBETS_PLUGIN_PATH', trailingslashit( plugin_dir_path(__FILE__) ) );
define( 'BESTOFBETS_PLUGIN_URL', trailingslashit( plugins_url('/', __FILE__) ) );
define( 'BESTOFBETS_PLUGIN_NAME', 'bestofbets_horse_racing_api' );


// add css and js 
if( is_admin() ) {
    require_once BESTOFBETS_PLUGIN_PATH . '/admin/admin.php';
}else{
    require_once BESTOFBETS_PLUGIN_PATH . '/public/public.php';
}

//  add settings page 
if( is_admin() ) {
    if ( !function_exists('encrypt_password') && !function_exists('decrypt_password') ){
        //  add password encrypt decrypt
        require_once BESTOFBETS_PLUGIN_PATH . '/inc/password-encryption/password-encrypt-decrypt.php';
    }
    require_once BESTOFBETS_PLUGIN_PATH . '/inc/settings/settings.php';
}

//  add dashicon CSS
if( !is_admin() ) {
    
    add_action( 'wp_enqueue_scripts', 'dashicons_front_end' );

    function dashicons_front_end() {

        wp_enqueue_style( 'dashicons' );

    }

}

//  adding Cron task
require_once BESTOFBETS_PLUGIN_PATH . 'cron.php';

//  add shortcodes
require_once BESTOFBETS_PLUGIN_PATH . '/inc/shortcodes/shortcodes.php';

// register activation hook
register_activation_hook(
	__FILE__,
	'activation_function'
);
function activation_function(){
    require_once BESTOFBETS_PLUGIN_PATH . 'install.php';
}

// register deactivation hook
register_deactivation_hook(
	__FILE__,
	'deactivation_function'
);
function deactivation_function(){
    require_once BESTOFBETS_PLUGIN_PATH . 'uninstall.php';
}





?>