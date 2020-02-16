<?php

//ADD MOVIE FILE

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

//Following code will execute once new move added through this form:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $image = $_FILES['image'];
    $description = $_POST['description'];
    $rates = $_POST['rating'];
	//Function called from movie.php and image store via Storage.php 
    $movie->create($name, $image, $description, $rates);

    header('location:index.php');
}

require __DIR__ . '/../../header.php';

?>

<div class="form-container">
    <div class="card">
        <form class="form-horizontal" method="post" action="#" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="name">Movie name:</label>
                <div class="col-sm-10">
                    <input name="name" class="form-control" id="name" type="text" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="image">Movie image:</label>
                <div class="col-sm-10">
                    <input name="image" class="form-control" id="image" type="file" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="description">Description:</label>
                <div class="col-sm-10">
                    <input name="description" class="form-control" id="description" type="text" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="rating">rating:</label>
                <div class="col-sm-10">
                    <input name="rating" class="form-control" id="rating" type="number" min="1" max="5" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="submit" class="btn btn-primary">Save movie</button>
                    <button type="button" class="btn btn-default" onclick="history.back(1);">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../../footer.php'; ?>