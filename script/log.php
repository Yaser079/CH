<?php
function create_log($id,$action)
{ 
    include '../Inc/DBcon.php';
    $sql2="insert into logs (uid,action) values('".$id."','".$action."')";
    mysqli_query($conn,$sql2);
}
?>