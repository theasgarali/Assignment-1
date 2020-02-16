
<?php

//LOGOUT FILE

//autoloader & config require
require(__DIR__.'/autoloader.php');
require(__DIR__.'/config.php');


use OOP\Classes\Auth;

// When user logs out, we have to clear his session from the browser. And once session is cleared, we'll redirect customer to Index page by using header() method.
// You can find the function logout within src/app/Auth.php file
Auth::logout();


header('location:index.php');