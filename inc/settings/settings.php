<?php 

/**
 * Create Settings Menu
 */
function bestofbets_plugin_settings_menu() {

    $hook = add_menu_page(
        __( 'Horse Racing API Settings', BESTOFBETS_PLUGIN_NAME ),
        __( 'Horse Racing API Settings', BESTOFBETS_PLUGIN_NAME ),
        'manage_options',
        BESTOFBETS_PLUGIN_NAME.'-settings-page',
        'bestofbets_plugin_settings_template_callback',
        'dashicons-rest-api',
        10
    );

    // add_action( 'admin_head-'.$hook, 'myplugin_image_uplaoder_assets', 10, 1 );
}
add_action('admin_menu', 'bestofbets_plugin_settings_menu');

/**
 * Enqueue Image Uploader Assets
 */
// function myplugin_image_uplaoder_assets() {
//     wp_enqueue_media();
//     wp_enqueue_style( 'bestofbets_horse_racing_api-image-uploader');
//     wp_enqueue_script( 'bestofbets_horse_racing_api-image-uploader' );
// }


/**
 * Settings Template Page
 */
function bestofbets_plugin_settings_template_callback() {

    // installing bootstrap
    echo '<link rel="stylesheet" href="'.BESTOFBETS_PLUGIN_URL.'/inc/shortcodes/includes/css/bootstrap-min.css">';
    // echo '<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>';
    // echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';
    // echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">';
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

        <div class="row">
            <div class="col-md-6">
                <form action="options.php" method="post">
                    <?php 
                        // security field
                        settings_fields( 'myplugin-settings-page' );

                        // save settings button 
                        submit_button( 'Save Settings' );

                        // output settings section here
                        do_settings_sections('myplugin-settings-page');

                        // save settings button
                        submit_button( 'Save Settings' );
                    ?>
                </form>
            </div>
            <div class="col-md-6">
                
                <?php 

                    // initializing
                    // $raceResultCreatorShortcode = '';
                    // $singleRacecardShortcode = '';
                    // $resultsTodayShortcode = '';
                    // $searchHorseByNameShortcode = '';
                    
                    // if(shortcode_exists('raceResultCreatorShortcode') == 1){
                    //     $raceResultCreatorShortcode_tr_class = 'table-success';
                    //     $raceResultCreatorShortcode = 'raceResultCreatorShortcode';
                    // }else{
                    //     $raceResultCreatorShortcode_tr_class = 'table-warning';
                    //     $raceResultCreatorShortcode = 'No Such A Shortcode';
                    // }
                    
                    // if(shortcode_exists('singleRacecardShortcode') == 1){
                    //     $singleRacecardShortcode_tr_class = 'table-success';
                    //     $singleRacecardShortcode = 'singleRacecardShortcode';
                    // }else{
                    //     $singleRacecardShortcode_tr_class = 'table-warning';
                    //     $singleRacecardShortcode = 'No Such A Shortcode';
                    // }
                    
                    // if(shortcode_exists('resultsTodayShortcode') == 1){
                    //     $resultsTodayShortcode_tr_class = 'table-success';
                    //     $resultsTodayShortcode = 'resultsTodayShortcode';
                    // }else{
                    //     $resultsTodayShortcode_tr_class = 'table-warning';
                    //     $resultsTodayShortcode = 'No Such A Shortcode';
                    // }
                    
                    // if(shortcode_exists('resultsByDateShortcode') == 1){
                    //     $resultsByDateShortcode_tr_class = 'table-success';
                    //     $resultsByDateShortcode = 'resultsByDateShortcode';
                    // }else{
                    //     $resultsByDateShortcode_tr_class = 'table-warning';
                    //     $resultsByDateShortcode = 'No Such A Shortcode';
                    // }
                    
                    // if(shortcode_exists('searchHorseByNameShortcode') == 1){
                    //     $searchHorseByNameShortcode_tr_class = 'table-success';
                    //     $searchHorseByNameShortcode = 'searchHorseByNameShortcode';
                    // }else{
                    //     $searchHorseByNameShortcode_tr_class = 'table-warning';
                    //     $searchHorseByNameShortcode = 'No Such A Shortcode';
                    // }


                    // making HTML table
                    $pageHTML = '';

                    $pageHTML .= "<table class='table table-striped horse_racing_table'>";
                    
                    $pageHTML .= "<thead>";
                    $pageHTML .= "<tr>";
                    $pageHTML .= "<th>Page Title</th>";
                    $pageHTML .= "<th>Page Details</th>";
                    $pageHTML .= "<th>Short Code</th>";
                    $pageHTML .= "</tr>";
                    $pageHTML .= "</thead>";

                    $pageHTML .= "<tbody>";

                    // $pageHTML .= "<tr style='' class='".$raceResultCreatorShortcode_tr_class."' >";
                    // $pageHTML .= "<td class='".$raceResultCreatorShortcode_tr_class."' >Horse Racing Home</td>";
                    // $pageHTML .= "<td class='".$raceResultCreatorShortcode_tr_class."' >All Racecards Lists</td>";
                    // $pageHTML .= "<td class='".$raceResultCreatorShortcode_tr_class."' >".$raceResultCreatorShortcode."</td>";
                    // $pageHTML .= "</tr>";

                    // $pageHTML .= "<tr style='' class='".$singleRacecardShortcode_tr_class."' >";
                    // $pageHTML .= "<td class='".$singleRacecardShortcode_tr_class."' >Single Horse Racing Course</td>";
                    // $pageHTML .= "<td class='".$singleRacecardShortcode_tr_class."' >Single Racecards Odds Table</td>";
                    // $pageHTML .= "<td class='".$singleRacecardShortcode_tr_class."' >".$singleRacecardShortcode."</td>";
                    // $pageHTML .= "</tr>";

                    // $pageHTML .= "<tr style='' class='".$resultsTodayShortcode_tr_class."' >";
                    // $pageHTML .= "<td class='".$resultsTodayShortcode_tr_class."' >Race Results Today</td>";
                    // $pageHTML .= "<td class='".$resultsTodayShortcode_tr_class."' >All Race Results For Today</td>";
                    // $pageHTML .= "<td class='".$resultsTodayShortcode_tr_class."' >".$resultsTodayShortcode."</td>";
                    // $pageHTML .= "</tr>";

                    // $pageHTML .= "<tr style='' class='".$resultsByDateShortcode_tr_class."' >";
                    // $pageHTML .= "<td class='".$resultsByDateShortcode_tr_class."' >Results By Date</td>";
                    // $pageHTML .= "<td class='".$resultsByDateShortcode_tr_class."' >All Race Results By Date</td>";
                    // $pageHTML .= "<td class='".$resultsByDateShortcode_tr_class."' >".$resultsByDateShortcode."</td>";
                    // $pageHTML .= "</tr>";

                    // $pageHTML .= "<tr style='' class='".$searchHorseByNameShortcode_tr_class."' >";
                    // $pageHTML .= "<td class='".$searchHorseByNameShortcode_tr_class."' >Horse By Name</td>";
                    // $pageHTML .= "<td class='".$searchHorseByNameShortcode_tr_class."' >Search Horse By Name</td>";
                    // $pageHTML .= "<td class='".$searchHorseByNameShortcode_tr_class."' >".$searchHorseByNameShortcode."</td>";
                    // $pageHTML .= "</tr>";


                    $pageHTML .= "<tr style='' class='' >";
                    $pageHTML .= "<td class='' >Horse Racing Home</td>";
                    $pageHTML .= "<td class='' >All Racecards Lists</td>";
                    $pageHTML .= "<td class='' >raceResultCreatorShortcode</td>";
                    $pageHTML .= "</tr>";

                    // $pageHTML .= "<tr style='' class='".$singleRacecardShortcode_tr_class."' >";
                    // $pageHTML .= "<td class='".$singleRacecardShortcode_tr_class."' >Single Horse Racing Course</td>";
                    // $pageHTML .= "<td class='".$singleRacecardShortcode_tr_class."' >Single Racecards Odds Table</td>";
                    // $pageHTML .= "<td class='".$singleRacecardShortcode_tr_class."' >".$singleRacecardShortcode."</td>";
                    // $pageHTML .= "</tr>";

                    $pageHTML .= "<tr style='' class='' >";
                    $pageHTML .= "<td class='' >Race Results Today</td>";
                    $pageHTML .= "<td class='' >All Race Results For Today</td>";
                    $pageHTML .= "<td class='' >resultsTodayShortcode</td>";
                    $pageHTML .= "</tr>";

                    $pageHTML .= "<tr style='' class='' >";
                    $pageHTML .= "<td class='' >Results By Date</td>";
                    $pageHTML .= "<td class='' >All Race Results By Date</td>";
                    $pageHTML .= "<td class='' >resultsByDateShortcode</td>";
                    $pageHTML .= "</tr>";

                    $pageHTML .= "<tr style='' class='' >";
                    $pageHTML .= "<td class='' >Horse By Name</td>";
                    $pageHTML .= "<td class='' >Search Horse By Name</td>";
                    $pageHTML .= "<td class='' >searchHorseByNameShortcode</td>";
                    $pageHTML .= "</tr>";



                    $pageHTML .= "</tbody>";

                    $pageHTML .= "</table>";

                    echo $pageHTML;

                ?>

            </div>

        </div>


    </div>
    <?php 
}

/**
 * Settings Template
 */
add_action( 'admin_init', 'myplugin_settings_init' );

function myplugin_settings_init() {

    // Setup settings section 1
    add_settings_section(
        'myplugin_settings_section',
        'API Credentials',
        '',
        'myplugin-settings-page',
        // array(
        //     'before_section' => '<div class="row"><div class="%s">',
        //     'after_section'  => '</div>',
        //     'section_class'  => 'col-md-6',
        // )
    );

    // Setup settings section 2
    add_settings_section(
        'myplugin_settings_section2',
        'Page Slugs',
        '',
        'myplugin-settings-page',
        // array(
        //     'before_section' => '<div class="%s">',
        //     'after_section'  => '</div></div>',
        //     'section_class'  => 'col-md-6',
        // )
    );


// section 1 starts here

    // Register radio field
    register_setting(
        'myplugin-settings-page',
        BESTOFBETS_PLUGIN_NAME . '_sandbox_or_production',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );

    // Add radio fields
    add_settings_field(
        BESTOFBETS_PLUGIN_NAME . '_sandbox_or_production',
        __( 'Sandbox or Production?', BESTOFBETS_PLUGIN_NAME ),
        'sandbox_or_production',
        'myplugin-settings-page',
        'myplugin_settings_section'
    );


    // Register input field
    register_setting(
        'myplugin-settings-page',
        BESTOFBETS_PLUGIN_NAME . '_base_url',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );

    // Add text fields
    add_settings_field(
        BESTOFBETS_PLUGIN_NAME . '_base_url',
        __( 'Base URL', BESTOFBETS_PLUGIN_NAME ),
        'base_url_field_callback',
        'myplugin-settings-page',
        'myplugin_settings_section'
    );



    // Register input field
    register_setting(
        'myplugin-settings-page',
        BESTOFBETS_PLUGIN_NAME . '_sandbox_username',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );

    // Add text fields
    add_settings_field(
        BESTOFBETS_PLUGIN_NAME . '_sandbox_username',
        __( 'SandBox Username', BESTOFBETS_PLUGIN_NAME ),
        'sandbox_username_field_callback',
        'myplugin-settings-page',
        'myplugin_settings_section'
    );


    // Register input field
    register_setting(
        'myplugin-settings-page',
        BESTOFBETS_PLUGIN_NAME . '_sandbox_password',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );

    add_settings_field(
        BESTOFBETS_PLUGIN_NAME . '_sandbox_password',
        __( 'SandBox Password', BESTOFBETS_PLUGIN_NAME ),
        'sandbox_password_field_callback',
        'myplugin-settings-page',
        'myplugin_settings_section'
    );

    // Register input field
    register_setting(
        'myplugin-settings-page',
        BESTOFBETS_PLUGIN_NAME . '_production_username',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );

    add_settings_field(
        BESTOFBETS_PLUGIN_NAME . '_production_username',
        __( 'Production Username', BESTOFBETS_PLUGIN_NAME ),
        'production_username_field_callback',
        'myplugin-settings-page',
        'myplugin_settings_section'
    );

    // Register input field
    register_setting(
        'myplugin-settings-page',
        BESTOFBETS_PLUGIN_NAME . '_production_password',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );

    add_settings_field(
        BESTOFBETS_PLUGIN_NAME . '_production_password',
        __( 'Production Password', BESTOFBETS_PLUGIN_NAME ),
        'production_password_field_callback',
        'myplugin-settings-page',
        'myplugin_settings_section'
    );





    // // Register image uploader field
    // register_setting(
    //     'myplugin-settings-page',
    //     'myplugin_settings_image_uploader_field',
    //     array(
    //         'type' => 'integer',
    //         'sanitize_callback' => 'sanitize_image_uploader',
    //         'default' => ''
    //     )
    // );

    // // Add image uploader fields
    // add_settings_field(
    //     'myplugin_settings_image_uploader_field',
    //     __( 'Image Uplaoder', BESTOFBETS_PLUGIN_NAME ),
    //     'myplugin_settings_image_uploader_field_callback',
    //     'myplugin-settings-page',
    //     'myplugin_settings_section'
    // );

// section 1 ends here




// section 2 starts here

    // Register input field
    register_setting(
        'myplugin-settings-page',
        BESTOFBETS_PLUGIN_NAME . '_racing_home_url_slug',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => '/horse-racing'
        )
    );

    // Add text fields
    add_settings_field(
        BESTOFBETS_PLUGIN_NAME . '_racing_home_url_slug',
        __( 'Racing Home', BESTOFBETS_PLUGIN_NAME ),
        'racing_home_url_slug_field_callback',
        'myplugin-settings-page',
        'myplugin_settings_section2'
    );

    // // Register input field
    // register_setting(
    //     'myplugin-settings-page',
    //     BESTOFBETS_PLUGIN_NAME . '_single_race_odds_info_slug',
    //     array(
    //         'type' => 'string',
    //         'sanitize_callback' => 'sanitize_text_field',
    //         'default' => '/single-horse-racing-course'
    //     )
    // );

    // // Add text fields
    // add_settings_field(
    //     BESTOFBETS_PLUGIN_NAME . '_single_race_odds_info_slug',
    //     __( 'Single Race Odds', BESTOFBETS_PLUGIN_NAME ),
    //     'single_race_odds_info_slug_field_callback',
    //     'myplugin-settings-page',
    //     'myplugin_settings_section2'
    // );

    // Register input field
    register_setting(
        'myplugin-settings-page',
        BESTOFBETS_PLUGIN_NAME . '_results_today_slug',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => '/race-results-today'
        )
    );

    // Add text fields
    add_settings_field(
        BESTOFBETS_PLUGIN_NAME . '_results_today_slug',
        __( 'Fast Results', BESTOFBETS_PLUGIN_NAME ),
        'results_today_slug_field_callback',
        'myplugin-settings-page',
        'myplugin_settings_section2'
    );

    // Register input field
    register_setting(
        'myplugin-settings-page',
        BESTOFBETS_PLUGIN_NAME . '_results_by_date_slug',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => '/results-by-date'
        )
    );

    // Add text fields
    add_settings_field(
        BESTOFBETS_PLUGIN_NAME . '_results_by_date_slug',
        __( 'Full Results', BESTOFBETS_PLUGIN_NAME ),
        'results_by_date_slug_field_callback',
        'myplugin-settings-page',
        'myplugin_settings_section2'
    );


    // Register input field
    register_setting(
        'myplugin-settings-page',
        BESTOFBETS_PLUGIN_NAME . '_search_horse_by_name_slug',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => '/search-horse-by-name'
        )
    );

    // Add text fields
    add_settings_field(
        BESTOFBETS_PLUGIN_NAME . '_search_horse_by_name_slug',
        __( 'Search Horse By Name', BESTOFBETS_PLUGIN_NAME ),
        'search_horse_by_name_slug_field_callback',
        'myplugin-settings-page',
        'myplugin_settings_section2'
    );

// section 2 ends here



}
// Settings Template ends here 




/**
 * Sanitize Image Uploader
 */
// function sanitize_image_uploader( $value ) {
//     if(isset($value)) {
//         return intval($value);
//     }else {
//         return false;
//     }
// }



/**
 * radio field tempalte
 */
function sandbox_or_production() {
    $myplugin_radio_field = get_option( BESTOFBETS_PLUGIN_NAME . '_sandbox_or_production' );
    ?>
    <label for="sandbox">
        <input type="radio" name="<?php echo BESTOFBETS_PLUGIN_NAME;?>_sandbox_or_production" value="sandbox" <?php checked( 'sandbox', $myplugin_radio_field ); ?>/> Sandbox
    </label>
    <label for="production">
        <input type="radio" name="<?php echo BESTOFBETS_PLUGIN_NAME;?>_sandbox_or_production" value="production" <?php checked( 'production', $myplugin_radio_field ); ?>/> Production
    </label>
    <?php
}


/**
 * txt tempalte
 */
function base_url_field_callback() {
    $myplugin_input_field = get_option(BESTOFBETS_PLUGIN_NAME . '_base_url');
    ?>
    <input type="text" name="<?php echo BESTOFBETS_PLUGIN_NAME;?>_base_url" class="regular-text" placeholder='Base URL...' value="<?php echo isset($myplugin_input_field) ? esc_attr( $myplugin_input_field ) : ''; ?>" />
    <?php 
}
function sandbox_username_field_callback() {
    $myplugin_input_field = get_option(BESTOFBETS_PLUGIN_NAME . '_sandbox_username');
    ?>
    <input type="text" name="<?php echo BESTOFBETS_PLUGIN_NAME;?>_sandbox_username" class="regular-text" placeholder='Sandbox Username...' value="<?php echo isset($myplugin_input_field) ? esc_attr( $myplugin_input_field ) : ''; ?>" />
    <?php 
}
function sandbox_password_field_callback() {
    $myplugin_input_field = get_option(BESTOFBETS_PLUGIN_NAME . '_sandbox_password');
    ?>
    <input type="password" name="<?php echo BESTOFBETS_PLUGIN_NAME;?>_sandbox_password" class="regular-text" placeholder='Sandbox Password...' value="<?php echo isset($myplugin_input_field) && $myplugin_input_field != '' ? $myplugin_input_field : ''; ?>" />
    <?php 
}
function production_username_field_callback() {
    $myplugin_input_field = get_option(BESTOFBETS_PLUGIN_NAME . '_production_username');
    ?>
    <input type="text" name="<?php echo BESTOFBETS_PLUGIN_NAME;?>_production_username" class="regular-text" placeholder='Production Username...' value="<?php echo isset($myplugin_input_field) ? esc_attr( $myplugin_input_field ) : ''; ?>" />
    <?php 
}
function production_password_field_callback() {
    $myplugin_input_field = get_option(BESTOFBETS_PLUGIN_NAME . '_production_password');
    ?>
    <input type="password" name="<?php echo BESTOFBETS_PLUGIN_NAME;?>_production_password" class="regular-text" placeholder='Production Password...' value="<?php echo isset($myplugin_input_field) && $myplugin_input_field != '' ? $myplugin_input_field : ''; ?>" />
    <?php 
}





// page slug starts here 

function racing_home_url_slug_field_callback() {
    $myplugin_input_field = get_option(BESTOFBETS_PLUGIN_NAME . '_racing_home_url_slug');
    ?>
    <input type="text" name="<?php echo BESTOFBETS_PLUGIN_NAME;?>_racing_home_url_slug" class="regular-text" value="<?php echo isset($myplugin_input_field) ? esc_attr( $myplugin_input_field ) : ''; ?>" />
    <?php 
}

/* 
function single_race_odds_info_slug_field_callback() {
    $myplugin_input_field = get_option(BESTOFBETS_PLUGIN_NAME . '_single_race_odds_info_slug');
    ?>
    <input type="text" name="<?php echo BESTOFBETS_PLUGIN_NAME;?>_single_race_odds_info_slug" class="regular-text" value="<?php echo isset($myplugin_input_field) ? esc_attr( $myplugin_input_field ) : ''; ?>" />
    <?php 
}
*/

function results_today_slug_field_callback() {
    $myplugin_input_field = get_option(BESTOFBETS_PLUGIN_NAME . '_results_today_slug');
    ?>
    <input type="text" name="<?php echo BESTOFBETS_PLUGIN_NAME;?>_results_today_slug" class="regular-text" value="<?php echo isset($myplugin_input_field) ? esc_attr( $myplugin_input_field ) : ''; ?>" />
    <?php 
}

function results_by_date_slug_field_callback() {
    $myplugin_input_field = get_option(BESTOFBETS_PLUGIN_NAME . '_results_by_date_slug');
    ?>
    <input type="text" name="<?php echo BESTOFBETS_PLUGIN_NAME;?>_results_by_date_slug" class="regular-text" value="<?php echo isset($myplugin_input_field) ? esc_attr( $myplugin_input_field ) : ''; ?>" />
    <?php 
}

function search_horse_by_name_slug_field_callback() {
    $myplugin_input_field = get_option(BESTOFBETS_PLUGIN_NAME . '_search_horse_by_name_slug');
    ?>
    <input type="text" name="<?php echo BESTOFBETS_PLUGIN_NAME;?>_search_horse_by_name_slug" class="regular-text" value="<?php echo isset($myplugin_input_field) ? esc_attr( $myplugin_input_field ) : ''; ?>" />
    <?php 
}

// page slug ends here 



/**
 * Image Uploader Template
 */

 /**
function myplugin_settings_image_uploader_field_callback() {

    $myplugin_image_id = get_option('myplugin_settings_image_uploader_field');

    ?>
    <div class="myplugin-upload-wrap">
        <img data-src="" src="<?php echo esc_url(wp_get_attachment_url(isset($myplugin_image_id) ? (int) $myplugin_image_id : 0)); ?>" width="250"/>
        <div class="myplugin-upload-action">
            <input type="hidden" name="myplugin_settings_image_uploader_field" value="<?php echo esc_attr(isset($myplugin_image_id) ? (int) $myplugin_image_id : 0); ?>" />
            <button type="button" class="upload_image_button"><span class="dashicons dashicons-plus"></span></button>
            <button type="button" class="remove_image_button"><span class="dashicons dashicons-minus"></span></button>
        </div>
    </div>
    <?php 
}
**/

add_action( 'init', 'myplugin_init' );
function myplugin_init() {
	// hashing the password
    add_filter( 'pre_update_option_' . BESTOFBETS_PLUGIN_NAME . '_production_password', function( $new_value, $old_value ) {

        if($new_value != ''){
            $new_value = decrypt_password($new_value);
            $new_value = encrypt_password($new_value);
        }
        
        return $new_value;
    
    }, 10, 2);

    // hashing the password
    add_filter( 'pre_update_option_' . BESTOFBETS_PLUGIN_NAME . '_sandbox_password', function( $new_value, $old_value ) {

        if($new_value != ''){
            $new_value = decrypt_password($new_value);
            $new_value = encrypt_password($new_value);
        }
        
        return $new_value;
    
    }, 10, 2);
}


