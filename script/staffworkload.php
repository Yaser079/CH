<div class="table-responsive">
    <table id="example1" class="table table-bordered table-hover text-center staff-list">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Nick Name</th>
                <th class="rotated">Office</th>
                <th class="rotated">Projects</th>
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
                $filter="";
                if($_GET['id']>0)
                {
                    $filter=" where office='".$_GET['id']."' ;";
                }
                include '../Inc/DBcon.php';
                $sql2="select * from staff ".$filter;
                $result2=mysqli_query($conn,$sql2);
                if(mysqli_num_rows($result2) > 0 )
                {
                    $i=1;
                    while($row2 = mysqli_fetch_array($result2))
                    {
                        $office=getOffice($row2['office']);
                        $projects=getStaffProjectsCount($row2['ID']);
                        $name="'".$row2['nick_name']."'";
                        echo '<tr class="name"  onclick="AllProjects('.$row2['ID'].','.$name.')"  data-toggle="modal" data-target="#modal-all-projects">
                                <td>'.$i.'</td>
                                <td >'.$row2['name'].'</td>
                                <td>'.$row2['nick_name'].' </td>
                                <td>'.$office['code'].'</td>
                                <td class="font-weight-bold">'.$projects.'</td>
                                    ';
                                    $weeks=getWeeks(date('Y'));
                                foreach($weeks as $week)
                                {
                                    $hours=getStaffWeeklyHoliday($row2['ID'],$week);
                                    $holiday=getOfficeWeeklyHoliday($row2['office'],$week);
                                    $weekly= getStaffWeeklyWork($row2['ID'],$week);
                                    $total=$hours+$holiday+$weekly;
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
                                    echo '<td class="font-weight-bold '. $textColor.'"  style="background-color:'.$color.'" data-tooltip="tooltip" data-placement="top" title="'.$status.'">'.$total.'</td>';
                }
                                
                                echo '</tr>';
                    
                
                                $i++;
                    }
                }
                mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>