<?php
// headers
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

// database and user model
include "../phpCRUD/dbcomm.php";
include "../phpCRUD/user.php";

$database = new Dbcomm();
$db = $database->getConnection();

$user = new User($db);

$user->id = isset($_GET['userid']) ? $_GET['userid'] : die();

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
    $html = "<p>$display[id]</p>
		<p>$display[username]</p>
		<p>$display[email]</p>
		<p>$display[displayname]</p>
		<p>$display[password]</p>";
}
else {
	// response 404 - Not Found
	http_response_code(404);
	$html = '<p>User not found! :^(</p>';
	// message for user
	//echo json_encode(array("log" => "ID not recognized for reading! :^("));
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>User Information</title>
	<meta charset="utf-8">
</head>
<body>
	<div>
		<?php echo $html;?>
	</div>
</body>
</html>