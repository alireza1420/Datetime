<?php 
/*
* functions to get time from "http://worldclockapi.com/" API for EasternStandardTIME & Coordinated Universal
* function tp get user location from "http://ip-api.com/php/" API
* functio to get userlovcation date and time from "https://timeapi.io/api/Time/current/zone?timeZone={CONTINENR EX:europe or America...}/{CITY}" API
*
*/


//<---------------GET USER LOCATION-------------->
function userLocation(){
   $data=array();
       $query = @unserialize (file_get_contents('http://ip-api.com/php/'));
       
           $data["country"]=$query["country"];
           $data["city"]=$query["city"];
           $data["city"]=$query["timezone"];
      
       return  $data;
    
   
   }
   //<-------END-OF--------GET USER LOCATION-------------->

   //<---------------GET USER DATA AND TIME BASED ON LOCATION-------------->
   function userLocationDateAndTime(){
     $user_Location=userLocation();
    $data=array();
    $api_url = 'https://timeapi.io/api/Time/current/zone?timeZone='.$user_Location['city'];

    // Read JSON file
    $json_data = file_get_contents($api_url);
    
    // Decode JSON data into PHP array
    $response_data=json_decode($json_data);

   // print_r($response_data); for debuging
    

    // Cut long data into small & select only first 10 records

    
    $value = get_object_vars($response_data);
    
    $data['dayOfWeek']=$value["dayOfWeek"];
    $data['date']=$value['date'];
    return  $data;

   }
   //<--------END-OF-------------GET USER DATA AND TIME BASED ON LOCATION-------------->

//<---------------EasternStandardT Section-------------->
function dateAndTime_EasternStandardTime(){
    $api_url = 'http://worldclockapi.com/api/json/est/now';

// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$response_data = json_decode($json_data);

// All user data exists in 'data' object
$user_data = $response_data;

// Cut long data into small & select only first 10 records





$value = get_object_vars($user_data);

$time =  $value['currentDateTime']; 

return $time;

}

//<------END-OF---------EasternStandardT Section-------------->

//<---------------Coordinated Universal Section-------------->

function dateAndTime_Coordinated_Universal_Time(){
    
$api_url = 'http://worldclockapi.com/api/json/utc/now';

// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$response_data = json_decode($json_data);

// All user data exists in 'data' object
$user_data = $response_data;

// Cut long data into small & select only first 10 records


// Print data if need to debug
// print_r($user_data);

$value = get_object_vars($user_data);
$time =  $value['currentDateTime']; 

return $time ;


}
//<------END-OF---------Coordinated Universal Section-------------->



