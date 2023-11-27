<?php
session_start();
    include '../Inc/DBcon.php';
    $sql2="  (select *,users.name as name from logs inner join users on users.ID=logs.uid where logs.uid='".$_SESSION['uid']."' order by logs.ID desc limit 5);";
    $result=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result) > 0 )
    {
        
        while($row = mysqli_fetch_array($result))
        {
        
            
            echo '<a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
            
            <div class="media-body">
                <h3 class="dropdown-item-title"><b> '.$row['name'].' </b></h3>
                <p class="text-sm">'.$row['action'].'</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>'.$row['created_at'].'</p>
            </div>
            </div>
            <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>';
        }
    }
    mysqli_close($conn);
?>
<a href="logs.php" class="dropdown-item dropdown-footer">See All Logs</a>