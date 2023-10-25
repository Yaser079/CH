<?php
 $actual_link = 'http://'.$_SERVER['HTTP_HOST']; 
 if($actual_link=="http://localhost")
  {
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
  }
  else{
    $servername = "localhost"; 	//Your servername here  
    $username = "artby_asad";			//Your username here     
    $password = "eGzFP,z~6]JJ";				//Your Password here      
    $dbname= "artby_ch";  // your db name here  

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn)
    {
      die("Connection failed: " . mysqli_connect_error());
    } 
  }


?>