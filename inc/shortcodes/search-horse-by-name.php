<?php
    // shortcode function starts here
    function searchHorseByName($attr) {

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


        echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">';
        // echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">';

        $base_url = get_option(BESTOFBETS_PLUGIN_NAME . '_base_url');
        $production_username = get_option(BESTOFBETS_PLUGIN_NAME . '_production_username');
        $production_password = get_option(BESTOFBETS_PLUGIN_NAME . '_production_password');
        $current_page_link = get_page_link();
        $horse_racing_home_url = site_url() . get_option(BESTOFBETS_PLUGIN_NAME . '_racing_home_url_slug');
        $home_page_link = get_home_url();


        $horse_id = '';
        
        // checking URL extensions
        if( isset($_GET['horse_id'])){
            $horse_id = $_GET['horse_id'];
        }

        
        if($horse_id == ''){

            // echo '<br>';
            // echo $horse_racing_home_url;

            echo '<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>';
            echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';



            $pageHTML .= "<h2 class='elementor-heading-title elementor-size-default search_horse_margin_heading'>Search Horse By Name</h2>";

            $pageHTML .= '<div class="container search-horse-page">
                <div class="row height d-flex justify-content-center align-items-center">
                    <div class="col-md-offset-2 col-md-6">
                        <form id="search-horse-page-form" class="search" onsubmit="return false">
                            <i class="fa fa-search"></i>
                            <input id="search-horse-page-form-input" type="text" class="form-control api_search_input" placeholder="Put Horse Name Here...">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>
            </div>';

            $pageHTML .= '<div id="horse_search_result" class="container">
            </div>';

            $pageHTML .= "<h3 class='text-center back_heading time_analysis_back_heading'><a href='".$home_page_link."'>Back To Homepage</a></h3>";

            $pageHTML .= '<script>
                $(document).ready(function(){

                    var color = "'.$args['color'].'"; 
                    var textSize = '.$args['textSize'].'; 
                    var url = "'.BESTOFBETS_PLUGIN_URL.'/inc/shortcodes/includes/post.php";
                    var home_page_link = "'.get_home_url().'";
                    var current_page_link = "'.$current_page_link.'";
                    var base_url = "'.$base_url.'";
                    var production_username = "'.$production_username.'";
                    var production_password = "'.$production_password.'";
                    var BESTOFBETS_PLUGIN_URL = "'.BESTOFBETS_PLUGIN_URL.'";

                    $("#search-horse-page-form").submit(function(){
                        let horse_search_query = $("#search-horse-page-form-input").val();
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {horse_search_query, color, textSize, base_url, production_username, production_password, home_page_link, current_page_link}, 
                            success: function(result)
                            {
                            document.getElementById("horse_search_result").innerHTML = result;
                            }
                        });
                    });

                });
            </script>';

        }else {
        
        // else if( $horse_id != ''){

            echo '<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>';
            echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';

            $pageHTML .= "<h2 class='elementor-heading-title elementor-size-default search_horse_margin_heading'>Time Analysis</h2>";

            try { 

                $ApiQuery = new ApiQueries;
                $response = $ApiQuery->horse_time_analysis($horse_id, $base_url, $production_username, $production_password);

            }catch (PDOException $e) {

                $pageHTML .= "Error: " . $e->getMessage();
    
            }finally{  

                $horse_time_analysis_response = json_decode($response, true);

                if(isset($horse_time_analysis_response["id"])){
                    // $pageHTML .= $horse_time_analysis_response["total_runs"];
                    $MakeHtmlTable = new MakeHtmlTable;
                    $horse_time_analysis_table = $MakeHtmlTable->horse_time_analysis_table($horse_time_analysis_response, $color, $textSize, $current_page_link, BESTOFBETS_PLUGIN_URL);
                    $pageHTML .= $horse_time_analysis_table;
                }else{
                    $pageHTML .= "<h6 class='text-center no_races_found'>No Results Found!</h6>";
                    $pageHTML .= "<h3 class='text-center back_heading'><a href='".$home_page_link."'>Back To Homepage</a></h3>";
                }


            }


        }   

        return $pageHTML;

      }
      // end of shortcode function


