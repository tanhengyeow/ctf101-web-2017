<?php
session_start();
$uid = $_SESSION['uid'];

if (!isset($uid)) {
    header("Location: login.php");
    exit;
}

header('X-XSS-Protection: 0');
include "config.php";

if (isset($_GET['uid']) && $uid === "tmgn75RrISmhyxGeZEUa") {
    //Admin uses this to browse to other people's profiles.
    $uid = $_GET['uid'];
}

$stmt = mysqli_prepare($db, "SELECT username, wall FROM users WHERE uid=?");
mysqli_stmt_bind_param($stmt, 's', $uid);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $username, $wall);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>CTF101 | XSS</title>
    <link rel="stylesheet" rev="stylesheet" href="./css/style.css" type="text/css">
</head>
<body>
<div class="navbar">
    <a href="#">CTF101 2017</a>
</div>
<div class="centered-wrapper">
<div class="centered-content">
    <h3>5cr1ptK1dd15s</h3>
    <h4 style="margin-bottom:10px;"><?php echo $username; ?>'s Wall</h4>
    <div style="border:1px solid gray;width:582px;height:100px;overflow:auto;"><?php echo $wall; ?></div>
    <br/>

    <button type="button" onclick="location.href='index.php'" style="margin-top:20px;">Back</button>
</div>
</div>
</body>
</html>