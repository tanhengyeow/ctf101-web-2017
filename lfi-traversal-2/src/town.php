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
    		<?php
    			if ( isset( $_GET['file'] ) ) {
                    $str = str_replace("../","",$_GET['file']); 
                    
                    if (strpos($str,'php://filter/convert.base64-encode/resource') !== false) {
                        include ( $_GET['file'] . '.php');
                    }
                    else {
    				            include( "/var/www/html/" . $str . '.php' );
                    }
    			}
                else {
                    header("Location: town.php?file=status");
                }
    		?>
        
        <h2>Current Roster</h2> 
        <input type="checkbox" checked onclick="return false;">Stephen Curry (Point Guard)<br/>
        <input type="checkbox" checked onclick="return false;">Klay Thompson (Shooting Guard)<br/>
        <input type="checkbox" checked onclick="return false;">Anthony Davis (Center)<br/>
        <input type="checkbox" checked onclick="return false;">Lebron James (Power Forward)<br/>
        <input type="checkbox" checked onclick="return false;">Kahwi Leonard (Small Forward)<br/>
      </div>
      </div>
	</body>

</html>