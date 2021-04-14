<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database and user model
include "dbcomm.php";
include "user.php";

$database = new Dbcomm();
$db = $database->getConnection();

$user = new User($db);

$user->username = isset($_GET['username']) ? $_GET['username'] : die();

$item = $user->search();

//var_dump($user);

if(!empty($item)){

    $display = array();

    foreach ($item as $unit) {
       // create display
        $coin = array(
            "username" => $unit['username'],
            "email" => $unit['email'],
            "displayname" => $unit['displayname']
        );

        array_push($display,$coin);
    }
        

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($display);
    //echo "Nombre". $display['username'];
}

else {
    // response 404 - Not Found
    http_response_code(404);
    // message for user
    echo json_encode(array("log" => "username not recognized for reading! :^("));
}



?>