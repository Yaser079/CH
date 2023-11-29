<?php
session_start();
include '../Inc/DBcon.php';
include 'log.php';
function generateRandomString($length = 500) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$sql="select * from users where email='".$_GET['email']."' ;";
	$result=mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);
       
        $actual_link = 'http://'.$_SERVER['HTTP_HOST']; 
    $message="<div> Dear ".$row['name'].",<br>
    Please click on Reset to Reset your Password. <a href='". $actual_link."/reset.php?token=".generateRandomString()."&id=".$row['ID']."' > Reset</a>
    </div>";
    
    $to = $_GET['email']; // note the comma 
    $subject = 'Password Reset';
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; ';
    $headers[] = 'From: Support < admin@coopershillteam.com > ';
    $headers[] = 'Cc:   ';
    $headers[] = 'Bcc:  ';
    
    $send=0;
    while($send==0)
    { 
        if(mail($to, $subject, $message, implode("\r\n", $headers)))
        {
            $send=1;
        }
        
    }
        if($send>0)
        {
            $action=$row['name']." Request for reset password.";
            create_log($row['ID'],$action);
            echo "1"; 
        }
        else
        {
            echo "2";
        }
    	
	}
    else
    {
        echo "0";
        
    }

?>