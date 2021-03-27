<?php

session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'inventorizerdaw';

//Try connection to DB
$comm = mysqli_connect($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);

//Handling connection errors
if(mysqli_connect_errno()){
	exit("Failed to connect to the database: " . mysqli_connect_errno());
}

//Verify if login fields are not NULL
if(!isset($_POST['username'],$_POST['password'],$_POST['confirm'])) {
	exit("'username' and 'password' fields are required to start session.");
}

$update = "UPDATE users SET password='$_POST[password]' WHERE username='$_POST[username]'";

if($_POST['password'] === $_POST['confirm']) {
	if($comm->query($update) === true) {
		echo "$_POST[username]'s password changed successfully!<br/>";
	} else {
		echo 'Error: ' . $update . '<br>' . $comm->error;
	}
} else {
	echo 'Password mismatch, unable to perform change<br/>';
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Inventorizer Web App</title>
	<link rel="icon" type="image/png" href="box.png" />
</head>
<body>
	<a href="index.html"><button>Return to login</button></a>
</body>
</html>