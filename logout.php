<?php
session_start();
setcookie("token", "", time() - 3600, "/", "", false, true);
session_unset();
session_destroy();
header('location: index.php');
?>