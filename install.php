<?php

// path of destination file
$path_to_files = array( 
    BESTOFBETS_PLUGIN_PATH . "/inc/shortcodes/includes/json-responses/big-races-racecards/", 
    BESTOFBETS_PLUGIN_PATH . "/inc/shortcodes/includes/json-responses/all-racecards/"
);

// file names
$days = array("today", "tomorrow", "day_after_tomorrow", "next_third_day", "next_fourth_day");

// Save the current directory
$old = getcwd(); 

foreach($path_to_files as $path_to_files_key => $path_to_files_value){
    // Change the current directory
    chdir($path_to_files_value);

    foreach($days as $days_key => $days_value){

        $filename = $days_value.'.json';

        if(file_exists( $filename )){
            // change the rule for edition and deletion
            chmod($filename,0755);
        }
    }

}

// path of destination file
$path_to_file = BESTOFBETS_PLUGIN_PATH . "/inc/shortcodes/includes/json-responses/today-results/";

// Change the current directory
chdir($path_to_file);

$filename = 'today-results.json';

if(file_exists( $filename )){
    // change the rule for edition and deletion
    chmod($filename,0755);
}

// Restore the old working directory 
chdir($old); 


