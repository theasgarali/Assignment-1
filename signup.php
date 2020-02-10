<?php

/*This file is used to SIGNUP. If user is already logged-in and visits this page, system will redirect him to the index page.*/


//autoloader & config require
require(__DIR__.'/autoloader.php');
require(__DIR__.'/config.php');
require __DIR__ . '/header.php';


use OOP\Classes\Auth;

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $auth = new Auth;

	// If name is less than 3 characters - error.
    if(strlen($name)<3){
        $errors['invalid_name'] = 'Name must be more that 3 characters.';
    }
	// If the password is less than 6 characters - error.
    if(strlen($password)<6){
        $errors['invalid_password'] = 'Password must be more that 6 characters.';
    }
	// Before creating an account, system will check the list of registered users with the email id provided. 
    if($auth->is_email($email)){
        $errors['invalid_email'] = 'Email already exists.';
    }

    //register new user if no errors
    if (0==count($errors)) {

		$user = new Auth;

		$user->signup($name, $email, $password);
		if (!$user->check_login($email, $password)) {
			$errors['invalid_credentials'] = 'Invalid email or password';
			header('location:login.php');
		}
	}
}
//If user is already logged-in, system will redirect him to the site main page.
elseif(Auth::check()){
	header('location:index.php');
}
?>

<!DOCTYPE html >
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Movie Site/signup</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL;?>/assets/css/main.css">
</head>
   

<body style="background-color: #000000; color: #FFF ">

<div class="container">
    <div class="full-wrapper">
        <div class="auth-form-container">
            <h1 class="text-center" style="margin: 0 0 20px;">Signup</h1>
            <form class="form-horizontal" method="post" action="#">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">Name:</label>
                    <div class="col-sm-8">
                        <input name="name" class="form-control" id="name" type="name" required>
                    </div>
                    <?php
                        if(isset($errors['invalid_name'])){
                    ?>
                    <div class="col-sm-9 col-sm-offset-2">
                        <div class="text-danger"><?php echo $errors['invalid_name']; ?></div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="email">Email:</label>
                    <div class="col-sm-8">
                        <input name="email" class="form-control" id="email" type="email" required>
                    </div>
                    <?php
                        if(isset($errors['invalid_email'])){
                    ?>
                    <div class="col-sm-9 col-sm-offset-2">
                        <div class="text-danger"><?php echo $errors['invalid_email']; ?></div>
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
                    <?php
                        if(isset($errors['invalid_password'])){
                    ?>
                    <div class="col-sm-9 col-sm-offset-2">
                        <div class="text-danger"><?php echo $errors['invalid_password']; ?></div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary btn-block">Sign up</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>

