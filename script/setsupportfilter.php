<?php
session_start();
$_SESSION['SUfilter']=1;
$_SESSION[$_GET['id']]=$_GET['value'];
?>