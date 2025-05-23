<?php
session_start();
//destroy session
session_destroy();
//unset cookies
setcookie('admin_login', '', 0, "/");

header("Location: dashboard.php");
?>