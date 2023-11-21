<?php 
session_start();
include 'functions.php';
?>
<div class="table-responsive">
    <table id="example1" class="table table-bordered table-hover text-center review-list">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Week</th>
                <th>Status</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    include '../Inc/DBcon.php';
                    $sql2="select * from projects_update where pid='".$_GET['id']."' order by ID DESC;";
                    $result=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result) > 0 )
                    {
                        $i=1;
                        while($row = mysqli_fetch_array($result))
                        {
                            $pro=getProject($_GET['id']);
                            $rew="";
                            if($row['status']>0)
                            {
                                $r=getProjectReview($row['status']);
                                $rew=$r['name'];

                            }
                           echo '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.$pro['name'].'</td>
                                    <td>'.$row['week'].'</td>
                                    <td>'.$rew.'</td>
                                    <td>'.$row['comments'].'</td>
                                    
                                </tr>';
                                $i++;
                        }
                    }
                    mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>