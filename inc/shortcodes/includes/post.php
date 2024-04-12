<?php

// if posted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if(isset($_POST["date"]) && isset($_POST["color"]) && isset($_POST["textSize"])){

    function secure_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    // initializing variables
    $pageHTML = '';
    $date = secure_input($_POST["date"]);
    $day = secure_input($_POST["day"]);
    $big_races_date = secure_input($_POST["big_races_date"]);
    $color = secure_input($_POST["color"]);
    $textSize = secure_input($_POST["textSize"]);
    $home_page_link = secure_input($_POST["home_page_link"]);
    $current_page_link = secure_input($_POST["current_page_link"]);
    $base_url = secure_input($_POST["base_url"]);
    $production_username = secure_input($_POST["production_username"]);
    $production_password = secure_input($_POST["production_password"]);
    define( 'BESTOFBETS_PLUGIN_URL', secure_input($_POST["BESTOFBETS_PLUGIN_URL"]) );

    require_once('ApiQueries.php');
    require_once('MakeHtmlTable.php');


    try {

      // Read the JSON file 
      $big_races_response = file_get_contents( BESTOFBETS_PLUGIN_URL .'/inc/shortcodes/includes/json-responses/big-races-racecards/'.$day.'.json');
      // Read the JSON file 
      $response = file_get_contents( BESTOFBETS_PLUGIN_URL .'/inc/shortcodes/includes/json-responses/all-racecards/'.$day.'.json');

      // $ApiQuery = new ApiQueries;
      // $big_races_response = $ApiQuery->big_races_by_date($big_races_date, $base_url, $production_username, $production_password);

      // $ApiQuery = new ApiQueries;
      // $response = $ApiQuery->race_cards_by_date($date, $base_url, $production_username, $production_password);

    } catch (PDOException $e) {

      $pageHTML .= "Error: " . $e->getMessage();

    } finally{

          $raceResults = json_decode($response, true);
          $bigRaceResults = json_decode($big_races_response, true);

          // var_dump ($response);
          // var_dump ($production_password);
          // var_dump ($raceResults["racecards"][0]["race_id"]);

          try {

            if(isset($raceResults["racecards"][0]["race_id"]) || isset($bigRaceResults["racecards"][0]["race_id"])){
              $MakeHtmlTable = new MakeHtmlTable;
              $raceResults = $MakeHtmlTable->make_html_from_array($raceResults, $bigRaceResults, $color, $textSize, $current_page_link, $date, $day, BESTOFBETS_PLUGIN_URL );
              $pageHTML .= $raceResults;
            }else{
                $pageHTML .= "<h6 class='text-center no_races_found'>No Races Found!</h6>";
                $pageHTML .= "<h3 class='text-center back_heading'><a href='".$home_page_link."'>Back To Homepage</a></h3>";
            }


          }catch (PDOException $e) {

            $pageHTML .= "Error: " . $e->getMessage();

          } finally{

            echo $pageHTML;
            
          }

      
          
      
         
        }




    }  






  if( isset($_POST["horse_search_query"]) ){

    function secure_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    // initializing variables
    $pageHTML = '';
    $horse_search_query = secure_input($_POST["horse_search_query"]);
    $color = secure_input($_POST["color"]);
    $textSize = secure_input($_POST["textSize"]);
    $base_url = secure_input($_POST["base_url"]);
    $production_username = secure_input($_POST["production_username"]);
    $production_password = secure_input($_POST["production_password"]);
    $home_page_link = secure_input($_POST["home_page_link"]);
    $current_page_link = secure_input($_POST["current_page_link"]);


    require_once('ApiQueries.php');
    require_once('MakeHtmlTable.php');


    try {

      $ApiQuery = new ApiQueries;
      $search_horse_response = $ApiQuery->search_horse_by_name($horse_search_query, $base_url, $production_username, $production_password);

    } catch (PDOException $e) {

      $pageHTML .= "Error: " . $e->getMessage();

    } finally{

      $search_horse_response = json_decode($search_horse_response, true);

      if(isset($search_horse_response["search_results"][0]["id"])){
        $MakeHtmlTable = new MakeHtmlTable;
        $horse_results_make_table = $MakeHtmlTable->horse_results_make_table($search_horse_response, $color, $textSize, $horse_search_query, $current_page_link, $home_page_link);
        $pageHTML .= $horse_results_make_table;
      }else{
          $pageHTML .= "<h6 class='col-md-offset-2 col-md-6 text-center no_races_found'>No Results Found For &ldquo;".$horse_search_query."&rdquo;!</h6>";
          // $pageHTML .= "<h3 class='text-center back_heading'><a href='".$home_page_link."'>Back To Homepage</a></h3>";
      }

    }


    // print_r ($search_horse_response);
    echo $pageHTML;

    
  }





    // else if( isset($_POST["date"]) && isset($_POST["big_races_date"]) && isset($_POST["day"]) && isset($_POST["base_url"]) && isset($_POST["production_username"]) && isset($_POST["production_password"]) && isset($_POST["BESTOFBETS_PLUGIN_PATH"]) && isset($_POST["BESTOFBETS_PLUGIN_URL"]) ){

    //   function secure_input($data) {
    //     $data = trim($data);
    //     $data = stripslashes($data);
    //     $data = htmlspecialchars($data);
    //     return $data;
    //   }
  
    //   // initializing variables
    //   $date = secure_input($_POST["date"]);
    //   $day = secure_input($_POST["day"]);
    //   $big_races_date = secure_input($_POST["big_races_date"]);
    //   $base_url = secure_input($_POST["base_url"]);
    //   $production_username = secure_input($_POST["production_username"]);
    //   $production_password = secure_input($_POST["production_password"]);
    //   define( 'BESTOFBETS_PLUGIN_PATH', secure_input($_POST["BESTOFBETS_PLUGIN_PATH"]) );
    //   define( 'BESTOFBETS_PLUGIN_URL', secure_input($_POST["BESTOFBETS_PLUGIN_URL"]) );
  
    //   require_once('ApiQueries.php');

    //   $ApiQuery = new ApiQueries;
    //   $big_races_response = $ApiQuery->big_races_by_date($big_races_date, $base_url, $production_username, $production_password);
  
    //   // $myfile = fopen( BESTOFBETS_PLUGIN_PATH . "/inc/shortcodes/includes/json-responses/big-races-racecards/".$day.".json", "w");
    //   $myfile = fopen( BESTOFBETS_PLUGIN_PATH . "/inc/shortcodes/includes/json-responses/big-races-racecards/today.json", "w");
    //   $txt = $big_races_response;
    //   fwrite($myfile, $txt);
    //   fclose($myfile);

    // }



    
}   // if posted ends

?>