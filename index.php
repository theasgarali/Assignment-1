<?php

//autoloader & config require
require(__DIR__.'/autoloader.php');
require(__DIR__.'/config.php');

// You can just get file included by using this 'use' expression.
use OOP\Classes\Auth;
use OOP\Classes\Movie;

// header.php file used to add the site links, search bar,etc for the user to navigate the site.
require __DIR__ . '/header.php'; // header is included

//show movies only for authorised users
if (Auth::check()) {
	$movie_data = new Movie();

	// calls search method of Movie Instance. If URL has the variable 'Search', system will list the movies based on search keywords and options.
	$movies = $movie_data->search(
		isset($_GET['search'])?$_GET['search']:'',
		isset($_GET['rating'])?$_GET['rating']:0
	);
?>
<div class="movie-container row">
    
    <?php
	// If there are movies stored in database it'll display the list of movies.
    if(count($movies)>0){ 
        foreach($movies as $movie){
        ?>
        <div class="col-sm-3">
        	<!-- Get the unique id of the movie to create a link and land to the movie page when user clicks on it  -->
            <a class="movie-link" href="<?php echo BASE_URL.'/movie.php?id='.$movie['id']; ?>">
                <div class="movie-mask">
                    <div class="back-mask"></div>
                </div>
                <div class="movie-description">
                    <span><?php echo $movie['description'];?></span>
                </div>
                <div class="movie-content">
                    <div class="star-rating" data-rate="<?php echo $movie['rating'];?>">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <img class="movie-thumb" src="<?php echo BASE_URL;?>/assets/<?php echo $movie['image'];?>">
                    <div class="movie-name"><?php echo $movie['name'];?></div>
                </div>
            </a>
        </div>
    
        <?php
        }
    }else{
			// If no movies stored in table. It will show custom message as mentioned below.
        ?>
        <div class="no-movie-result">
            Sorry. No result for that keyword.
        </div>
    <?php
    }
    ?>
</div>
<?php } else {?>
<h1 class = "movie-name">Please Log in or Sign Up to view the contents of this site.</h1>
<?php } ?>

<!-- footer section -->
<?php require __DIR__ . '/footer.php'; ?>