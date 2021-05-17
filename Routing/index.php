<?php
// Include Route class
include('Route.php');

// Add base route (startpage)
Route::add('/',function(){
    echo 'Welcome to Team Invetorizer routing test app! :^)';
});

// Simple test route that simulates static html file
Route::add('/test.html',function(){
    echo "<p>This is a virtual. It's not like it really exists</p></br><p>Does it? ... 8^(</p>";
});

// Post route example
Route::add('/contact-form',function(){
    echo '<form method="post"><input type="text" name="test" /><input type="submit" value="send" /></form>';
},'get');

// Post route example
Route::add('/contact-form',function(){
    echo 'Hey! The form has been sent:<br/>';
    print_r($_POST);
},'post');

// Accept only numbers as parameter. Other characters will result in a 404 error
Route::add('/user/([0-9]*)',function($var1){ 
    include ('user.php');
});

//echo "indexecho";
Route::run('/');
?>