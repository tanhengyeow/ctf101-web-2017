<?php
session_start();
include "config.php";

if ($_GET['uid'] && $_GET['description']) {
    $stmt = mysqli_prepare($db, "UPDATE users SET description=CONCAT(?, '\n', description) WHERE uid=?");
	$log = date('Y/m/d H:i:s T') . ': ' . htmlspecialchars($_GET['description'], ENT_QUOTES, 'UTF-8');
    mysqli_stmt_bind_param($stmt, 'ss', $log, $_GET['uid']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
?>