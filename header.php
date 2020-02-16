<?php

//HEADER FILE

use OOP\Classes\Auth;

?>

<!DOCTYPE html >
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Movies</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL;?>/assets/css/main.css">

</head>
<body>
<nav class="navbar navbar-default  navbar-expand-lg">
	<div class="container">
		<a class="navbar-brand" href="<?php echo BASE_URL;?>">MovieSite</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<?php
		if(Auth::check()){ // if user has already logged in,
			?>
			<form class="navbar-form mr-auto" method="get" action="<?php echo BASE_URL;?>">
				<div class="input-group">
					<input name="search" type="text" class="form-control" placeholder="Search" value="<?=(isset($_GET['search'])?addslashes($_GET['search']):'')?>">
					<select class="custom-select" name="rating">
						<option <?=(!isset($_GET['rating'])||0==$_GET['rating']?'selected':'')?> value="0">All</option>
						<?php foreach (OOP\Classes\Movie::$ratings as $k=>$label): ?>
							<option value="<?=$k?>" <?=(isset($_GET['rating'])&&$k==$_GET['rating']?'selected':'')?>><?=$label?></option>
						<?php endforeach; ?>
					</select>
					<div class="input-group-append">
						<button class="btn btn-light" type="submit">
							<i class="fa fa-search"></i>
						</button>
					</div>
				</div>
			</form>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
					<?php if(Auth::isAdmin()): ?>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo BASE_URL;?>/admin/movies">Movie list</a>
						</li>
					<?php endif; ?>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo BASE_URL;?>/logs.php">Logs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo BASE_URL;?>/searches.php">Requests</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo BASE_URL;?>/logout.php">Logout</a>
					</li>
				</ul>
			</div>
			<?php
		}
		else{
			?>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="<?php echo BASE_URL;?>/login.php">Login</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo BASE_URL;?>/signup.php">Signup</a>
					</li>
				</ul>
			</div>
			<?php
		}
		?>
	</div>
</nav>

<div class="container">