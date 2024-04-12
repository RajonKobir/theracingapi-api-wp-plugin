<?php

// adding new cron task to the system
add_filter( 'cron_schedules', function ( $schedules ) {
    // if(!isset($schedules['per_five_minutes'])){
        $schedules['per_five_minutes'] = array(
            'interval' => 300,
            'display' => __( 'Five Minutes' )
        );
    // }
    return $schedules;
 } );

 add_action('my_cron_event', 'my_cron_function');

function my_cron_function() {

    //sleep for 3 seconds
    sleep(3);

    // initializing the dates
    $today = date("Y-m-d");
    $tomorrow = strtotime("tomorrow");
    $tomorrow_day_full_name = date("D", $tomorrow);
    $tomorrow = date("Y-m-d", $tomorrow);
    $day_after_tomorrow = strtotime("tomorrow + 1day");
    $day_after_tomorrow_day_full_name = date("D", $day_after_tomorrow);
    $day_after_tomorrow = date("Y-m-d", $day_after_tomorrow);
    $next_third_day = strtotime("tomorrow + 2days");
    $next_third_day_day_full_name = date("D", $next_third_day);
    $next_third_day = date("Y-m-d", $next_third_day);
    $next_fourth_day = strtotime("tomorrow + 3days");
    $next_fourth_day_day_full_name = date("D", $next_fourth_day);
    $next_fourth_day = date("Y-m-d", $next_fourth_day);

    $base_url = get_option(BESTOFBETS_PLUGIN_NAME . '_base_url');
    $production_username = get_option(BESTOFBETS_PLUGIN_NAME . '_production_username');
    // $production_password = decrypt_password(get_option(BESTOFBETS_PLUGIN_NAME . '_production_password'));
    $production_password = get_option(BESTOFBETS_PLUGIN_NAME . '_production_password');

    require_once( BESTOFBETS_PLUGIN_PATH . '/inc/shortcodes/includes/ApiQueries.php');

    $days = array("today", "tomorrow", "day_after_tomorrow", "next_third_day", "next_fourth_day");

    foreach( $days as $day_key => $day_value){

        $ApiQuery = new ApiQueries;
        $big_races_response = $ApiQuery->big_races_by_date($$day_value, $base_url, $production_username, $production_password);

        //sleep for 1 seconds
        sleep(1);

        $response = $ApiQuery->race_cards_by_date($$day_value, $base_url, $production_username, $production_password);

        //sleep for 1 seconds
        sleep(1);
    
        $myfile = fopen( BESTOFBETS_PLUGIN_PATH . "/inc/shortcodes/includes/json-responses/big-races-racecards/".$day_value.".json", "w");
        $txt = $big_races_response;
        fwrite($myfile, $txt);
        fclose($myfile);

        //sleep for 1 seconds
        sleep(1);
    
        $myfile = fopen( BESTOFBETS_PLUGIN_PATH . "/inc/shortcodes/includes/json-responses/all-racecards/".$day_value.".json", "w");
        $txt = $response;
        fwrite($myfile, $txt);
        fclose($myfile);
    
        //sleep for 1 seconds
        sleep(1);

    }

    //sleep for 1 seconds
    sleep(1);

    $ApiQuery = new ApiQueries;
    $response = $ApiQuery->race_results_today($base_url, $production_username, $production_password);

    //sleep for 1 seconds
    sleep(1);

    $myfile = fopen( BESTOFBETS_PLUGIN_PATH . "/inc/shortcodes/includes/json-responses/today-results/today-results.json", "w");
    $txt = $response;
    fwrite($myfile, $txt);
    fclose($myfile);

    //sleep for 1 seconds
    sleep(1);

    // Clear all W3 Total Cache
    if ( function_exists( 'w3tc_flush_all' ) ) {
        w3tc_flush_all();
    }

}

if ( ! wp_next_scheduled( 'my_cron_event' ) ) {
    wp_schedule_event( time(), 'per_five_minutes', 'my_cron_event' );
}



