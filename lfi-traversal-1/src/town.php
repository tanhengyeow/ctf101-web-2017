<?php
session_start();

if (!isset($_SESSION['pf_name'])) {
	$_SESSION['pf_name'] = "???";
} 

if (!isset($_SESSION['sf_name'])) {
	$_SESSION['sf_name'] = "???";
} 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My NBA Dream Team</title>
      <link rel="stylesheet" rev="stylesheet" href="./css/style.css" type="text/css">
	</head>

    <body>
        <div class="navbar">
            <a href="#">CTF101 2017</a>
        </div>        
        <br />
        <div class ="centered-wrapper">
        <div class="centered-content">
        <h1>Players in town</h1>

        <ul style="list-style: upper-roman;">
            <li><a href="town.php?player=chris_paul">Approach Chris Paul</a></li>
            <li><a href="town.php?player=james_harden">Approach James Harden</a></li>
            <li><a href="town.php?player=draymond_green">Approach Draymond Green</a></li>
            <li><a href="town.php?player=kevin_durant">Approach Kevin Durant</a></li>
        </ul>

		<?php
			$included = true;
			if ( isset( $_GET['player'] ) ) {
				include( "/var/www/html/" . $_GET['player'] . '.php' );
			}
		?>

        <?php 
        	if ( strcmp($_SESSION['sf_name'],"Kahwi Leonard")==0 && strcmp($_SESSION['pf_name'],"Lebron James")==0 ) {
        		echo "<br><br><b>flag{t#3_dr3@m_15_r3@1}</b><br>";
			}
       	?>

        <h2>Current Roster</h2> 
        <input type="checkbox" checked onclick="return false;">Stephen Curry (Point Guard)<br/>
        <input type="checkbox" checked onclick="return false;">Klay Thompson (Shooting Guard)<br/>
        <input type="checkbox" checked onclick="return false;">Anthony Davis (Center)<br/>

        <input type="checkbox" <?php if (strcmp($_SESSION['pf_name'],"Lebron James")==0) echo 'checked' ?> onclick="return false;"><?php echo $_SESSION['pf_name']; ?> (Power Forward)<br/>

        <input type="checkbox" <?php if (strcmp($_SESSION['sf_name'],"Kahwi Leonard")==0) echo 'checked' ?> onclick="return false;"><?php echo $_SESSION['sf_name']; ?> (Small Forward)<br/>
        </div>
        </div>
	</body>

</html>