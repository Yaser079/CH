<?php
$servername = "localhost"; 	//Your servername here  
$username = "root";			//Your username here     
$password = "";				//Your Password here      
$dbname= "ch_resource";  // your db name here	   

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn)
 {
  die("Connection failed: " . mysqli_connect_error());
} 

?>