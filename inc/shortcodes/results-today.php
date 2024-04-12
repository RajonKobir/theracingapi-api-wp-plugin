<?php
    // shortcode function starts here
    function resultsToday($attr) {

        $args = shortcode_atts( array(
     
            'url' => '#',
            'color' => '#4a6085',
            'textSize' => 14,
            'textAlign' => 'left',
            'hoverOpacity' => 0.7,
            'fontFamily' => 'Roboto',
            'textTransform' => 'capitalize',
 
        ), $attr );

        // initializing
        $pageHTML = '';
        require_once('includes/ApiQueries.php');
        require_once('includes/MakeHtmlTable.php');
        
        echo '<style>.tab {font-family: '.$args['fontFamily'].', sans-serif;}</style>';
        echo '<style>.tab tr a{font-family: '.$args['fontFamily'].', sans-serif;text-transform: '.$args['textTransform'].' !important;color: '.$args['color'].';font-size:'.($args['textSize']-1).'px;}</style>';

        // initializing the dates
        $today = date("Y-m-d");
        $tomorrow = strtotime("tomorrow");
        $tomorrow_day_full_name = date("l", $tomorrow);
        $tomorrow = date("Y-m-d", $tomorrow);
        $day_after_tomorrow = strtotime("tomorrow + 1day");
        $day_after_tomorrow_day_full_name = date("l", $day_after_tomorrow);
        $day_after_tomorrow = date("Y-m-d", $day_after_tomorrow);
        $next_third_day = strtotime("tomorrow + 2days");
        $next_third_day_day_full_name = date("l", $next_third_day);
        $next_third_day = date("Y-m-d", $next_third_day);


        // triming special characters
        // function test_input($data) {
        //     $data = trim($data);
        //     $data = stripslashes($data);
        //     $data = htmlspecialchars($data);
        //     return $data;
        // }

        //triming special characters
        // $_SERVER['REQUEST_URI'] = test_input($_SERVER['REQUEST_URI']);



        echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">';

        $base_url = get_option(BESTOFBETS_PLUGIN_NAME . '_base_url');
        $production_username = get_option(BESTOFBETS_PLUGIN_NAME . '_production_username');
        $production_password = get_option(BESTOFBETS_PLUGIN_NAME . '_production_password');
        // $horse_racing_home_url = site_url() . '/horse-racing-home';
        $horse_racing_home_url = site_url() . get_option(BESTOFBETS_PLUGIN_NAME . '_racing_home_url_slug');
        $home_page_link = get_home_url();
        
        // echo '<br>';
        // echo $horse_racing_home_url;


        echo '<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>';
        echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';

        try {      
            
            // Read the JSON file 
            $response = file_get_contents( BESTOFBETS_PLUGIN_URL .'/inc/shortcodes/includes/json-responses/today-results/today-results.json');

            // $ApiQuery = new ApiQueries;
            // $response = $ApiQuery->race_results_today($base_url, $production_username, $production_password);


        } catch (PDOException $e) {

            $pageHTML .= "Error: " . $e->getMessage();

        }finally{

            // var_dump($response);

            $raceResults = json_decode($response, true);
            $raceResults = $raceResults["results"];

            if(isset($raceResults[0]["race_id"])){
                $color = $args['color'];
                $textSize = $args['textSize'];
                $MakeHtmlTable = new MakeHtmlTable;
                $raceResults = $MakeHtmlTable->results_today_make_table($raceResults, $color, $textSize, $course, $off_time, $day, $horse_racing_home_url );
                $pageHTML .= $raceResults;
            }else{
                $pageHTML .= "<h6 class='text-center'>No Races Found!</h6>";
                $pageHTML .= "<h3 class='text-center back_heading'><a href='".$horse_racing_home_url."'>Back To Horse Racing Home</a></h3>";
            }

        }



        return $pageHTML;

      }
      // end of shortcode function


