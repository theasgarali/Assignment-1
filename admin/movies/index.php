<?php

//ADMIN SECTION TO ADD, EDIT OR DELETE A MOVIE LISTING.

require_once(__DIR__ . '/../../autoloader.php');
require_once(__DIR__ . '/../../config.php');

use OOP\Classes\movie;

$movie_data = new movie;
$movies = $movie_data->search();

require __DIR__ . '/../../header.php';

?>

<div style="margin: 20px 0 20px;">
    <a href="<?php echo BASE_URL;?>/admin/movies/add.php" class="btn btn-primary">Add movie</a>
</div>

<div class="table-container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 140px;">Title</th>
                <th>Pic</th>
                <th>Description</th>
                <th style="width: 100px;">Rating</th>
                <th style="width: 140px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($movies as $movie){
            ?>
                <tr>
                    <td><?php echo $movie['name'];?></td>
                    <td><img class="movie-thumb-small" src="<?php echo BASE_URL.'/assets/'.$movie['image'];?>"></td>
                    <td class="movie-table-description">
                        <div>
                            <?php echo $movie['description'];?>
                        </div>
                    </td>
                    <td>
                        <div class="star-rating" data-rate="<?php echo $movie['rating'];?>">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </td>
                    <td>
                        <a href="<?php echo BASE_URL;?>/admin/movies/edit.php?id=<?php echo $movie['id'];?>" class="btn btn-success">Edit</a>
                        <a href="<?php echo BASE_URL;?>/admin/movies/delete.php?id=<?php echo $movie['id'];?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<?php

require __DIR__ . '/../../footer.php';