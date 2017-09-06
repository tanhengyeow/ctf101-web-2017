<?php
session_start();
include "config.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $password = md5($_POST['password']);
    $stmt = mysqli_prepare($db, "SELECT `uid` FROM `users` WHERE `username` = ? AND `password` = ?");
    mysqli_stmt_bind_param($stmt, 'ss', $_POST['username'], $password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) == 0) {
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        die("<!DOCTYPE html><html lang=\"en\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"><title>CTF101 | XSS</title><link rel=\"stylesheet\" rev=\"stylesheet\" href=\"./css/style.css\" type=\"text/css\"></head><body><div class=\"navbar\"><a href=\"#\">CTF101 2017</a></div><div class=\"centered-wrapper\"><div class=\"centered-content\"><h3>XSS</h3><p>Invalid username or password!</p><button type='button' onclick='location.href=\"login.php\"'>Back</button></div></div></body></html>");
    } else {
        mysqli_stmt_bind_result($stmt, $uid);
        mysqli_stmt_fetch($stmt);
        $_SESSION['uid'] = $uid;
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        header("Location: /index.php");
        exit;
    }
}
?>