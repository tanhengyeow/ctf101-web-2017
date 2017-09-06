<?php
session_start();

$IDEALNAME == false;

if(isset($_POST['username'])) {
    $result = $_POST['username'];
    if (strcmp($result,'danube') == 0) {
    	$IDEALNAME = true;
    } 
}

$STATS = array();
$IDEALSTATS = false;

$_SESSION['count'] = (isset($_SESSION['count'])) ? $_SESSION['count'] + 1 : 0;

for ($i=0;$i<4;$i++) {
	$STATS[] = rand(50,100);
}

if ($_SESSION['count'] % 115 == 0 && $_SESSION['count'] != 0) {
    $STATS = [100,100,100,100];
    $IDEALSTATS = true;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My Ideal Character</title>
    <link rel="stylesheet" rev="stylesheet" href="./css/style.css" type="text/css">
	</head>
	<body>
		<div class="navbar">
			<a href="#">CTF101 2017</a>
		</div>  
		<div class="centered-wrapper">
		<form action="" method="post">
            <?php if ($IDEALSTATS == true) echo "<b>Ideal stats!</b>\n"; ?><br />
            <?php if ($IDEALNAME == true) echo "<b>Ideal name!</b>\n"; ?><br />

            <?php if ($IDEALSTATS == true && $IDEALNAME == true): ?>
				flag{1m_7#3_brv73_w@2210r_0f_ju571c3}	<br/><br/>
			<?php else: ?>

            Username:  <input type="text" name="username" value="<?php echo (isset($result))?$result:'';?>"/><br /><br />

            <?php endif; ?>

            	<div class="centered-content">
				<table>
					<tr>
						<th>Attributes</th>
						<th>Stats</th>
					</tr>
					<tr>
						<td>Strength</td>
						<td><?php print($STATS[0]); ?></td>
					</tr>
					<tr>
						<td>Dex</td>
						<td><?php echo $STATS[1]; ?></td>
					</tr>
					<tr>
						<td>Intel</td>
						<td><?php echo $STATS[2]; ?></td>
					</tr>
					<tr>
						<td>Luck</td>
						<td><?php echo $STATS[3]; ?></td>
					</tr>
				</table>
				</div>
				<br/>
			<input type="image" src="/dice.png" border="0"  alt="submit" /><br /><br />
            <a href ="randomnames.txt">This list of names might help.</a>
		</form>
		</div>
	</body>

</html>
