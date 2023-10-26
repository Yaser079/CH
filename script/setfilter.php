<?php
session_start();
$_SESSION['filter']=1;
$_SESSION[$_GET['id']]=$_GET['value'];
?>