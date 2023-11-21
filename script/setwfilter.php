<?php
session_start();
$_SESSION['Wfilter']=1;
$_SESSION[$_GET['id']]=$_GET['value'];
?>