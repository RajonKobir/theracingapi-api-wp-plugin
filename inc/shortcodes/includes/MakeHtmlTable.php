<?php
class MakeHtmlTable
{
    public function make_html_from_array($raceResults, $bigRaceResults, $color, $textSize, $current_page_link, $date, $day, $BESTOFBETS_PLUGIN_URL )
    {
        try {

            // making HTML table
            $pageHTML = '';

            if( isset($bigRaceResults["racecards"]) ){
                $bigRaceResults = $bigRaceResults["racecards"];
            }else{
                $bigRaceResults = array();
            }


            $pageHTML .= "<h2 class='text-left horse_racing_heading'>Main Events</h2>";
            $pageHTML .= "<div class='table table-borderless horse_racing_table'>";

            $pageHTML .= "<div>";

            // initializing 
            $previous_course_big_races = '';

            if(count($bigRaceResults) != 0){
                //Loop through the API results
                foreach($bigRaceResults as $key => $bigRaceResult) {

                    $region_lists = file_get_contents( $BESTOFBETS_PLUGIN_URL .'/inc/shortcodes/includes/json-responses/all-region-list.json');
                    $region_lists = json_decode($region_lists, true);
                    $country_code = '';
                    foreach($region_lists as $single_region){
                        if(strtoupper($single_region["region_code"]) == strtoupper($bigRaceResult["region"]) ){
                            $country_code = strtoupper($single_region["region_code_freakflagsprite"]);
                            break;
                        }
                    }

                    // $raceResult["id_race"] = 207660;
                    $single_race_link = $current_page_link."?course=".$bigRaceResult["course_id"]."&off_time=".$bigRaceResult["off_time"]."&date=".$day."&big_race=1";
                    // $single_race_link = $current_page_link."?course=".$bigRaceResult["course"]."&off_time=".$bigRaceResult["off_time"]."&date=".$date."&big_race=1";
                    // $single_race_link = "#";

                    if($previous_course_big_races == ''){

                        $pageHTML .= "<div class='courses_tr last_course_gb_and_ire' style=' color:".$color."; font-size:".$textSize."px; '>";
                        $pageHTML .= "<div class='venu_details'>";
                        $pageHTML .= "<span class='title_flag fflag fflag-".$country_code." ff-lg ff-wave ff-round'></span>";
                        $pageHTML .= "<span class='course_title'>".$bigRaceResult["course"]."</span>";
                        $pageHTML .= "</div>";
                        $pageHTML .= "<div class='all_off_times'>";
                        $pageHTML .= "<div class='text-center odds_td'><a href='".$single_race_link."' >".$bigRaceResult["off_time"]."</a></div>";
                        $previous_course_big_races = $bigRaceResult["course"];
                    }
                    else if($previous_course_big_races != '' && $previous_course_big_races != $bigRaceResult["course"]){
                        $pageHTML .= "</div>";
                        $pageHTML .= "</div>";
                        $pageHTML .= "<div class='courses_tr last_course_gb_and_ire' style=' color:".$color."; font-size:".$textSize."px; '>";
                        $pageHTML .= "<div class='venu_details'>";
                        $pageHTML .= "<span class='title_flag fflag fflag-".$country_code." ff-lg ff-wave ff-round'></span>";
                        $pageHTML .= "<span class='course_title'>".$bigRaceResult["course"]."</span>";
                        $pageHTML .= "</div>";
                        $pageHTML .= "<div class='all_off_times'>";
                        $pageHTML .= "<div class='text-center odds_td'><a href='".$single_race_link."' >".$bigRaceResult["off_time"]."</a></div>";
                        $previous_course_big_races = $bigRaceResult["course"];
                    }
                    else{
                        $pageHTML .= "<div class='text-center odds_td'><a href='".$single_race_link."' >".$bigRaceResult["off_time"]."</a></div>";
                    }
                }
            }else{
                $pageHTML .= "<div class='courses_tr last_course_gb_and_ire'>";
                $pageHTML .= "<div>No Races At The Moment!</div>";
                $pageHTML .= "</div>";
            }



            $pageHTML .= "</div>"; // all_off_times div ends here
            $pageHTML .= "</div>";
            $pageHTML .= "</div>";



            // if non empty
            if( isset($raceResults["racecards"]) ){
                $raceResults = $raceResults["racecards"];
            }else{
                $raceResults = array();
            }

            // sorting according to the off_time
            array_multisort(array_column($raceResults, 'off_time'), SORT_ASC, $raceResults);

            // initializing 
            $course = '';
            $gb_and_ire_course_array = array();
            $international_course_array = array();

            //Loop through the API results
            foreach($raceResults as $key => $raceResult) {
            
                if(strtolower($raceResult["region"]) == 'gb' || strtolower($raceResult["region"]) == 'ire'){

                    if($course == '' || $course != $raceResult['course']){
                        $course = $raceResult['course'];
                    }

                    // array_push($gb_and_ire_course_array, $raceResult);
                    $gb_and_ire_course_array[$course][$key] = $raceResult;
                    
                }else {

                    if($course == '' || $course != $raceResult['course']){
                        $course = $raceResult['course'];
                    }

                    // array_push($international_course_array, $raceResult);
                    $international_course_array[$course][$key] = $raceResult;

                }

            }

            // array_multisort(array_column($gb_and_ire_course_array, 'off_time'), SORT_ASC, $gb_and_ire_course_array);

            // array_multisort(array_column($gb_and_ire_course_array, 'course'), SORT_STRING, $gb_and_ire_course_array);

            // var_dump($gb_and_ire_course_array["Lingfield (AW)"]);


            $pageHTML .= "<h2 class='text-left horse_racing_heading'>UK & Ireland Horse Racing</h2>";
            $pageHTML .= "<div class='table table-borderless horse_racing_table'>";

            $pageHTML .= "<div>";

            // initializing 
            $previous_course_gb_and_ire = '';

            if(count($gb_and_ire_course_array) != 0){
                //Loop through the API results
                foreach($gb_and_ire_course_array as $key => $raceResult_gb_and_ire_races) {
                foreach($raceResult_gb_and_ire_races as $key => $raceResult_gb_and_ire) {

                    $region_lists = file_get_contents( $BESTOFBETS_PLUGIN_URL .'/inc/shortcodes/includes/json-responses/all-region-list.json');
                    $region_lists = json_decode($region_lists, true);
                    $country_code = '';
                    foreach($region_lists as $single_region){
                        if(strtoupper($single_region["region_code"]) == strtoupper($raceResult_gb_and_ire["region"]) ){
                            $country_code = strtoupper($single_region["region_code_freakflagsprite"]);
                            break;
                        }
                    }

                    // $raceResult["id_race"] = 207660;
                    $single_race_link = $current_page_link."?course=".$raceResult_gb_and_ire["course_id"]."&off_time=".$raceResult_gb_and_ire["off_time"]."&date=".$day;
                    // $single_race_link = $current_page_link."?course=".$raceResult_gb_and_ire["course"]."&off_time=".$raceResult_gb_and_ire["off_time"]."&date=".$date;
                    // $single_race_link = "#";

                    if($previous_course_gb_and_ire == ''){

                        $pageHTML .= "<div class='courses_tr last_course_gb_and_ire' style=' color:".$color."; font-size:".$textSize."px; '>";
                        $pageHTML .= "<div class='venu_details'>";
                        $pageHTML .= "<span class='title_flag fflag fflag-".$country_code." ff-lg ff-wave ff-round'></span>";
                        $pageHTML .= "<span class='course_title'>".$raceResult_gb_and_ire["course"]."</span>";
                        $pageHTML .= "</div>";
                        $pageHTML .= "<div class='all_off_times'>";
                        $pageHTML .= "<div class='text-center odds_td'><a href='".$single_race_link."' >".$raceResult_gb_and_ire["off_time"]."</a></div>";
                        $previous_course_gb_and_ire = $raceResult_gb_and_ire["course"];
                    }
                    else if($previous_course_gb_and_ire != '' && $previous_course_gb_and_ire != $raceResult_gb_and_ire["course"]){
                        $pageHTML .= "</div>";
                        $pageHTML .= "</div>";
                        $pageHTML .= "<div class='courses_tr last_course_gb_and_ire' style=' color:".$color."; font-size:".$textSize."px; '>";
                        $pageHTML .= "<div class='venu_details'>";
                        $pageHTML .= "<span class='title_flag fflag fflag-".$country_code." ff-lg ff-wave ff-round'></span>";
                        $pageHTML .= "<span class='course_title'>".$raceResult_gb_and_ire["course"]."</span>";
                        $pageHTML .= "</div>";
                        $pageHTML .= "<div class='all_off_times'>";
                        $pageHTML .= "<div class='text-center odds_td'><a href='".$single_race_link."' >".$raceResult_gb_and_ire["off_time"]."</a></div>";
                        $previous_course_gb_and_ire = $raceResult_gb_and_ire["course"];
                    }
                    else{
                        $pageHTML .= "<div class='text-center odds_td'><a href='".$single_race_link."' >".$raceResult_gb_and_ire["off_time"]."</a></div>";
                    }
                }
                }
            }else{
                $pageHTML .= "<div class='courses_tr last_course_gb_and_ire'>";
                $pageHTML .= "<div>No Races At The Moment!</div>";
                $pageHTML .= "</div>";
            }



            $pageHTML .= "</div>"; // all_off_times div ends here
            $pageHTML .= "</div>";
            $pageHTML .= "</div>";





            $pageHTML .= "<h2 class='text-left horse_racing_heading'>International Horse Racing</h2>";
            $pageHTML .= "<div class='table table-borderless horse_racing_table'>";

            $pageHTML .= "<div>";

            // initializing 
            $previous_course_international = '';

            if(count($international_course_array) != 0){
                //Loop through the API results
                foreach($international_course_array as $key => $raceResult_international_courses) {
                foreach($raceResult_international_courses as $key => $raceResult_international) {

                    $region_lists = file_get_contents( $BESTOFBETS_PLUGIN_URL .'/inc/shortcodes/includes/json-responses/all-region-list.json');
                    $region_lists = json_decode($region_lists, true);
                    $country_code = '';
                    foreach($region_lists as $single_region){
                        if(strtoupper($single_region["region_code"]) == strtoupper($raceResult_international["region"]) ){
                            $country_code = strtoupper($single_region["region_code_freakflagsprite"]);
                            break;
                        }
                    }

                    // $raceResult["id_race"] = 207660;
                    $single_race_link = $current_page_link."?course=".$raceResult_international["course_id"]."&off_time=".$raceResult_international["off_time"]."&date=".$day;
                    // $single_race_link = $current_page_link."?course=".$raceResult_international["course"]."&off_time=".$raceResult_international["off_time"]."&date=".$date;
                    // $single_race_link = "#";

                    if($previous_course_international == ''){

                        $pageHTML .= "<div class='courses_tr last_course_international' style=' color:".$color."; font-size:".$textSize."px; '>";
                        $pageHTML .= "<div class='venu_details'>";
                        $pageHTML .= "<span class='title_flag title_flag_international fflag fflag-".$country_code." ff-lg ff-wave ff-round'></span>";
                        $pageHTML .= "<span class='course_title international_course_title'>".$raceResult_international["course"]."</span>";
                        $pageHTML .= "</div>";
                        $pageHTML .= "<div class='all_off_times'>";
                        $pageHTML .= "<div class='text-center odds_td'><a href='".$single_race_link."' >".$raceResult_international["off_time"]."</a></div>";
                        $previous_course_international = $raceResult_international["course"];
                    }
                    else if($previous_course_international != '' && $previous_course_international != $raceResult_international["course"]){
                        $pageHTML .= "</div>";
                        $pageHTML .= "</div>";
                        $pageHTML .= "<div class='courses_tr last_course_international' style=' color:".$color."; font-size:".$textSize."px; '>";
                        $pageHTML .= "<div class='venu_details'>";
                        $pageHTML .= "<span class='title_flag title_flag_international fflag fflag-".$country_code." ff-lg ff-wave ff-round'></span>";
                        $pageHTML .= "<span class='course_title international_course_title'>".$raceResult_international["course"]."</span>";
                        $pageHTML .= "</div>";
                        $pageHTML .= "<div class='all_off_times'>";
                        $pageHTML .= "<div class='text-center odds_td'><a href='".$single_race_link."' >".$raceResult_international["off_time"]."</a></div>";
                        $previous_course_international = $raceResult_international["course"];
                    }
                    else{
                        $pageHTML .= "<div class='text-center odds_td'><a href='".$single_race_link."' >".$raceResult_international["off_time"]."</a></div>";
                    }
                }
                }
            }else{
                $pageHTML .= "<div class='courses_tr last_course_international'>";
                $pageHTML .= "<div>No Races At The Moment!</div>";
                $pageHTML .= "</div>";
            }



            $pageHTML .= "</div>"; // all_off_times div ends here
            $pageHTML .= "</div>";
            $pageHTML .= "</div>";




            $result = $pageHTML;



        } catch (PDOException $e) {

            $result = "Error: " . $e->getMessage();

        }

        return $result;

    }



    
    public function make_odds_table_from_array($raceResults, $color, $textSize, $course, $off_time, $day, $current_page_link )
    {
        try {

            // initializing 
            $pageHTML = '';

            //Create the WordPress page content HTML
            $pageHTML .= "<h2 class='elementor-heading-title elementor-size-default special_margin_heading special_margin_heading_odds_table_page'>Live Horse Racing Odds</h2>";
            $pageHTML .= "<div class='tab horse_racing_odds_table_tab' role='tabpanel'>";
            $pageHTML .= "<ul class='nav nav-tabs horse_racing_odds_table_nav' role='tablist'>";

            $section_id = 1;

            //Loop through the API results
            foreach($raceResults["racecards"] as $raceResult) {

                if($raceResult["course_id"] == $course){

                    $active_class = $raceResult["off_time"] == $off_time ? 'active' : '';
                    
                    $pageHTML .= "<li role='presentation' class='nav-item horse_racing_odds_table_nav_li ".$active_class."'><a id='section_".$section_id."' class='nav-link ' href='#Section".$section_id."' aria-controls='profile' role='tab' data-toggle='tab'>".$raceResult["off_time"]."</a></li>";

                    $section_id++;

                }

            }

            $pageHTML .= "</ul>";



            $pageHTML .= "<div class='tab-content tabs horse_racing_odds_table_tab_contents'>";

            $section_id = 1;

            //Loop through the API results
            foreach($raceResults["racecards"] as $raceResult) {

                if($raceResult["course_id"] == $course){

                    $region_lists = file_get_contents( BESTOFBETS_PLUGIN_URL .'/inc/shortcodes/includes/json-responses/all-region-list.json');
                    $region_lists = json_decode($region_lists, true);
                    $country_code = '';
                    foreach($region_lists as $single_region){
                        if(strtoupper($single_region["region_code"]) == strtoupper($raceResult["region"]) ){
                            $country_code = strtoupper($single_region["region_code_freakflagsprite"]);
                            break;
                        }
                    }

                    $active_class = $raceResult["off_time"] == $off_time ? 'active' : '';
                    
                    $pageHTML .= "<div role='tabpanel' class='tab-pane horse_racing_odds_table_tabpan fade in ".$active_class."' id='Section".$section_id."'>";

                    $pageHTML .= "<table class='table table-striped special_horse_racing_table'>";
                    $pageHTML .= "<thead class='special_horse_racing_table_thead'>";
                    $pageHTML .= "<tr class='special_horse_racing_table_thead_tr'>";
                    
                    $pageHTML .= "<th class='single_course_flag_th'><div class='fflag fflag-".$country_code." ff-lg ff-wave ff-round'></div></th>";
                    $pageHTML .= "<th class='single_course_title' colspan='2'><h2 class='text-left horse_racing_course_heading'>".$raceResult["course"]."</h2></th>";


                    // initializing 
                    $available_bookies = array(

                        "williamhill" => "https://promotion.williamhill.com/uk/sports/football/aff/r30?btag=a_194415b_815c_&utm_source=incomeaccess&utm_medium=affiliates&utm_campaign=815&utm_term=194415&utm_content=1740337&siteid=194415&tgclid=0e01001a-fad9-48ec-ab00-121963e4f98f",

                        "888sport" => "https://www.888casino.com/exclusive-mob/casino-88-200-300.htm?utm_campaign=100137765_1861017_nodescription&utm_content=100137765&utm_medium=casap&utm_source=aff",

                        "betvictor" => "https://www.betvictor.com/aff/casino-p-welcome-offer-aviator?btagid=91791563&btag=a_58269b_11810c_&affid=26909&nid=2&mid=2",

                        "unibet" => "https://b1.trickyrock.com/redirect.aspx?pid=93675843&bid=3189",

                        "betfred" => "https://bfpartners.click/o/KhVuIi?site_id=106045",

                        "boylesports" => "https://ads.boylesports.com/redirect.aspx?pid=44656&bid=6041",

                        "10bet" => "https://track.10bet.com/C.ashx?btag=a_57406b_5968c_&affid=1682122&siteid=57406&adid=5968&c=",

                        "betuk" => "https://www.betuk.com/?btag=100665302_27A73DE3BB43493BB97FC416A19A878B&pid=3748405&bid=18479",

                    );



                    // $pageHTML .= "<th class='rotate_th bet365'><aside><a class='rotate_th_a'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/bet365.svg' alt='Bookie Image' ></a></aside></th>";
                    // $pageHTML .= "<th class='rotate_th skybet'><aside><a class='rotate_th_a'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/skybet.svg' alt='Bookie Image' ></a></aside></th>";
                    
                    // $pageHTML .= "<th class='rotate_th paddypower'><aside><a class='rotate_th_a'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/paddypower.svg' alt='Bookie Image' ></a></aside></th>";

                    $pageHTML .= "<th class='rotate_th williamhill'><aside><a class='rotate_th_a' target='_blank' href='".$available_bookies["williamhill"]."'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/williamhill.svg' alt='Bookie Image' ></a></aside></th>";
                    
                    $pageHTML .= "<th class='rotate_th s888sport'><aside><a class='rotate_th_a' target='_blank' href='".$available_bookies["888sport"]."'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/888sport.svg' alt='Bookie Image' ></a></aside></th>";

                    // $pageHTML .= "<th class='rotate_th betfair'><aside><a class='rotate_th_a'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/betfair.svg' alt='Bookie Image' ></a></aside></th>";
                    
                    $pageHTML .= "<th class='rotate_th betvictor'><aside><a class='rotate_th_a' target='_blank' href='".$available_bookies["betvictor"]."'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/betvictor.svg' alt='Bookie Image' ></a></aside></th>";

                    // $pageHTML .= "<th class='rotate_th coral'><aside><a class='rotate_th_a'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/coral.svg' alt='Bookie Image' ></a></aside></th>";
                    
                    $pageHTML .= "<th class='rotate_th unibet'><aside><a class='rotate_th_a' target='_blank' href='".$available_bookies["unibet"]."'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/unibet.svg' alt='Bookie Image' ></a></aside></th>";

                    // $pageHTML .= "<th class='rotate_th spreadex'><aside><a class='rotate_th_a'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/spreadex.svg' alt='Bookie Image' ></a></aside></th>";
                    
                    $pageHTML .= "<th class='rotate_th betfred'><aside><a class='rotate_th_a' target='_blank' href='".$available_bookies["betfred"]."'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/betfred.svg' alt='Bookie Image' ></a></aside></th>";
                    
                    $pageHTML .= "<th class='rotate_th boylesports'><aside><a class='rotate_th_a' target='_blank' href='".$available_bookies["boylesports"]."'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/boylesports.svg' alt='Bookie Image' ></a></aside></th>";
                    
                    $pageHTML .= "<th class='rotate_th a10bet'><aside><a class='rotate_th_a' target='_blank' href='".$available_bookies["10bet"]."'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/10bet.svg' alt='Bookie Image' ></a></aside></th>";

                    // $pageHTML .= "<th class='rotate_th starsports'><aside><a class='rotate_th_a'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/starsports.svg' alt='Bookie Image' ></a></aside></th>";
                    
                    $pageHTML .= "<th class='rotate_th betuk'><aside><a class='rotate_th_a' target='_blank' href='".$available_bookies['betuk']."'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/betuk.svg' alt='Bookie Image' ></a></aside></th>";

                    // $pageHTML .= "<th class='rotate_th sportingindex'><aside><a class='rotate_th_a'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/sportingindex.svg' alt='Bookie Image' ></a></aside></th>";
                    
                    // $pageHTML .= "<th class='rotate_th livescorebet'><aside><a class='rotate_th_a'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/livescorebet.svg' alt='Bookie Image' ></a></aside></th>";
                    // $pageHTML .= "<th class='rotate_th quinnbet'><aside><a class='rotate_th_a'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/quinnbet.svg' alt='Bookie Image' ></a></aside></th>";
                    
                    // $pageHTML .= "<th class='rotate_th betway'><aside><a class='rotate_th_a'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/betway.svg' alt='Bookie Image' ></a></aside></th>";
                    // $pageHTML .= "<th class='rotate_th ladbrokes'><aside><a class='rotate_th_a'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/ladbrokes.svg' alt='Bookie Image' ></a></aside></th>";
                    
                    // $pageHTML .= "<th class='rotate_th parimatch'><aside><a class='rotate_th_a'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/parimatch.svg' alt='Bookie Image' ></a></aside></th>";
                    // $pageHTML .= "<th class='rotate_th vbet'><aside><a class='rotate_th_a'><img src='".BESTOFBETS_PLUGIN_URL."public/images/bookmakers/vbet.svg' alt='Bookie Image' ></a></aside></th>";

                    $pageHTML .= "</tr>";

                    $pageHTML .= "<tr style='height: 50px;' class='special_horse_racing_table_gap'>";
                    $pageHTML .= "</tr>";

                    $pageHTML .= "<tr style='display: none;' class='special_horse_racing_display_none'>";
                    $pageHTML .= "<th colspan='3' class='special_horse_racing_display_none_th special_horse_racing_display_none_results'>Results</th>";
                    $pageHTML .= "<th colspan='8' class='special_horse_racing_display_none_th special_horse_racing_display_none_best_odds'>Best Odd</th>";
                    $pageHTML .= "</tr>";


                    $pageHTML .= "</thead>";
                    $pageHTML .= "<tbody class='special_horse_racing_table_tbody'>";

                    // initializing 
                    $horses = array();
                    $horses = $raceResult["runners"];


                    foreach($horses as $horse_key => $horse) {

                        // initializing 
                        $existed_bookie = array();
                        $all_odds = array();

                        // if(count($horse["odds"]) != 0){
                            // loop through the odds
                            foreach($horse["odds"] as $odd_key => $single_odd) {

                                $existed_single_bookie = preg_replace('/\s+/','', strtolower($single_odd["bookmaker"]));

                                if(array_key_exists($existed_single_bookie, $available_bookies)){
                                    $existed_bookie[$odd_key] = $existed_single_bookie;
                                    $all_odds[$odd_key] = is_numeric($single_odd["decimal"]) == 'true' ? $single_odd["decimal"] : 0;
                                }

                            }

                            if(count($all_odds) != 0){

                                $best_odd_key = array_search(max($all_odds), $all_odds);
                                $best_odd_decimal = $horse["odds"][$best_odd_key]["decimal"] == '' ? 0 : $horse["odds"][$best_odd_key]["decimal"];
                                $best_odd_fractional = $horse["odds"][$best_odd_key]["fractional"] == '' ? $best_odd_decimal : $horse["odds"][$best_odd_key]["fractional"];
                                $best_bookie_name = preg_replace('/\s+/','', strtolower($horse['odds'][$best_odd_key]['bookmaker']));
        
                                $horses[$horse_key]["best_odd"]["decimal"] =  $best_odd_decimal;
                                $horses[$horse_key]["best_odd"]["fractional"] =  $best_odd_fractional;
                                $horses[$horse_key]["best_bookie_name"] =  $best_bookie_name;
                                $horses[$horse_key]["best_odd_value"] =  $best_odd_decimal;

                            }else{

                                $horses[$horse_key]["best_odd"]["decimal"] =  '';
                                $horses[$horse_key]["best_odd"]["fractional"] =  '';
                                $horses[$horse_key]["best_bookie_name"] =  '';
                                $horses[$horse_key]["best_odd_value"] =  '';

                            }

                        // }

                    }

                    // sorting according to the off_time
                    // if(isset($horses[0]["best_odd_value"])){
                        array_multisort(array_column($horses, 'best_odd_value'), SORT_ASC, SORT_NUMERIC, $horses);
                    // }

                    // var_dump($horses);
    
                    $serial = 1;
                    //Loop through the API results
                    foreach($horses as $key => $horse) {

                        $pageHTML .= "<tr class='odds_tr' style=' color:".$color."; font-size:".($textSize-1)."px; '>";
                        // $pageHTML .= "<td class='silk_serial_td'>".$horse['best_odd']['fractional']."</td>";
                        // $pageHTML .= "<td class='silk_serial_td'>".$serial."</td>";
                        $pageHTML .= "<td class='silk_serial_td'>".$horse['number']."</td>";
                        $pageHTML .= "<td class='silk_image_td'><img class='silk_image' src='".$horse["silk_url"]."' alt='Silk Image' width='50' height='40'></td>";
                        // $pageHTML .= "<td class='jockey_info_td'><span class='horse_title'>".$horse["horse"]."&nbsp;(".$horse["number"].")</span><br><span class='jockey_title'>".$horse["jockey"]."</span></td>";
                        $pageHTML .= "<td class='jockey_info_td'><span class='horse_title'>".$horse["horse"]."</span><br><span class='jockey_title'>".$horse["jockey"]."</span></td>";

                        if(count($horse["odds"]) != 0){

                            $pageHTML .= "<td class='special_table_best_odd' style='display: none;'><a target='_blank' href='".$available_bookies[$horse['best_bookie_name']]."'>".$horse['best_odd']['fractional']."</a></td>";

                            // if (in_array(strtolower("Bet365"), $existed_bookie)){
                            //     $key = array_search(strtolower("Bet365"), $existed_bookie);
                            //     $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                            //     $pageHTML .= "<td class='text-center info border-white odds_td'>".$odd_value."</td>";
                            // }else{
                            //     $pageHTML .= "<td class='text-center info border-white odds_td'>&cross;</td>";
                            // }

                            // if (in_array(strtolower("skybet"), $existed_bookie)){
                            //     $key = array_search(strtolower("skybet"), $existed_bookie);
                            //     $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>".$odd_value."</td>";
                            // }else{
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>&cross;</td>";
                            // }

                            // if (in_array(strtolower("paddypower"), $existed_bookie)){
                            //     $key = array_search(strtolower("paddypower"), $existed_bookie);
                            //     $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                            //     $pageHTML .= "<td class='text-center info border-white odds_td'>".$odd_value."</td>";
                            // }else{
                            //     $pageHTML .= "<td class='text-center info border-white odds_td'>&cross;</td>";
                            // }

                            if (in_array(strtolower("williamhill"), $existed_bookie)){
                                $key = array_search(strtolower("williamhill"), $existed_bookie);
                                $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                                $pageHTML .= "<td class='text-center info border-white odds_td'><a target='_blank' href='".$available_bookies['williamhill']."'>".$odd_value."</a></td>";
                            }else{
                                $pageHTML .= "<td class='text-center info border-white odds_td'>&cross;</td>";
                            }

                            if (in_array(strtolower("888sport"), $existed_bookie)){
                                $key = array_search(strtolower("888sport"), $existed_bookie);
                                $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                                $pageHTML .= "<td class='text-center danger border-white odds_td'><a target='_blank' href='".$available_bookies['888sport']."'>".$odd_value."</a></td>";
                            }else{
                                $pageHTML .= "<td class='text-center danger border-white odds_td'>&cross;</td>";
                            }

                            // if (in_array(strtolower("betfairSportsbook"), $existed_bookie)){
                            //     $key = array_search(strtolower("betfairSportsbook"), $existed_bookie);
                            //     $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>".$odd_value."</td>";
                            // }else{
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>&cross;</td>";
                            // }

                            if (in_array(strtolower("betvictor"), $existed_bookie)){
                                $key = array_search(strtolower("betvictor"), $existed_bookie);
                                $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                                $pageHTML .= "<td class='text-center info border-white odds_td'><a target='_blank' href='".$available_bookies['betvictor']."'>".$odd_value."</a></td>";
                            }else{
                                $pageHTML .= "<td class='text-center info border-white odds_td'>&cross;</td>";
                            }

                            // if (in_array(strtolower("coral"), $existed_bookie)){
                            //     $key = array_search(strtolower("coral"), $existed_bookie);
                            //     $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>".$odd_value."</td>";
                            // }else{
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>&cross;</td>";
                            // }

                            if (in_array(strtolower("unibet"), $existed_bookie)){
                                $key = array_search(strtolower("unibet"), $existed_bookie);
                                $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                                $pageHTML .= "<td class='text-center danger border-white odds_td'><a target='_blank' href='".$available_bookies['unibet']."'>".$odd_value."</a></td>";
                            }else{
                                $pageHTML .= "<td class='text-center danger border-white odds_td'>&cross;</td>";
                            }

                            // if (in_array(strtolower("spreadex"), $existed_bookie)){
                            //     $key = array_search(strtolower("spreadex"), $existed_bookie);
                            //     $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>".$odd_value."</td>";
                            // }else{
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>&cross;</td>";
                            // }

                            if (in_array(strtolower("betfred"), $existed_bookie)){
                                $key = array_search(strtolower("betfred"), $existed_bookie);
                                $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                                $pageHTML .= "<td class='text-center info border-white odds_td'><a target='_blank' href='".$available_bookies['betfred']."'>".$odd_value."</a></td>";
                            }else{
                                $pageHTML .= "<td class='text-center info border-white odds_td'>&cross;</td>";
                            }

                            if (in_array(strtolower("boylesports"), $existed_bookie)){
                                $key = array_search(strtolower("boylesports"), $existed_bookie);
                                $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                                $pageHTML .= "<td class='text-center danger border-white odds_td'><a target='_blank' href='".$available_bookies['boylesports']."'>".$odd_value."</a></td>";
                            }else{
                                $pageHTML .= "<td class='text-center danger border-white odds_td'>&cross;</td>";
                            }
                            
                            if (in_array(strtolower("10bet"), $existed_bookie)){
                                $key = array_search(strtolower("10bet"), $existed_bookie);
                                $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                                $pageHTML .= "<td class='text-center info border-white odds_td'><a target='_blank' href='".$available_bookies['10bet']."'>".$odd_value."</a></td>";
                            }else{
                                $pageHTML .= "<td class='text-center info border-white odds_td'>&cross;</td>";
                            }

                            // if (in_array(strtolower("starsports"), $existed_bookie)){
                            //     $key = array_search(strtolower("starsports"), $existed_bookie);
                            //     $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>".$odd_value."</td>";
                            // }else{
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>&cross;</td>";
                            // }
                            
                            if (in_array(strtolower("betuk"), $existed_bookie)){
                                $key = array_search(strtolower("betuk"), $existed_bookie);
                                $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                                $pageHTML .= "<td class='text-center danger border-white odds_td'><a target='_blank' href='".$available_bookies['betuk']."'>".$odd_value."</a></td>";
                            }else{
                                $pageHTML .= "<td class='text-center danger border-white odds_td'>&cross;</td>";
                            }

                            // if (in_array(strtolower("sportingindex"), $existed_bookie)){
                            //     $key = array_search(strtolower("sportingindex"), $existed_bookie);
                            //     $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>".$odd_value."</td>";
                            // }else{
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>&cross;</td>";
                            // }
                            
                            // if (in_array(strtolower("livescorebet"), $existed_bookie)){
                            //     $key = array_search(strtolower("livescorebet"), $existed_bookie);
                            //     $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                            //     $pageHTML .= "<td class='text-center info border-white odds_td'>".$odd_value."</td>";
                            // }else{
                            //     $pageHTML .= "<td class='text-center info border-white odds_td'>&cross;</td>";
                            // }

                            // if (in_array(strtolower("quinnbet"), $existed_bookie)){
                            //     $key = array_search(strtolower("quinnbet"), $existed_bookie);
                            //     $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>".$odd_value."</td>";
                            // }else{
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>&cross;</td>";
                            // }
                            
                            // if (in_array(strtolower("betway"), $existed_bookie)){
                            //     $key = array_search(strtolower("betway"), $existed_bookie);
                            //     $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                            //     $pageHTML .= "<td class='text-center info border-white odds_td'>".$odd_value."</td>";
                            // }else{
                            //     $pageHTML .= "<td class='text-center info border-white odds_td'>&cross;</td>";
                            // }

                            // if (in_array(strtolower("ladbrokes"), $existed_bookie)){
                            //     $key = array_search(strtolower("ladbrokes"), $existed_bookie);
                            //     $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>".$odd_value."</td>";
                            // }else{
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>&cross;</td>";
                            // }
                            
                            // if (in_array(strtolower("parimatch"), $existed_bookie)){
                            //     $key = array_search(strtolower("parimatch"), $existed_bookie);
                            //     $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                            //     $pageHTML .= "<td class='text-center info border-white odds_td'>".$odd_value."</td>";
                            // }else{
                            //     $pageHTML .= "<td class='text-center info border-white odds_td'>&cross;</td>";
                            // }

                            // if (in_array(strtolower("vbet"), $existed_bookie)){
                            //     $key = array_search(strtolower("vbet"), $existed_bookie);
                            //     $odd_value = $horse["odds"][$key]["fractional"] == '' ? $horse["odds"][$key]["decimal"] : $horse["odds"][$key]["fractional"];
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>".$odd_value."</td>";
                            // }else{
                            //     $pageHTML .= "<td class='text-center danger border-white odds_td'>&cross;</td>";
                            // }


                        }else{//if odds array is not null

                            $pageHTML .= "<td class='special_table_best_odd' style='display: none;'>&cross;</td>";
                            $pageHTML .= "<td colspan='8' class='text-center danger border-white odds_td odds_td_not_found'>No Odds Information Found For This Horse!</td>";

                        } 

    
                        $pageHTML .= "</tr>";

                        $serial++;


                    }
    
                    $pageHTML .= "</tbody>";
                    $pageHTML .= "</table>";
    
                    $pageHTML .= "</div>";

                    $section_id++;

                }

            }



            $pageHTML .= "</div>";

            $pageHTML .= "</div>";


            $pageHTML .= "<a href='".$current_page_link."'><h3 class='text-center back_heading'>Back To Horse Racing Home</h3></a>";

            $result = $pageHTML;



        } catch (PDOException $e) {

            $result = "Error: " . $e->getMessage();

        }

        return $result;

    }



    
    public function results_today_make_table($raceResults, $color, $textSize, $course, $off_time, $day, $current_page_link )
    {
        try {

            // initializing 
            $pageHTML = '';

            if(count($raceResults) != 0){

                // sorting descending order
                array_multisort(array_column($raceResults, 'off'), SORT_DESC, $raceResults);

                $pageHTML .= "<div class='accordion today_results_accordion' id='today_results_accordion'>";

                //Loop through the API results
                foreach($raceResults as $key => $raceResult) {

                    $region_lists = file_get_contents( BESTOFBETS_PLUGIN_URL .'/inc/shortcodes/includes/json-responses/all-region-list.json');
                    $region_lists = json_decode($region_lists, true);
                    $country_code = '';
                    foreach($region_lists as $single_region){
                        if(strtoupper($single_region["region_code"]) == strtoupper($raceResult["region"]) ){
                            $country_code = strtoupper($single_region["region_code_freakflagsprite"]);
                            break;
                        }
                    }

                    // $raceResult["id_race"] = 207660;
                    // $single_race_link = $current_page_link."/single-horse-racing-course?course=".$raceResult["course"]."&off_time=".$raceResult["off_time"]."&date=".$date;
                    $single_race_link = "#";

                    $pageHTML .= "<div class='accordion-item today_results_accordion_item today_results_accordion_item_".$key."'>";
                    $pageHTML .= "<div class='accordion-header' id='heading_".$key."'>";
                    $pageHTML .= "<div  class='accordion-button today_results_courses_tr last_course_gb_and_ire' data-toggle='collapse' data-target='#collapse_".$key."' aria-expanded='false' aria-controls='collapse_".$key."'>";
                    $pageHTML .= "<div class='results_today_venu_details'>";
                    $pageHTML .= "<span class='today_results_title_flag title_flag fflag fflag-".$country_code." ff-lg ff-wave ff-round'></span>";
                    $pageHTML .= "<span class='course_title'>".$raceResult["course"]."</span>";
                    $pageHTML .= "<span class='race_name'>".$raceResult["race_name"]."</span>";
                    $pageHTML .= "<span class='results_by_date_date'>".$raceResult["date"]."</span>";
                    $pageHTML .= "<span class='course_off'>".$raceResult["off"]."</span>";
                    $pageHTML .= "</div>";
                    $pageHTML .= "</div>";
                    $pageHTML .= "</div>";

                    $pageHTML .= "<div id='collapse_".$key."' class='accordion-collapse collapse' aria-labelledby='heading_".$key."' data-bs-parent='#today_results_accordion'>";
                    $pageHTML .= "<div class='accordion-body'>";
                    $pageHTML .= "<p class='text-left course_off course_off_hidden' style='display:none;'>Race Title: ".$raceResult["race_name"]."</p>";
                    $pageHTML .= "<p class='text-left course_off course_off_hidden' style='display:none;'>Off Time: ".$raceResult["off"]."</p>";
                    $pageHTML .= "<table class='table table-striped special_horse_racing_table'>";

                    $pageHTML .= "<thead class='special_horse_racing_table_thead today_results_table_thead'>";
                    $pageHTML .= "<tr class='special_horse_racing_table_thead_tr today_results_table_thead_tr'>";
                    $pageHTML .= "<th class='today_results_th'>SN</th>";
                    $pageHTML .= "<th class='today_results_th'>Jockey Wear</th>";
                    $pageHTML .= "<th class='today_results_th'>Horse & Jockey</th>";
                    $pageHTML .= "<th class='today_results_th'>Prize Money</th>";
                    $pageHTML .= "<th class='today_results_th'>Best Odd</th>";
                    $pageHTML .= "</thead>";

                    $pageHTML .= "<tbody class='special_horse_racing_table_tbody today_results_table_tbody'>";

                    $serial = 1;

                    //Loop through the API results
                    foreach($raceResult["runners"] as $key => $horse) {

                        if($horse["prize"] == ''){
                            $prize_money = '&cross;';
                        }else{
                            $prize_money = '&pound;' . $horse["prize"];
                        }

                        if($horse["sp"] == ''){
                            $best_odd = $horse["sp_dec"];
                        }else{
                            $best_odd = $horse["sp"];
                        }

                        $pageHTML .= "<tr class='odds_tr' style=' color:".$color."; font-size:".($textSize-1)."px; '>";
                        $pageHTML .= "<td class='silk_serial_td'>".$serial."</td>";
                        $pageHTML .= "<td class='silk_image_td'><img class='silk_image' src='".$horse["silk_url"]."' alt='Silk Image' width='50' height='40'></td>";
                        $pageHTML .= "<td class='jockey_info_td'><span class='horse_title'>".$horse["horse"]."&nbsp;(".$horse["number"].")</span><br><span class='jockey_title'>".$horse["jockey"]."</span></td>";
                        $pageHTML .= "<td class='today_results_odds_td'>".$prize_money."</td>";
                        $pageHTML .= "<td class='today_results_odds_td'>".$best_odd."</td>";
                        $pageHTML .= "</tr>";

                        $serial++;

                    }

                    $pageHTML .= "</tbody>";
                    $pageHTML .= "</table>";
                    
                    $pageHTML .= "</div>"; // accordion item ends here
                    $pageHTML .= "</div>"; // accordion item ends here
                    $pageHTML .= "</div>"; // accordion item ends here
 
                }

                $pageHTML .= "</div>"; // accordion ends here

            }else{
                $pageHTML .= "<div class='courses_tr last_course_gb_and_ire'>";
                $pageHTML .= "<div>No Races At The Moment!</div>";
                $pageHTML .= "</div>";
            }


            $result = $pageHTML;



        } catch (PDOException $e) {

            $result = "Error: " . $e->getMessage();

        }

        return $result;

    }



    
    public function results_by_date_make_table($raceResults, $color, $textSize, $course, $off_time, $date, $current_page_link )
    {
  

        try {

            if(count($raceResults) != 0){

                // sorting descending order
                array_multisort(array_column($raceResults, 'off'), SORT_DESC, $raceResults);

                $pageHTML .= "<div class='accordion today_results_accordion results_by_date_accordion' id='today_results_accordion'>";

                //Loop through the API results
                foreach($raceResults as $key => $raceResult) {

                    $region_lists = file_get_contents( BESTOFBETS_PLUGIN_URL .'/inc/shortcodes/includes/json-responses/all-region-list.json');
                    $region_lists = json_decode($region_lists, true);
                    $country_code = '';
                    foreach($region_lists as $single_region){
                        if(strtoupper($single_region["region_code"]) == strtoupper($raceResult["region"]) ){
                            $country_code = strtoupper($single_region["region_code_freakflagsprite"]);
                            break;
                        }
                    }

                    // $raceResult["id_race"] = 207660;
                    // $single_race_link = $current_page_link."/single-horse-racing-course?course=".$raceResult["course"]."&off_time=".$raceResult["off_time"]."&date=".$date;
                    $single_race_link = "#";

                    $pageHTML .= "<div class='accordion-item today_results_accordion_item today_results_accordion_item_".$key."'>";
                    $pageHTML .= "<div class='accordion-header' id='heading_".$key."'>";
                    $pageHTML .= "<div  class='accordion-button today_results_courses_tr last_course_gb_and_ire' data-toggle='collapse' data-target='#collapse_".$key."' aria-expanded='false' aria-controls='collapse_".$key."'>";
                    $pageHTML .= "<div class='results_today_venu_details'>";
                    $pageHTML .= "<span class='today_results_title_flag title_flag fflag fflag-".$country_code." ff-lg ff-wave ff-round'></span>";
                    $pageHTML .= "<span class='course_title'>".$raceResult["course"]."</span>";
                    $pageHTML .= "<span class='race_name'>".$raceResult["race_name"]."</span>";
                    $pageHTML .= "<span class='results_by_date_date'>".$raceResult["date"]."</span>";
                    $pageHTML .= "<span class='course_off'>".$raceResult["off"]."</span>";
                    $pageHTML .= "</div>";
                    $pageHTML .= "</div>";
                    $pageHTML .= "</div>";

                    $pageHTML .= "<div id='collapse_".$key."' class='accordion-collapse collapse' aria-labelledby='heading_".$key."' data-bs-parent='#today_results_accordion'>";
                    $pageHTML .= "<div class='accordion-body'>";
                    $pageHTML .= "<p class='text-left course_off course_off_hidden' style='display:none;'>Race Title: ".$raceResult["race_name"]."</p>";
                    $pageHTML .= "<p class='text-left course_off course_off_hidden' style='display:none;'>Off Time: ".$raceResult["off"]."</p>";
                    $pageHTML .= "<table class='table table-striped special_horse_racing_table'>";

                    $pageHTML .= "<thead class='special_horse_racing_table_thead today_results_table_thead'>";
                    $pageHTML .= "<tr class='special_horse_racing_table_thead_tr today_results_table_thead_tr'>";
                    $pageHTML .= "<th class='today_results_th'>SN</th>";
                    $pageHTML .= "<th class='today_results_th'>Jockey Wear</th>";
                    $pageHTML .= "<th class='today_results_th'>Horse & Jockey</th>";
                    $pageHTML .= "<th class='today_results_th'>Prize Money</th>";
                    $pageHTML .= "<th class='today_results_th'>Best Odd</th>";
                    $pageHTML .= "</thead>";

                    $pageHTML .= "<tbody class='special_horse_racing_table_tbody today_results_table_tbody'>";

                    $serial = 1;

                    //Loop through the API results
                    foreach($raceResult["runners"] as $key => $horse) {

                        if($horse["prize"] == ''){
                            $prize_money = '&cross;';
                        }else{
                            $prize_money = '&pound;' . $horse["prize"];
                        }

                        if($horse["sp"] == ''){
                            $best_odd = $horse["sp_dec"];
                        }else{
                            $best_odd = $horse["sp"];
                        }

                        $pageHTML .= "<tr class='odds_tr' style=' color:".$color."; font-size:".($textSize-1)."px; '>";
                        $pageHTML .= "<td class='silk_serial_td'>".$serial."</td>";
                        $pageHTML .= "<td class='silk_image_td'><img class='silk_image' src='".$horse["silk_url"]."' alt='Silk Image' width='50' height='40'></td>";
                        $pageHTML .= "<td class='jockey_info_td'><span class='horse_title'>".$horse["horse"]."&nbsp;(".$horse["number"].")</span><br><span class='jockey_title'>".$horse["jockey"]."</span></td>";
                        $pageHTML .= "<td class='today_results_odds_td'>".$prize_money."</td>";
                        $pageHTML .= "<td class='today_results_odds_td'>".$best_odd."</td>";
                        $pageHTML .= "</tr>";

                        $serial++;

                    }

                    $pageHTML .= "</tbody>";
                    $pageHTML .= "</table>";
                    
                    $pageHTML .= "</div>"; // accordion item ends here
                    $pageHTML .= "</div>"; // accordion item ends here
                    $pageHTML .= "</div>"; // accordion item ends here
 
                }

                $pageHTML .= "</div>"; // accordion ends here

            }else{
                $pageHTML .= "<div class='courses_tr last_course_gb_and_ire'>";
                $pageHTML .= "<div>No Races At The Moment!</div>";
                $pageHTML .= "</div>";
            }


            $result = $pageHTML;



        } catch (PDOException $e) {

            $result = "Error: " . $e->getMessage();

        }

        return $result;

    }






    public function horse_results_make_table($search_horse_response, $color, $textSize, $horse_search_query, $current_page_link, $home_page_link)
    {
        try {

            // initializing 
            $pageHTML = '';

            if(count($search_horse_response) != 0){

                $pageHTML .= "<div class='row'>";
                $pageHTML .= "<div class='col-md-10 d-flex justify-content-center align-items-center'>";

                $pageHTML .= "<h2 class='text-center horse_racing_heading'>Serch Results For &ldquo;".$horse_search_query."&rdquo;</h2>";

                $pageHTML .= "<table class='table table-bordered search_horse_by_name_table'>";

                $pageHTML .= "<thead class=' today_results_table_thead'>";
                $pageHTML .= "<tr class=' today_results_table_thead_tr'>";
                $pageHTML .= "<th class='today_results_th'>SN</th>";
                $pageHTML .= "<th class='today_results_th today_results_th_hide'>Horse ID</th>";
                $pageHTML .= "<th class='today_results_th'>Horse Name</th>";
                $pageHTML .= "<th class='today_results_th'>Dam</th>";
                $pageHTML .= "<th class='today_results_th'>DamSire</th>";
                $pageHTML .= "<th class='today_results_th'>Sire</th>";
                $pageHTML .= "</thead>";

                $pageHTML .= "<tbody class=' today_results_table_tbody'>";

                $serial = 1;

                //Loop through the API results
                foreach($search_horse_response["search_results"] as $key => $horse) {

                    $horse_link = $current_page_link."?horse_id=".$horse["id"];

                    $pageHTML .= "<tr class='odds_tr' style=' color:".$color."; font-size:".($textSize-1)."px; '>";
                    $pageHTML .= "<td class='silk_serial_td'>".$serial."</td>";
                    $pageHTML .= "<td class='today_results_th_hide'><a href='".$horse_link."'>".$horse["id"]."</a></td>";
                    $pageHTML .= "<td class=''><a href='".$horse_link."'>".$horse["horse"]."</a></td>";
                    $pageHTML .= "<td class=''><a href='".$horse_link."'>".$horse["dam"]."</a></td>";
                    $pageHTML .= "<td class=''><a href='".$horse_link."'>".$horse["damsire"]."</a></td>";
                    $pageHTML .= "<td class=''><a href='".$horse_link."'>".$horse["sire"]."</a></td>";
                    $pageHTML .= "</tr>";

                    $serial++;

                }

                $pageHTML .= "</tbody>";
                $pageHTML .= "</table>";
                
                $pageHTML .= "</div>";
                $pageHTML .= "</div>";


            }else{
                $pageHTML .= "<div class='courses_tr last_course_gb_and_ire'>";
                $pageHTML .= "<div>No Results Found!</div>";
                $pageHTML .= "</div>";
            }


            $result = $pageHTML;



        } catch (PDOException $e) {

            $result = "Error: " . $e->getMessage();

        }

        return $result;

    }






    public function horse_time_analysis_table($horse_time_analysis_response, $color, $textSize, $current_page_link, $BESTOFBETS_PLUGIN_URL)
    {
        try {

            // initializing 
            $pageHTML = '';

            if(count($horse_time_analysis_response) != 0){

                $pageHTML .= '<div class="container search-horse-page">';

                $pageHTML .= "<div class='row'>";
                $pageHTML .= "<div class='col-md-10 d-flex justify-content-center align-items-center'>";

                $pageHTML .= "<h2 class='text-center horse_racing_heading'>Time Analysis For &ldquo;".$horse_time_analysis_response["horse"]."&rdquo;</h2>";

                // $pageHTML .= "<table class='table table-striped search_horse_by_name_table'>";

                // $pageHTML .= "<thead class='special_horse_racing_table_thead today_results_table_thead'>";
                // $pageHTML .= "<tr class='special_horse_racing_table_thead_tr today_results_table_thead_tr'>";
                // $pageHTML .= "<th class='today_results_th'>Horse ID</th>";
                // $pageHTML .= "<th class='today_results_th'>Horse Name</th>";
                // $pageHTML .= "<th class='today_results_th'>Dam</th>";
                // $pageHTML .= "<th class='today_results_th'>DamSire</th>";
                // $pageHTML .= "<th class='today_results_th'>Sire</th>";
                // $pageHTML .= "</thead>";

                // $pageHTML .= "<tbody class='special_horse_racing_table_tbody today_results_table_tbody'>";


                // $pageHTML .= "<tr class='odds_tr' style=' color:".$color."; font-size:".($textSize-1)."px; '>";
                // $pageHTML .= "<td class=''>".$horse_time_analysis_response["id"]."</td>";
                // $pageHTML .= "<td class=''>".$horse_time_analysis_response["horse"]."</td>";
                // $pageHTML .= "<td class=''>".$horse_time_analysis_response["dam"]."</td>";
                // $pageHTML .= "<td class=''>".$horse_time_analysis_response["damsire"]."</td>";
                // $pageHTML .= "<td class=''>".$horse_time_analysis_response["sire"]."</td>";
                // $pageHTML .= "</tr>";


                // $pageHTML .= "</tbody>";
                // $pageHTML .= "</table>";


                // $pageHTML .= "<table class='table table-striped search_horse_by_name_table'>";
                $pageHTML .= "<table class='table table-bordered horse_time_analysis_table search_horse_by_name_table'>";

                $pageHTML .= "<thead class=' today_results_table_thead'>";
                $pageHTML .= "<tr class=' today_results_table_thead_tr'>";
                $pageHTML .= "<th class='today_results_th'>SN</th>";
                $pageHTML .= "<th class='today_results_th'>Distance</th>";
                // $pageHTML .= "<th class='today_results_th'>Region</th>";
                $pageHTML .= "<th class='today_results_th'>Course <span class='search_horse_course_time_hidden text-center' style='display:none;'>& Date</span></th>";
                $pageHTML .= "<th class='today_results_th today_results_th_hide'>Date</th>";
                $pageHTML .= "<th class='today_results_th'>Time</th>";
                $pageHTML .= "<th class='today_results_th'>Going</th>";
                $pageHTML .= "<th class='today_results_th '><span class='today_results_th_hide'>Position</span><span class='search_horse_course_time_hidden text-center' style='display:none;'>Pos</span></th>";
                $pageHTML .= "</thead>";

                $pageHTML .= "<tbody class=' today_results_table_tbody'>";

                // flag codes
                $region_lists = file_get_contents( $BESTOFBETS_PLUGIN_URL .'/inc/shortcodes/includes/json-responses/all-region-list.json');
                $region_lists = json_decode($region_lists, true);


                $serial = 1;

                //Loop through the API results
                foreach($horse_time_analysis_response["distances"] as $key => $distance) {

                    $pageHTML .= "<tr class='odds_tr' style=' color:".$color."; font-size:".($textSize-1)."px; '>";
                    $pageHTML .= "<td rowspan='".(count($distance["times"])+1)."' class='silk_serial_td'>".$serial."</td>";
                    $pageHTML .= "<td rowspan='".(count($distance["times"])+1)."' class=''>".$distance["dist"]."</td>";

                    foreach($distance["times"] as $key_time => $time) {

                        $country_code = '';
                        foreach($region_lists as $single_region){
                            if(strtoupper($single_region["region_code"]) == strtoupper($time["region"]) ){
                                $country_code = strtoupper($single_region["region_code_freakflagsprite"]);
                                break;
                            }
                        }

                        $pageHTML .= "<tr class='odds_tr' style=' color:".$color."; font-size:".($textSize-1)."px; '>";

                        // $pageHTML .= "<td class=''>".$time["region"]."</td>";
                        $pageHTML .= "<td class=''><span class='title_flag fflag fflag-".$country_code." ff-lg ff-wave ff-round'></span><span class='search_horse_course_name'>".$time["course"]."</span><p class='search_horse_course_time_hidden text-center' style='display:none;'>".$time["date"]."</p></td>";
                        $pageHTML .= "<td class='today_results_td_hide'>".$time["date"]."</td>";
                        $pageHTML .= "<td class=''>".$time["time"]."</td>";
                        $pageHTML .= "<td class=''>".$time["going"]."</td>";
                        $pageHTML .= "<td class=''>".$time["position"]."</td>";

                        $pageHTML .= "</tr>";

                    }

                    $pageHTML .= "</tr>";

                    $serial++;

                }

                $pageHTML .= "</tbody>";
                $pageHTML .= "</table>";


                $pageHTML .= "</div>";
                $pageHTML .= "</div>";

                $pageHTML .= "</div>";

                $pageHTML .= "<h3 class='text-center back_heading time_analysis_back_heading'><a href='".$current_page_link."'>Back To Horse Search</a></h3>";

            }else{
                $pageHTML .= "<div class='courses_tr last_course_gb_and_ire'>";
                $pageHTML .= "<div>No Results Found!</div>";
                $pageHTML .= "</div>";
            }


            $result = $pageHTML;



        } catch (PDOException $e) {

            $result = "Error: " . $e->getMessage();

        }

        return $result;

    }







}
