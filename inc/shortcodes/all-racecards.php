<?php
    // shortcode function starts here
    function raceResultCreator($attr) {

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


        // triming special characters
        // function test_input($data) {
        //     $data = trim($data);
        //     $data = stripslashes($data);
        //     $data = htmlspecialchars($data);
        //     return $data;
        // }

        //triming special characters
        // $_SERVER['REQUEST_URI'] = test_input($_SERVER['REQUEST_URI']);

        $current_page_link = get_page_link();
        // $horse_racing_home_url = site_url() . get_option(BESTOFBETS_PLUGIN_NAME . '_racing_home_url_slug');
        $horse_racing_home_url = get_page_link();
        $home_page_link = get_site_url();

        echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">';

        $course = '';
        $off_time = '';
        $date = '';
        
        // checking URL extensions
        if( isset($_GET['course']) && isset($_GET['off_time']) && isset($_GET['date']) ){
            $course = $_GET['course'];
            $off_time = $_GET['off_time'];
            $date = $_GET['date'];
        }

        if( $course == '' || $off_time == '' || $date == ''){

            $base_url = get_option(BESTOFBETS_PLUGIN_NAME . '_base_url');
            $production_username = get_option(BESTOFBETS_PLUGIN_NAME . '_production_username');
            // $production_password = decrypt_password(get_option(BESTOFBETS_PLUGIN_NAME . '_production_password'));
            $production_password = get_option(BESTOFBETS_PLUGIN_NAME . '_production_password');
            // $production_password = decrypt_password($production_password);

            echo '<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>';
            echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';

            //Create the WordPress page content HTML
            $pageHTML .= "<h2 class='elementor-heading-title elementor-size-default special_margin_heading'>Live Horse Racing Odds</h2>";

            $pageHTML .= "<div class='tab all_racecards_tab' role='tabpanel'>";

            $pageHTML .= "<ul class='nav nav-tabs all_racecards_nav' role='tablist'>";

            $pageHTML .= "<li role='presentation' class='nav-item all_racecards_nav_li active'><a class='nav-link ' href='#Section1' aria-controls='home' role='tab' data-toggle='tab'>Today</a></li>";
            $pageHTML .= "<li role='presentation' class='nav-item all_racecards_nav_li'><a id='section_2' class='nav-link ' href='#Section2' aria-controls='profile' role='tab' data-toggle='tab'>".$tomorrow_day_full_name."</a></li>";
            $pageHTML .= "<li role='presentation' class='nav-item ' ><a class='nav-link' href='#Section3' aria-controls='messages' role='tab' data-toggle='tab'>".$day_after_tomorrow_day_full_name."</a></li>";
            $pageHTML .= "<li role='presentation' class='nav-item ' ><a class='nav-link' href='#Section4' aria-controls='messages2' role='tab' data-toggle='tab'>".$next_third_day_day_full_name."</a></li>";
            $pageHTML .= "<li role='presentation' class='nav-item ' ><a class='nav-link' href='#Section5' aria-controls='messages2' role='tab' data-toggle='tab'>".$next_fourth_day_day_full_name."</a></li>";

            $pageHTML .= "</ul>";

            $pageHTML .= "<div class='tab-content tabs all_racecards_tab_content'>";

            $pageHTML .= "<div role='tabpanel' class='tab-pane fade in' id='Section5'>";
            
            $pageHTML .= "</div>";

            $pageHTML .= "<div role='tabpanel' class='tab-pane fade in' id='Section4'>";

            $pageHTML .= "</div>";
                
            $pageHTML .= "<div role='tabpanel' class='tab-pane fade' id='Section3'>";

            $pageHTML .= "</div>";
                    
            $pageHTML .= "<div role='tabpanel' class='tab-pane fade all_racecards_tab_pan' id='Section2'>";

            $pageHTML .= "</div>";
                
            $pageHTML .= "<div role='tabpanel' class='tab-pane fade in all_racecards_tab_pan active ' id='Section1'>";

            $pageHTML .= "</div>";

            $pageHTML .= "</div>";
            $pageHTML .= "</div>";


            echo '<script>

            $( document ).ready(function() {
            
                var color = "'.$args['color'].'"; 
                var textSize = '.$args['textSize'].'; 
                var url = "'.BESTOFBETS_PLUGIN_URL.'/inc/shortcodes/includes/post.php";
                var home_page_link = "'.get_home_url().'";
                var current_page_link = "'.$current_page_link.'";
                var base_url = "'.$base_url.'";
                var production_username = "'.$production_username.'";
                var production_password = "'.$production_password.'";
                var BESTOFBETS_PLUGIN_URL = "'.BESTOFBETS_PLUGIN_URL.'";

            
                const populateSecondTab1 = setTimeout(populateSecondTabFunction1, 0);
            
                function populateSecondTabFunction1() {
            
                    let day = "today";
                    let date = "'.$today.'";
                    let big_races_date = "'.$today.'";
            
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {date, day, big_races_date, color, textSize, home_page_link, current_page_link, base_url, production_username,production_password, BESTOFBETS_PLUGIN_URL}, 
                        success: function(result)
                        {
                        document.getElementById("Section1").innerHTML = result;
                        }
                    });
            
                clearTimeout(populateSecondTab1);
            
                }

            
                const populateSecondTab2 = setTimeout(populateSecondTabFunction2, 1000);
            
                function populateSecondTabFunction2() {
            
                    let day = "tomorrow";
                    let date = "'.$tomorrow.'";
                    let big_races_date = "'.$tomorrow.'";
            
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {date, day, big_races_date, color, textSize, home_page_link, current_page_link, base_url, production_username,production_password, BESTOFBETS_PLUGIN_URL}, 
                        success: function(result)
                        {
                        document.getElementById("Section2").innerHTML = result;
                        }
                    });
            
                clearTimeout(populateSecondTab2);
            
                }

            
                const populateSecondTab3 = setTimeout(populateSecondTabFunction3, 2000);
            
                function populateSecondTabFunction3() {
            
                    let day = "day_after_tomorrow";
                    let date = "'.$day_after_tomorrow.'";
                    let big_races_date = "'.$day_after_tomorrow.'";
            
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {date, day, big_races_date, color, textSize, home_page_link, current_page_link, base_url, production_username,production_password, BESTOFBETS_PLUGIN_URL}, 
                        success: function(result)
                        {
                        document.getElementById("Section3").innerHTML = result;
                        }
                    });
            
                clearTimeout(populateSecondTab3);
            
                }

            
                const populateSecondTab4 = setTimeout(populateSecondTabFunction4, 3000);
            
                function populateSecondTabFunction4() {
            
                    let day = "next_third_day";
                    let date = "'.$next_third_day.'";
                    let big_races_date = "'.$next_third_day.'";
            
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {date, day, big_races_date, color, textSize, home_page_link, current_page_link, base_url, production_username,production_password, BESTOFBETS_PLUGIN_URL}, 
                        success: function(result)
                        {
                        document.getElementById("Section4").innerHTML = result;
                        }
                    });
            
                clearTimeout(populateSecondTab4);
            
                }

            
                const populateSecondTab5 = setTimeout(populateSecondTabFunction5, 4000);
            
                function populateSecondTabFunction5() {
            
                    let day = "next_fourth_day";
                    let date = "'.$next_fourth_day.'";
                    let big_races_date = "'.$next_fourth_day.'";
            
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {date, day, big_races_date, color, textSize, home_page_link, current_page_link, base_url, production_username,production_password, BESTOFBETS_PLUGIN_URL}, 
                        success: function(result)
                        {
                        document.getElementById("Section5").innerHTML = result;
                        }
                    });
            
                clearTimeout(populateSecondTab5);
            
                }
            
            
        
            
            });
            
            </script>';


        }




        // checking URL extensions
        else if( isset($_GET['course']) && isset($_GET['off_time']) && isset($_GET['date']) ){
            $course_id = $_GET['course'];
            $off_time = $_GET['off_time'];
            $date = $_GET['date'];

            if($course_id != '' && $off_time != '' && $date != ''){

                // echo $course_id;
                // echo $off_time;
                // echo $date;

                $base_url = get_option(BESTOFBETS_PLUGIN_NAME . '_base_url');
                $production_username = get_option(BESTOFBETS_PLUGIN_NAME . '_production_username');
                $production_password = get_option(BESTOFBETS_PLUGIN_NAME . '_production_password');

                echo '<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>';
                echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';

                try {      
                    
                    // Read the JSON file 
                    // $response = file_get_contents( BESTOFBETS_PLUGIN_URL .'/inc/shortcodes/includes/example-responses-json/standard-racecards.json');

                    if(isset($_GET['big_race']) && $_GET['big_race'] == 1){

                        // Read the JSON file 
                        $response = file_get_contents( BESTOFBETS_PLUGIN_URL .'/inc/shortcodes/includes/json-responses/big-races-racecards/'.$date.'.json');

                        // $big_races_date = strtotime($date);
                        // $big_races_date = date("Y-m-d", $big_races_date);
                        
                        // $ApiQuery = new ApiQueries;
                        // $response = $ApiQuery->big_races_by_date($big_races_date, $base_url, $production_username, $production_password);

                    }else{

                        // Read the JSON file 
                        $response = file_get_contents( BESTOFBETS_PLUGIN_URL .'/inc/shortcodes/includes/json-responses/all-racecards/'.$date.'.json');

                        // $ApiQuery = new ApiQueries;
                        // $response = $ApiQuery->race_cards_by_date($date, $base_url, $production_username, $production_password);

                    }



                } catch (PDOException $e) {

                    $pageHTML .= "Error: " . $e->getMessage();
        
                }finally{

                    $raceResults = json_decode($response, true);

                    if(isset($raceResults["racecards"][0]["race_id"])){
                        $color = $args['color'];
                        $textSize = $args['textSize'];
                        $MakeHtmlTable = new MakeHtmlTable;
                        $raceResults = $MakeHtmlTable->make_odds_table_from_array($raceResults, $color, $textSize, $course_id, $off_time, $date, $horse_racing_home_url );
                        $pageHTML .= $raceResults;
                    }else{
                        $pageHTML .= "<h6 class='text-center'>No Races Found!</h6>";
                        $pageHTML .= "<h3 class='text-center back_heading'><a href='".$horse_racing_home_url."'>Back To Horse Racing Home</a></h3>";
                    }

                }
            }else{
                $pageHTML .= "<h6 class='text-center'>No Races Found!</h6>";
                $pageHTML .= "<h3 class='text-center back_heading'><a href='".$horse_racing_home_url."'>Back To Horse Racing Home</a></h3>";
            }


        }




        return $pageHTML;

      }
      // end of shortcode function


