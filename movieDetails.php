<?php


/* File shows a SINGLE MOVIE PAGE if the user is logged-in. If user is not logged-in, system will redirect to index.php file to do login.*/

//autoloader & config require
require(__DIR__.'/autoloader.php');
require(__DIR__.'/config.php');

use OOP\Classes\Auth;
use OOP\Classes\Movie;

/*Check for the user session. If the user is not logged in, system will redirect the customer to the index page.
Auth: means you have to check the Auth.php file and "Check()" is the function name.*/

if(!Auth::check()){
    header('location:index.php');
}

/*This code is to get the individual movie information. $_GET['id'] is used to get the movie ID from the URL. 
So if movie id is passed through the URL, this ID is used to send the code to get the movie details.*/

$movie_data = new Movie;
$movie = $movie_data->find($_GET['id']);

require __DIR__ . '/header.php';

?>

<div class="movie-container row" style="margin-top: 40px;">
    <div class="col-sm-6">
        <img class="movie-detail-thumb" src="<?php echo BASE_URL.'assets/'.$movie['image'];?>">
    </div>
    <div class="col-sm-6">
        <h1><?php echo $movie['name'];?></h1>
        <div class="star-rating star-rating-large" data-rate="<?php echo $movie['rating'];?>">
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
        </div>
        <h4 class="movie-detail-description"><?php echo $movie['description'];?></h4>
    </div>

</div>

<?php

// footer section 
require __DIR__ . '/footer.php';

?>