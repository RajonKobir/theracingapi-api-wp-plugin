<?php
class ApiQueries
{
    public function race_cards_by_date($date, $base_url, $production_username, $production_password)
    {
        try {

            // connecting to the API
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $base_url.'/v1/racecards/pro?date='.$date,
              // CURLOPT_URL => $base_url.'/v1/racecards/standard?day='.$date,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.base64_encode("$production_username:$production_password"),
                // 'Authorization: Basic '.base64_encode("k3E4Do52NYYcKN66tkayXRW1:8m9oYkZHGak26B3aOqLB4gB5"),
              ),
            ));
            
            $result = curl_exec($curl);
            
            curl_close($curl);

            // $err = curl_error($curl);

            // if ($err) {
            //     $result = $err;
            // } 

        } catch (PDOException $e) {

            $result = "Error: " . $e->getMessage();

        }

        return $result;

    }




    public function big_races_by_date($date, $base_url, $production_username, $production_password)
    {
        try {

            // connecting to the API
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $base_url.'/v1/racecards/big-races?start_date='.$date.'&end_date='.$date,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.base64_encode("$production_username:$production_password"),
              ),
            ));
            
            $result = curl_exec($curl);
            
            curl_close($curl);

            // $err = curl_error($curl);

            // if ($err) {
            //     $result = $err;
            // } 

        } catch (PDOException $e) {

            $result = "Error: " . $e->getMessage();

        }

        return $result;

    }



    public function single_race_details_by_id($race_id, $base_url, $production_username, $production_password)
    {
        try {

            // connecting to the API
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $base_url.'/v1/racecards/'.$race_id.'/standard',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.base64_encode("$production_username:$production_password"),
                // 'Authorization: Basic '.base64_encode("k3E4Do52NYYcKN66tkayXRW1:8m9oYkZHGak26B3aOqLB4gB5"),
              ),
            ));
            
            $result = curl_exec($curl);
            
            curl_close($curl);

            // $err = curl_error($curl);
            // if ($err) {
            //     $result = $err;
            // } 

        } catch (PDOException $e) {

            $result = "Error: " . $e->getMessage();

        }

        return $result;

    }



    public function race_results_today($base_url, $production_username, $production_password)
    {
        try {

            // connecting to the API
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $base_url.'/v1/results/today',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.base64_encode("$production_username:$production_password"),
                // 'Authorization: Basic '.base64_encode("k3E4Do52NYYcKN66tkayXRW1:8m9oYkZHGak26B3aOqLB4gB5"),
              ),
            ));
            
            $result = curl_exec($curl);
            
            curl_close($curl);

            // $err = curl_error($curl);
            // if ($err) {
            //     $result = $err;
            // } 

        } catch (PDOException $e) {

            $result = "Error: " . $e->getMessage();

        }

        return $result;

    }



    public function race_results_by_date($date, $base_url, $production_username, $production_password)
    {

      // initializing 
      $result = '';
      $today = date("Y-m-d");

      if($date == $today){

        // $curl_url = $base_url.'/v1/results/today';

        // Read the JSON file 
        $result = file_get_contents( BESTOFBETS_PLUGIN_URL .'/inc/shortcodes/includes/json-responses/today-results/today-results.json');

      }else{

        $curl_url = $base_url.'/v1/results?start_date='.$date.'&end_date='.$date;

        try {

          // connecting to the API
          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => $curl_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
              'Authorization: Basic '.base64_encode("$production_username:$production_password"),
              // 'Authorization: Basic '.base64_encode("k3E4Do52NYYcKN66tkayXRW1:8m9oYkZHGak26B3aOqLB4gB5"),
            ),
          ));
          
          $result = curl_exec($curl);
          
          curl_close($curl);

          // $err = curl_error($curl);
          // if ($err) {
          //     $result = $err;
          // } 

        } catch (PDOException $e) {

            $result = "Error: " . $e->getMessage();

        }

      }

      return $result;

  }




  public function search_horse_by_name($horse_search_query, $base_url, $production_username, $production_password)
  {
      try {

          // connecting to the API
          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => $base_url . '/v1/horses/search?name=' . $horse_search_query,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
              'Authorization: Basic '.base64_encode("$production_username:$production_password"),
              // 'Authorization: Basic '.base64_encode("k3E4Do52NYYcKN66tkayXRW1:8m9oYkZHGak26B3aOqLB4gB5"),
            ),
          ));
          
          $result = curl_exec($curl);
          
          curl_close($curl);

          // $err = curl_error($curl);
          // if ($err) {
          //     $result = $err;
          // } 

      } catch (PDOException $e) {

          $result = "Error: " . $e->getMessage();

      }

      return $result;

  }




  public function horse_time_analysis($horse_id, $base_url, $production_username, $production_password)
  {
      try {

          // connecting to the API
          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => $base_url . '/v1/horses/' . $horse_id . '/analysis/distance-times',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
              'Authorization: Basic '.base64_encode("$production_username:$production_password"),
              // 'Authorization: Basic '.base64_encode("k3E4Do52NYYcKN66tkayXRW1:8m9oYkZHGak26B3aOqLB4gB5"),
            ),
          ));
          
          $result = curl_exec($curl);
          
          curl_close($curl);

          // $err = curl_error($curl);
          // if ($err) {
          //     $result = $err;
          // } 

      } catch (PDOException $e) {

          $result = "Error: " . $e->getMessage();

      }

      return $result;

  }



  







}
