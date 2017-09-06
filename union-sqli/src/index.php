<?php
   include("config.php");
   session_start();
   
   if(isset($_POST['q1ans']) && isset($_POST['q2ans']) && isset($_POST['q3ans'])) {

      if (  strcmp($_POST['q1ans'],"I hope you did not dwell too much into this looool.")==0 &&
            strcmp($_POST['q2ans'],"Sorry if you flipped a table...")==0 &&
            strcmp($_POST['q3ans'],"Now, submit these answers and get your flag."==0)) {
        $_SESSION['checkAns'] = true;
      }

      else {
        $_SESSION['checkAns'] = false;
      }

   }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Question and Answer</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="navbar">
      <a href="#">CTF101 2017</a>
    </div>  

    <div class="centered-wrapper">
    <div class="centered-content">

    <form class="form-style-7" method="post">
      <a href="faq.php">FAQ</a> <br><br>
    <ul>
    <li>
        <label for="q1">Why are there no pines or apples in pineapples?</label>
        <input type="text" name="q1ans" maxlength="100" value="">
        <span>Enter your answer here</span>
    </li>
    <li>
        <label for="q2">Why are there no eggs in eggplants?</label>
        <input type="text" name="q2ans" maxlength="100" value="">
        <span>Enter your answer here</span>
    </li>
    <li>
        <label for="q3">Why am I asking all these questions?</label>
        <input type="text" name="q3ans" maxlength="100" value="">
        <span>Enter your answer here</span>
    </li>
    <li>
        <input type="submit" value="Submit my awesome answers" >
    </li>
    </ul>
    <br />
    <?php 
      if ($_SESSION['checkAns']==true) 
        echo "<b>flag{h0w_d1d_y0u_g3t_th3_@n5w3r5s?}</b>"; 
      else if (isset($_SESSION['checkAns'])) 
        echo "Try harder.";
    ?>
    </form>

    </div>
    </div>
  </body>

</html>
