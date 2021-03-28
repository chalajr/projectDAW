<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8")

// database and user model
include "dbcomm.php";
include "user.php";

$database = new Dbcomm();
$db = $database->getConnection();

$user = new User($db);

$statement = $user->read();

if(!empty($statement)) {
	// response 200 - OK
	http_response_code(200);
	// message for user
	echo json_encode();
}
else {
	// response 404 - Not Found
	http_response_code(404);
	// message for user
	echo json_encode(array("log" => "ID not recognized for reading! :^("));
}

?>