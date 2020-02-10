<?php

require_once(__DIR__ . '/../../autoloader.php');
require_once(__DIR__ . '/../../config.php');


use OOP\Classes\Auth;
use OOP\Classes\Movie;

$movie = new Movie;

//If Login type is not Admin, system will redirect user to the index page.

if(!Auth::isAdmin()){
    header('location:index.php');
    exit;
}

//If Login type is Admin and movie ID found in the URL, following code executes to delete the respective movie information.
$movie->delete($_GET['id']);

header('location:index.php');