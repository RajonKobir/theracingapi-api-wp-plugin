<?php
    // shortcode function starts here
    function resultsByDate($attr) {

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

        // initializing
        $date = '';
        
        echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">';

        // checking URL extensions
        if( isset($_GET['date'])  ){
            if($_GET['date'] == ''){
                $date = $today;
            }else{
                $date = $_GET['date'];
            }
        }else{
            $date = $today;
        }

        $base_url = get_option(BESTOFBETS_PLUGIN_NAME . '_base_url');
        $production_username = get_option(BESTOFBETS_PLUGIN_NAME . '_production_username');
        $production_password = get_option(BESTOFBETS_PLUGIN_NAME . '_production_password');
        $current_page_link = get_page_link();
        // $horse_racing_home_url = site_url() . '/horse-racing-home';
        $horse_racing_home_url = site_url() . get_option(BESTOFBETS_PLUGIN_NAME . '_racing_home_url_slug');
        $home_page_link = get_home_url();


        echo '<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>';
        echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';

        try {      
            
            // Read the JSON file 
            // $response = file_get_contents( BESTOFBETS_PLUGIN_URL .'/inc/shortcodes/includes/example-responses-json/standard-racecards.json');

            $ApiQuery = new ApiQueries;
            $response = $ApiQuery->race_results_by_date($date, $base_url, $production_username, $production_password);


        } catch (PDOException $e) {

            $pageHTML .= "Error: " . $e->getMessage();

        }finally{

            // var_dump($response);

            $raceResults = json_decode($response, true);
            $raceResults = $raceResults["results"];


            $current_date = $date;
            $current_date_day = date('D', strtotime($date));
            $current_date_day_date = date('d', strtotime($date));
            $today = date("Y-m-d");
            if($date == $today){
              $next_date = '';
              $next_date_day = date('D', strtotime('+1 day', strtotime($date)));
              $next_date_day_date = date('d', strtotime('+1 day', strtotime($date)));
              $next_date_2 = '';
              $next_date_day_2 = date('D', strtotime('+2 day', strtotime($date)));
              $next_date_day_2_date = date('d', strtotime('+2 day', strtotime($date)));
              $previous_date = date('Y-m-d', strtotime('-1 day', strtotime($date)));
              $previous_date_day = date('D', strtotime('-1 day', strtotime($date)));
              $previous_date_day_date = date('d', strtotime('-1 day', strtotime($date)));
              $previous_date_2 = date('Y-m-d', strtotime('-2 days', strtotime($date)));
              $previous_date_day_2 = date('D', strtotime('-2 days', strtotime($date)));
              $previous_date_day_2_date = date('d', strtotime('-2 days', strtotime($date)));
            }else{
                $next_date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
                $next_date_day = date('D', strtotime('+1 day', strtotime($date)));
                $next_date_day_date = date('d', strtotime('+1 day', strtotime($date)));
                $previous_date = date('Y-m-d', strtotime('-1 day', strtotime($date)));
                $previous_date_day = date('D', strtotime('-1 day', strtotime($date)));
                $previous_date_day_date = date('d', strtotime('-1 day', strtotime($date)));
                $next_date_2 = date('Y-m-d', strtotime('+2 day', strtotime($date)));
                $next_date_day_2 = date('D', strtotime('+2 day', strtotime($date)));
                $next_date_day_2_date = date('d', strtotime('+2 day', strtotime($date)));
                $previous_date_2 = date('Y-m-d', strtotime('-2 day', strtotime($date)));
                $previous_date_day_2 = date('D', strtotime('-2 day', strtotime($date)));
                $previous_date_day_2_date = date('d', strtotime('-2 day', strtotime($date)));
            }
    
            if($next_date == ''){
                $next_date_link = '#';
            }else{
                $next_date_link = $current_page_link.'?date='.$next_date;
            }
    
            if($next_date_2 == ''){
                $next_date_2_link = '#';
            }else{
                $next_date_2_link = $current_page_link.'?date='.$next_date_2;
            }
    
    
            // initializing 
            $pageHTML = '';
    
            $pageHTML .= "<div class='results_by_date_date_calculation'>";
    
            // $pageHTML .= "<span class='results_by_date_single_date'><a href='".$current_page_link."?date=".$previous_date."'><i class='arrow'></i></a></span>";
            // $pageHTML .= "<span class='results_by_date_single_date'><a href='".$current_page_link."?date=".$previous_date_2."'>".$previous_date_day_2."</a></span>";
            // $pageHTML .= "<span class='results_by_date_single_date'><a href='".$current_page_link."?date=".$previous_date."'>".$previous_date_day."</a></span>";
            // $pageHTML .= "<span class='results_by_date_single_date today'><a href='".$current_page_link."?date=".$current_date."'>".$current_date_day."</a></span>";
            // $pageHTML .= "<span class='results_by_date_single_date'><a href='".$current_page_link."?date=".$next_date."'>".$next_date_day."</a></span>";
            // $pageHTML .= "<span class='results_by_date_single_date'><a href='".$current_page_link."?date=".$next_date_2."'>".$next_date_day_2."</a></span>";
            // $pageHTML .= "<span class='results_by_date_single_date'><a href='".$current_page_link."?date=".$next_date."'><i class='arrow'></i></a></span>";
    
            $pageHTML .= "<div class='tab horse_racing_odds_table_tab' role='tabpanel'>";
            $pageHTML .= "<ul class='nav nav-tabs horse_racing_odds_table_nav' role='tablist'>";
    
            $pageHTML .= "<li role='presentation' class='nav-item horse_racing_odds_table_nav_li'><a href='".$current_page_link."?date=".$previous_date."'><span class='dashicons dashicons-arrow-left-alt2'></span></a></li>";
            $pageHTML .= "<li role='presentation' class='nav-item horse_racing_odds_table_nav_li'><a href='".$current_page_link."?date=".$previous_date_2."'><p class='calendar-date current_date_day'>".$previous_date_day_2_date."</p><p class='calendar-day current_date_day'>".$previous_date_day_2."</p></a></li>";
            $pageHTML .= "<li role='presentation' class='nav-item horse_racing_odds_table_nav_li'><a href='".$current_page_link."?date=".$previous_date."'><p class='calendar-date current_date_day'>".$previous_date_day_date."</p><p class='calendar-day current_date_day'>".$previous_date_day."</p></a></li>";
            $pageHTML .= "<li role='presentation' class='nav-item horse_racing_odds_table_nav_li active'><a href='".$current_page_link."?date=".$current_date."'><p class='calendar-date current_date_day'>".$current_date_day_date."</p><p class='calendar-day current_date_day'>".$current_date_day."</p></a></li>";
            $pageHTML .= "<li role='presentation' class='nav-item horse_racing_odds_table_nav_li'><a href='".$next_date_link."'><p class='calendar-date current_date_day'>".$next_date_day_date."</p><p class='calendar-day current_date_day'>".$next_date_day."</p></a></li>";
            $pageHTML .= "<li role='presentation' class='nav-item horse_racing_odds_table_nav_li'><a href='".$next_date_2_link."'><p class='calendar-date current_date_day'>".$next_date_day_2_date."</p><p class='calendar-day current_date_day'>".$next_date_day_2."</p></a></li>";
            $pageHTML .= "<li role='presentation' class='nav-item horse_racing_odds_table_nav_li'><a href='".$next_date_link."'><span class='dashicons dashicons-arrow-right-alt2'></span></a></li>";
    
            // $pageHTML .= "<li role='presentation' class='nav-item horse_racing_odds_table_nav_li ".$active_class."'><a id='section_".$section_id."' class='nav-link ' href='#Section".$section_id."' aria-controls='profile' role='tab' data-toggle='tab'>".$raceResult["off_time"]."</a></li>";
    
            $pageHTML .= "</ul>";
            $pageHTML .= "</div>";
    
            $pageHTML .= "</div>";



            if(isset($raceResults[0]["race_id"])){
                $color = $args['color'];
                $textSize = $args['textSize'];
                $MakeHtmlTable = new MakeHtmlTable;
                $raceResults = $MakeHtmlTable->results_by_date_make_table($raceResults, $color, $textSize, $course, $off_time, $date, $current_page_link );
                $pageHTML .= $raceResults;
            }else{
                $pageHTML .= "<div class='results_by_date_date_not_found_div'>";
                $pageHTML .= "<h5 class='text-center'>No Races Found!</h5>";
                $pageHTML .= "<h3 class='text-center back_heading'><a href='".$horse_racing_home_url."'>Back To Horse Racing Home</a></h3>";
                $pageHTML .= "</div>";
            }

        }



        return $pageHTML;

      }
      // end of shortcode function


