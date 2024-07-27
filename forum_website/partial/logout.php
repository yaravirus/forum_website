<?php
session_start();
session_unset();
session_destroy();
header("location:/PHP/PHPALLcodes/forum_website/partial/login.php");
exit;
?>