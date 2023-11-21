<?php
session_start();
$_SESSION['Afilter']=1;
$_SESSION[$_GET['id']]=$_GET['value'];
?>