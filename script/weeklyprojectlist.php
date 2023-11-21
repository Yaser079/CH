<?php session_start();
$id=$_GET['id'];
$week=$_SESSION['weekly-resource'];
?>
<div class="table-responsive">
    <table id="exmaple1" class="table table-bordered table-hover text-center weekly-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Name</th>
                <th>Country</th>
                <th>Stage</th>
                <th>Week</th>
                <th>Hours</th>
            </tr>
            </thead>
            <tbody>
            <?php
                include 'functions.php';
                include '../Inc/DBcon.php';
                $sql2="select * from resource_weeks where week='".$week."' AND staff_id='".$id."' And hours>'0';";
                $result=mysqli_query($conn,$sql2);
                if(mysqli_num_rows($result) > 0 )
                {
                        $i=1;
                    while($row = mysqli_fetch_array($result))
                    {  
                    $prject=getProject($row['pid']);
                    $country=getCountry($prject['country_id']);
                    $weekStage=getResourceStageWeek($row['pid'],$row['week']);
                    
                    $stage=getStage($weekStage);
                        echo '<tr>
                                <td>'.$i.'</td>
                                <td>'.$prject['code'].'</td>
                                <td>'.$prject['name'].'</td>
                                <td style="background-color: '.$country['color'].';">'.$country['tag'].'</td>';
                                if($stage)
                                {
                                    echo '<td style="background-color: '.$stage['color'].';">'.$stage['short_name'].'</td>';
                                }
                                else
                                {
                                    echo '<td ></td>';
                                }
                                echo '
                                <td>'.$row['week'].'</td>
                                <td>'.$row['hours'].'</td>
                            </tr>';
                        $i++;
                    }
                }
                mysqli_close($conn);
            ?>
            </tbody>          
    </table>

    </div>