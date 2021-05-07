<?php
// headers
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

// database and user model
/*include "../phpCRUD/dbcomm.php";
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
}*/

$newdisplay = json_decode(file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/DAWorkspace/projectDAW/phpCRUD/read.php?id='.$_GET['userid']), true);

if(count($newdisplay) != 1){
	$html = "
	<table style='border: 3px solid black; border-collapse: collapse; text-align: left;'>
		<caption style='font-weight: bold; font-size: 30px; text-align: left;'>Recovered user:</caption>
		<tr>
			<td style='border: 1px solid black; border-collapse: collapse; text-align: left; padding: 15px; background-color: #BFBFBF; font-size: 25px;'>ID</td>
			<td style='border: 1px solid black; border-collapse: collapse; text-align: left; padding: 15px; background-color: #FFFFFF; font-size: 25px;'>$newdisplay[id]</td>
		</tr>
		<tr>
			<td style='border: 1px solid black; border-collapse: collapse; text-align: left; padding: 15px; background-color: #BFBFBF; font-size: 25px;'>Username</td>
			<td style='border: 1px solid black; border-collapse: collapse; text-align: left; padding: 15px; background-color: #FFFFFF; font-size: 25px;'>$newdisplay[username]</td>
		</tr>
		<tr>
			<td style='border: 1px solid black; border-collapse: collapse; text-align: left; padding: 15px; background-color: #BFBFBF; font-size: 25px;'>Email</td>
			<td style='border: 1px solid black; border-collapse: collapse; text-align: left; padding: 15px; background-color: #FFFFFF; font-size: 25px;'>$newdisplay[email]</td>
		</tr>
		<tr>
			<td style='border: 1px solid black; border-collapse: collapse; text-align: left; padding: 15px; background-color: #BFBFBF; font-size: 25px;'>Displayname</td>
			<td style='border: 1px solid black; border-collapse: collapse; text-align: left; padding: 15px; background-color: #FFFFFF; font-size: 25px;'>$newdisplay[displayname]</td>
		</tr>
		<tr>
			<td style='border: 1px solid black; border-collapse: collapse; text-align: left; padding: 15px; background-color: #BFBFBF; font-size: 25px;'>Password</td>
			<td style='border: 1px solid black; border-collapse: collapse; text-align: left; padding: 15px; background-color: #FFFFFF; font-size: 25px;'>$newdisplay[password]</td>
		</tr>
	</table>
	";
}
else {
	$html = "<p style='font-weight: bolder; font-size: 30px;'>$newdisplay[log]</p>";
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
		<!--?php var_dump($newdisplay);?-->
		<?php echo $html;?>
	</div>
</body>
</html>