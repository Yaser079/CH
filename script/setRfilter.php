<?php
session_start();
$_SESSION['Rfilter']=1;
$_SESSION[$_GET['id']]=$_GET['value'];
?>