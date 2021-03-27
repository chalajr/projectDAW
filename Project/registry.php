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
if(!isset($_POST['username'],$_POST['password'])) {
	exit("'username' and 'password' fields are required to start session.");
}

$insertion = "INSERT INTO users (username, email, displayname, password) VALUES ('$_POST[username]','$_POST[email]','$_POST[displayname]', '$_POST[password]')";

if($comm->query($insertion) === true) {
	echo 'User registered successfully!<br/>';
} else {
	echo 'Error: ' . $insertion . '<br>' . $comm->error . '<br/>';
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
	<a href="index.html">Return to login</a>
</body>
</html>