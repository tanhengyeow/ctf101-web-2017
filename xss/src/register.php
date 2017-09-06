<?php
session_start();
require "config.php";

// https://stackoverflow.com/questions/1846202/php-how-to-generate-a-random-unique-alphanumeric-string
function crypto_rand_secure($min, $max) {
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length) {
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}

$success = FALSE;

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['cpassword'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        $message = "Please enter a username.";
    } else if (strlen($username) < '8') {
        $message = "Username must contain at least 8 characters.";
    } else if (empty($password)) {
        $message = "Please enter a password.";
    } else if ($password !== $_POST["cpassword"]) {
        $message = "Password mismatched.";
    } else if (strlen($password) < '8') {
        $message = "Password must contain at least 8 characters.";
    } else if (!preg_match("#[0-9]+#", $password)) {
        $message = "Password must contain at least 1 number.";
    } else if (!preg_match("#[A-Z]+#", $password)) {
        $message = "Password must contain at least 1 uppercase letter.";
    } else if (!preg_match("#[a-z]+#", $password)) {
        $message = "Password must contain at least 1 lowercase letter.";
    }

    if (!isset($message)) {
        $stmt = mysqli_prepare($db, "SELECT * FROM users WHERE username=?");
        mysqli_stmt_bind_param($stmt, 's', $_POST['username']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $num_rows = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);

        if ($num_rows) {
            $message = "Username already exist.";
        } else {
            $token = getToken(20);
            $stmt = mysqli_prepare($db, "INSERT INTO users (uid, username, password) VALUES(?, ?, MD5(?))");
            mysqli_stmt_bind_param($stmt, 'sss', $token, $_POST['username'], $_POST['password']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $success = TRUE;
            $message = "You are successfully registered.<br /><br /><button type='button' onclick='location.href=\"login.php\"'>Login</button>";
        }
    }
}
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
<?php if ($success): ?>
    <p><?php echo $message; ?></p>
<?php else: ?>
<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
    <h4>Register</h4>

    <form action="register.php" method="post" name="register" id="register">
        <p>Username: <input type="text" name="username" maxlength="30" /></p>
        <p>Password: <input type="password" name="password" maxlength="64" /></p>
        <p>Confirm Password: <input type="password" name="cpassword" maxlength="64" /></p>
        <input type="submit" value="Register" />
    </form>
    <br/>

    <button type="button" onclick="location.href='login.php'">Back</button>
<?php endif; ?>
</div>
</div>
</body>
</html>