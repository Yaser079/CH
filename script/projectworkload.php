<div class="table-responsive">
    <table class="table table-bordered table-hover text-center workload-projects">
            <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Name</th>
                <th>Country</th>
                <th>Stage</th>
                <th>PM</th>
                <?php 
                include 'functions.php';
                $weeks=getWeeks(date('Y'));
                    foreach($weeks as $week)
                    {
                        echo '<th class="rotated"> '.$week.' </th>';
                    }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
                include '../Inc/DBcon.php';
                $sql2="select * from resource_weeks where staff_id='".$_GET['id']."' AND hours>'0' group by pid ;";
                $result=mysqli_query($conn,$sql2);
                if(mysqli_num_rows($result) > 0 )
                {
                        $i=1;
                    while($row = mysqli_fetch_array($result))
                    {  

                        $prject=getProject($row['pid']);
                        $country=getCountry($prject['country_id']);
                        $stage=getStage($prject['stage']);
                        $pm=getManager($prject['manager_id']);
                        echo '<tr>
                                <td>'.$i.'</td>
                                <td>'.$prject['code'].'</td>
                                <td >'.$prject['name'].'</td>
                                <td style="background-color: '.$country['color'].';">'.$country['tag'].'</td>
                                <td style="background-color: '.$stage['color'].';">'.$stage['short_name'].'</td>
                                <td >'.$pm['nick_name'].'</td>';
                                $weeks=getWeeks(date('Y'));
                                foreach($weeks as $week)
                                {
                                    
                                    $weekly=getResourceWeek($row['pid'],$row['staff_id'],$week);
                                    $total=$weekly>0?$weekly:0;
                                    $color="";
                                    $status="No Work";
                                    $textColor="text-muted small";
                                    if($total<40 && $total>0)
                                    {
                                        $color="#BDD7EE";
                                        $status="Needs Work";
                                        $textColor="";
                                    }
                                    else if($total==40)
                                    {
                                        $color="#A9D08E";
                                        $status="Good Fully Work";
                                        $textColor="";
                                    }
                                    else if($total>40)
                                    {
                                        $color="#FFACA7";
                                        $status="Overloaded";
                                        $textColor="";
                                    }
                                    echo '<td class=" font-weight-bold '.$textColor.'" style="background-color:'.$color.'" data-tooltip="tooltip" data-placement="top" title="'.$status.'">'.$total.'</td>';
                                }
                                echo'</tr>';
                        $i++;
                    }
                }
                mysqli_close($conn);
            ?>
            </tbody>          
    </table>

</div>