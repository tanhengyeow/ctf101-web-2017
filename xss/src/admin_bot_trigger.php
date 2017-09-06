<?php

$base_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/";

shell_exec('phantomjs /var/www/html/bot_browser.js --url '.$base_url.' --password ItMustBeAPW1CanRmb2 --profileid '.$_GET['uid']);
?>
Admin visited your page!