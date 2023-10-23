<?php
session_start();
include 'log.php';
$action=$_SESSION['name']." Logged out.";
create_log($_SESSION['uid'],$action);
session_unset();
session_destroy();
header("location:../");
?>