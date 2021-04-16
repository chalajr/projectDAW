<?php
// headers
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

// database and user model
include "dbcomm.php";
include "user.php";

$database = new Dbcomm();
$db = $database->getConnection();

$user = new User($db);

$user->username = isset($_GET['dawrequest']) ? $_GET['dawrequest'] : die();

$item = $user->search();

//var_dump($user);

if(!empty($item)){

    $dbusers = "";
    foreach ($item as $unit) {
        // create display
        $dbusers .= "username => $unit[username]<br/>email => $unit[email]<br/>displayname => $unit[displayname]<br/><br/>";
    }  

    // set response code - 200 OK
    //http_response_code(200);
}

else {
    // response 404 - Not Found
    //http_response_code(404);
    // message for user
    $dbusers = "No matching users were found in the records :^("; 
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHP Live MySQL Database Search</title>
  <style>
    body{
      font-family: Arial, sans-serif;
    }
    /* Formatting search box */
    .search-box{
      width: 300px;
      position: relative;
      display: inline-block;
      font-size: 14px;
    }
    .search-box input[type="text"]{
      height: 32px;
      padding: 5px 10px;
      border: 1px solid #CCCCCC;
      font-size: 14px;
      width: 100%;
      box-sizing: border-box;
    }
    /* Formatting result items */
    .result {
      /*position: absolute;*/
      margin-top: 0px;
      padding: 10px;
      border: 1px solid #CCCCCC;
      border-top: none;
      cursor: pointer;
      background: #f2f2f2;
      width: 300px;
      /*display: inline;*/
    }
    .submitbtn {
      position: absolute;
      font-size: 14px;
    } 
    
  </style>

</head>
<body>
<div class="search-box">
  <form action="searchBTN.php" method="get">
    <input type="text" id="dawrequest" name="dawrequest" autocomplete="off" placeholder="Search .." value="<?php echo $user->username;?>"/>
    <input class="submitbtn" type="submit" value="Search in DB" />
  </form>
</div>
<div>
    <p class="result">
        <?php echo $dbusers;?>
    </p>
    <a href="searchBTN.html"><button>New Entry</button></a>
</div>
</body>
</html>