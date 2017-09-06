<?php
session_start();
$uid = $_SESSION['uid'];

if (!$uid) {
    header("Location: login.php");
    exit;
}

header('X-XSS-Protection: 0');
include "config.php";

if (isset($_POST['wall'])) {
    $stmt = mysqli_prepare($db, "UPDATE users SET wall=? WHERE uid=?");
    mysqli_stmt_bind_param($stmt, 'ss', $_POST['wall'], $uid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

$stmt = mysqli_prepare($db, "SELECT username, wall, description FROM users WHERE uid=?");
mysqli_stmt_bind_param($stmt, 's', $uid);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $username, $wall, $description);
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
    <h4><?php echo $username; ?>'s Profile Page</h4>
    <p>UID: <?php echo $uid; ?></p>
<?php if ($uid === "tmgn75RrISmhyxGeZEUa"): ?>
    <p style="margin-top:0;">flag{M3_w@n7_c0ok1e_m3_5teal_co0ki3}</p>
<?php endif; ?>

    <button type="button" onclick="location.href='wall.php'" style="margin-bottom:20px;">View Wall</button>

    <form uid="wall_form" novaluidate="novaluidate" action="index.php" accept-charset="UTF-8" method="post">
        <textarea name="wall" rows=3 cols=80><?php echo $wall ?></textarea><br/>
        <input type="submit" name="update_wall" value="Submit entry">

    <?php if ($uid !== "tmgn75RrISmhyxGeZEUa"): ?>
        <script>
        function trigger_admin() {
            window.open('admin_bot_click.php?uid=<?php echo $uid; ?>', 'Admin Simulation', 'status=1, height=50, width=300, left=100, top=100, resizable=0');
        }
        </script>
        <button onclick="trigger_admin()" style="margin-left:20px;">Request For Admin to Visit Your Wall</button>
    <?php endif; ?>
    </form>

    <h5 style="margin-bottom:10px;">Description</h5>
    <div style="border:1px solid gray;width:660px;height:200px;overflow:auto;"><?php echo nl2br($description); ?></div>
    <br/>

    <button type="button" onclick="location.href='logout.php'">Logout</button>
</div>
</div>
</body>
</html>