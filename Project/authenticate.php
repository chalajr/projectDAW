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

//Prepare the SQL and perform the query
if($statement = $comm->prepare("SELECT id, password, displayname FROM users WHERE username = '$_POST[username]' and password = '$_POST[password]'")) {
	//Bind username string parameter
	//$statement->bind_param($_POST['username'],$_POST['password']);
	//$statement->bind_param('s',$_POST['password']);
	$statement->execute();
	//Store result to check if the user exists
	$statement->store_result();

	//Check if query found the username
	if($statement->num_rows > 0) {
		$statement->bind_result($id,$password,$displayname);
		$statement->fetch();
		//User is real, password needs to be compared
		if($_POST['password'] === $password) {
			//Validated password, user is logged in
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['id'] = $id;
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['name'] = $displayname;
			echo 'Welcome ' . $_SESSION['name'] . '!<br/>';
		} else {
			//Invalidate password input
			echo 'Incorrect username and/or password!<br/>';
		}
	} else {
		//Invalidate username input
		echo 'Incorrect username and/or password!<br/>';
	}

	$statement->close();
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
	<a href="index.html"><button>Log Out</button></a>
</body>
</html>