<?php
   include("config.php");
   session_start();

   if(isset($_POST['search'])) {

      $search = $_POST['search'];
      // Filter user input from `sleep` and `benchmark` 
      $search = str_ireplace('sleep', '', $search);
      $search = str_ireplace('benchmark', '', $search);

      $sql = "SELECT * FROM items WHERE name = '$search' ";
      $result = mysqli_query($db,$sql);
      $count = mysqli_num_rows($result);
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
      <br><br><br>
      <form method="post">
        <input type="text" name="search" placeholder="Search for items here.."><br>
        <input type="submit" value="Search">
      </form>
      <br>
      <?php if(isset($_POST['search']) && $count == 0): ?>
        <strong>No such item found in our store.</strong> <br><br>
      <?php elseif(isset($_POST['search']) && $count > 0): ?>
        <strong>This item exists in our store.</strong> <br><br>
      <?php endif; ?>
      <a href="index.php">Go back</a>

    </div>
    </div>
  </body>

</html>