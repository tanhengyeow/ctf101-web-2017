<?php
session_start();

if (isset($_POST['ready'])) {
	setcookie('stage', 'preparation');
	$_COOKIE['stage'] = 'preparation';
}
else {
	$_SESSION['status'] = 'false';
}

$check_edithtml = isset($_SESSION['status']);
$check_setcookie = isset($_COOKIE['stage']);
$check_correctcookie = $check_setcookie && $_COOKIE['stage'] == 'line-crossing ceremony';
$check_complete = $check_correctcookie && $_SERVER['HTTP_USER_AGENT'] == 'King Neptune';

if(!$check_complete) {
	$_POST['action'] = 'fail';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Initiation</title>
		<noscript><meta http-equiv="refresh" content="0; URL=/you_must_enable_javascript.html"></noscript>
    	<link rel="stylesheet" rev="stylesheet" href="./css/style.css" type="text/css">
	</head>

	<body>
		<div class="navbar">
			<a href="#">CTF101 2017</a>
		</div>
		<div class="centered-wrapper">
		<?php if (!$check_setcookie) : ?>

			<form action="" method="post">
				Are you ready for the initiation? <br /><br />
				<?php
					if ($check_edithtml) {
						printf('You must be <b>ready</b> to proceed with this initiation.<br><br>', PHP_EOL);
					}
				?>
				<input type="submit" name="mymentalstate" value="Yes" disabled/>
			</form>

		<?php elseif ($check_setcookie && !$check_correctcookie) : ?>
			<script type='text/javascript' src='../js/dontclickme.js'></script>
			<form action="" onsubmit="return validate()" method="post" >
				Your current stage: <?php print($_COOKIE['stage']); ?><br><br>
				Get to your next stage by decoding this string: bGluZS1jcm9zc2luZyBjZXJlbW9ueQ== <br><br>
				<input type="submit" value="Proceed to next stage"/>
			</form>

		<?php elseif ($check_correctcookie && !$check_complete) : ?>
			<script type='text/javascript' src='../js/dontclickme.js'></script>
			<form action="" method="post" >
				Your current stage: <?php print($_COOKIE['stage']); ?><br><br>
				You're about to complete the challenge. Find the agent that will grant you your rights. <br><br>
				<input type="submit" value="Complete challenge"/>
			</form>

		<?php elseif ($check_complete) : ?> 
			You have been initiated!<br>
			<b>flag{p011yw09_t0_5h311b@g}</b>;

		<?php endif; ?>
		</div>
	</body>

</html>