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

$user->id = isset($_GET['id']) ? $_GET['id'] : die();

$user->read();

//var_dump($user);
	  
if(!empty($user->id) && !empty($user->username) && $user->deleted!=1){
    
    // create display
    $display = array(
        "id" =>  $user->id,
        "username" => $user->username,
        "email" => $user->email,
        "displayname" => $user->displayname,
        "password" => $user->password
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    $jsondisplay = json_encode($display); 
    echo $jsondisplay;
}


	/*$display = array(
		"id" => $item['id'],
		"username" => $item['username'],
		"email" => $item['email'],
		"displayname" => $item['displayname'],
		"password" => $item['password'],
	);

	// response 200 - OK
	http_response_code(200);
	// message for user
	echo json_encode($display);*/
else {
	// response 404 - Not Found
	//http_response_code(404);
	// message for user
	echo json_encode(array("log" => "ID not recognized for reading! :^("));
}



?>