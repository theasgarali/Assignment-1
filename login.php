<?php

/* User needs to login to view the movies. If user is already logged, code will check the staus and send to the index.php file 
else run the rest of the code of this page which contains the login form to be fill up by the user for authenticate and check the movies list.*/

//autoloader & config require
require(__DIR__.'/autoloader.php');
require(__DIR__.'/config.php');
require __DIR__ . '/header.php';

//import namespaces
use OOP\Classes\Auth;
use OOP\Classes\failureMail;
use OOP\Classes\LoginSubject;

$login = new LoginSubject();
$login->attach(new failureMail());

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
	// if the request to call this file is post, you can find the method of the form in below HTML code 'form method="post"'.
	// This method sends the form data to the browser in hidden mode instead of adding them to the URL like https://www.movies.com/login.php?email=user@gmail&pass=1457889....
    if(!$login->createUser($_POST['email'], $_POST['password'])) { // Checking credential in the db. show error if credential doesn't exist
        $errors['invalid_credentials'] = 'Invalid email or password';
    }
    else{ // if credential exist, redirect..
        header('location:index.php');
    }
}
elseif(Auth::check()) { // if user has already logged in, redirect to index page, user doesn't need to login again
	header('location:index.php');
}
?>

<!DOCTYPE html >
<html>
<head>
<!-- head.php file contains the CSS, JS, third party code, etc for the site which are common for all pages. -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Movie Site/login</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL;?>/assets/css/main.css">
</head>
<body>

<div class="container">
    <div class="full-wrapper">
        <div class="auth-form-container">
            <h1 class="text-center" style="margin: 0 0 20px;">Login</h1>
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="email">Email:</label>
                    <div class="col-sm-8">
                        <input name="email" class="form-control" id="email" type="email" required>
                    </div>
                    <?php // if error message exist, it is displayed
                        if(isset($errors['invalid_credentials'])){
                    ?>
                    <div class="col-sm-9 col-sm-offset-2">
                        <div class="text-danger"><?php echo $errors['invalid_credentials']; ?></div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="password">Password:</label>
                    <div class="col-sm-8">
                        <input name="password" class="form-control" id="password" type="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <label class="checkbox-inline"><input type="checkbox" value="">Remember me</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>

