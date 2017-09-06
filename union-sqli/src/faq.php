<?php
   include("config.php");
   session_start();

   $counter = 0;

   if(isset($_POST['search'])) {

      $search = $_POST['search'];
      // Filter user input from `sleep` and `benchmark` 
      $search = str_ireplace('sleep', '', $search);
      $search = str_ireplace('benchmark', '', $search);

      $sql = "SELECT * FROM faq WHERE question LIKE '%$search%'";
   }

      $result = mysqli_query($db,$sql);
      $count = mysqli_num_rows($result);

      if(!$result) {
        $output = mysqli_error($db);
      } 

      else if($count == 0) {
        $output = "No questions with such search term found.";
      } 

      else {
        while ($row = mysqli_fetch_array($result,MYSQLI_NUM)) {

          if ($counter > 5) {
            $output = "You returned more than the maximum number of rows in the current table.";
            break;
          }
          else {
            $output .= "<li><div class=\"titulo\">$row[3]</div><input type=\"checkbox\"><div class=\"resposta\">$row[4]</div></li>";
          }
          $counter++;
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
      <br><br><br>
      <form method="post">
        <input type="text" name="search" placeholder="Search for faq here.."><br>
        <input type="submit" value="Ask">
      </form>
      <ol class="faq">
        <?php echo $output ?>
      </ol>
      <a href="index.php">Go back</a>

    </div>
    </div>
  </body>

</html>