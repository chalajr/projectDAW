<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// database and user model
include "dbcomm.php";
include "user.php";

$database = new Dbcomm();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

if(
	!empty($data->username) && !empty($data->password) &&
	!empty($data->displayname) && !empty($data->email)
){
	$user->id = $data->id;
	$user->username = $data->username;
	$user->email = $data->email;
	$user->displayname = $data->displayname;
	$user->password = $data->password;
	$user->deleted = 0;

	if($user->create()) {
		// response 202 - Accepted
		http_response_code(202);
		// message for user
		echo json_encode(array("log" => "The requested user was created! :^)"));
	}
	else {
		// response 500 - Internal Server Error
		http_response_code(500);
		// message for user
		echo json_encode(array("log" => "An error occurred with the service. :^("));
	}
}
else {
	// response 400 - Bad Request
	http_response_code(400);
	// message for user
	echo json_encode(array("log" => "Invalid entry! Parameters cannot be null. :^("));
}
?>