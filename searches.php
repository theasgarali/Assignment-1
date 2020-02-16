<?php

//FILE FOR LOGGING ALL SEARCH ATTEMPTS

use OOP\Classes\Auth;
use OOP\Classes\Movie;

//autoloader & config require
require(__DIR__.'/autoloader.php');
require(__DIR__.'/config.php');

require __DIR__ . '/header.php';

//create an movie object.
$movieObject = new Movie();

//check authorisation, redirect to index if guest
if (!Auth::check())
	header('location:index.php');

//Get the details of the user's last searches with the site.
$attempts = $movieObject->read_searches();
?>
<div class="movie-container row pt-4">
	<table class="table">
	<h1>List of user search requests</h1>
		<tr>
			<th>Time</th>
			<th>Query</th>
			<th>Rating</th>
			<th>Results count</th>
		</tr>
		<?php if (0==count($attempts)): ?>
			<tr>
				<td colspan="4" class="text-center">No attempts</td>
			</tr>
		<?php else: ?>
			<?php foreach ($attempts as $attempt): ?>
				<tr>
					<td><?=date('r', $attempt['time'])?></td>
					<td><?=htmlentities($attempt['query'])?></td>
					<td><?=(0==$attempt['rating']?'ALL':Movie::$ratings[$attempt['rating']])?></td>
					<td><?=$attempt['count']?></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</table>
</div>

<?php require __DIR__ . '/footer.php';