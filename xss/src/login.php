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
    <h4>Login</h4>
    <form action="authenticate.php" method="post" name="login" id="login">
        <p>Username: <input type="text" name="username" /></p>
        <p>Password: <input type="password" name="password" /></p>
        <input type="submit" value="Login" />
        <button type="button" onclick="location.href='register.php'" style="margin-left:20px;">Register</button>
    </form>
</div>
</div>
</body>
</html>