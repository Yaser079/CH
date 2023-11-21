<?php
session_start();
$_SESSION['Dfilter']=1;
$_SESSION[$_GET['id']]=$_GET['value'];
?>