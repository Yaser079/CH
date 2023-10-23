<?php
   
	include 'Inc/DBcon.php';
	$sql99="select * from site";
	$result99=mysqli_query($conn,$sql99);
	$row99 = mysqli_fetch_array($result99);
	$_SESSION['site']=$row99['site'];
	$_SESSION['prefix']=$row99['prefix'];
	$_SESSION['suffix']=$row99['suffix'];
	$_SESSION['logo']=$row99['logo']; 

?>