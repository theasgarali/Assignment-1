<?php

//FILE FOR LOGGING ALL LOG IN ATTEMPTS

use OOP\Classes\Auth;

//autoloader & config require
require(__DIR__.'/autoloader.php');
require(__DIR__.'/config.php');

require __DIR__ . '/header.php';

//create auth object
$auth = new Auth();

//check authorisation, redirect to index if guest
if (!Auth::check())
	header('location:index.php');

//Get the details of the user's last login with the site.
$attempts = $auth->read_logins();
?>
<div class="movie-container row pt-4">
	<table class="table">
		<tr>
			<th>Time</th>
			<th>Email</th>
			<th>Status</th>
		</tr>
		<?php if (0==count($attempts)): ?>
			<tr>
				<td colspan="3" class="text-center">No attempts</td>
			</tr>
		<?php else: ?>
			<?php foreach ($attempts as $attempt): ?>
				<tr>
					<td><?=date('r', $attempt['time'])?></td>
					<td><?=htmlentities($attempt['email'])?></td>
					<td><?=Auth::$statuses[$attempt['status']]?></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</table>
</div>

<?php require __DIR__ . '/footer.php';