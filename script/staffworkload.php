<div class="table-responsive1">
    <table id="wtable" class="table table-bordered table-hover text-center staff-list">
        <thead>
            <tr>
                <th class="stiky">ID</th>
                <th class="stiky" style="width: 120px !important;">Name</th>
                <th class="stiky" style="width: 120px !important;">Nick Name</th>
                <th class=" stiky"  ><div class="rotated" >Office</div></th>
                <th class=" stiky"  ><div class="rotated"  >Projects</div></th>
                <?php 
                include 'functions.php';
                $weeks=getWeeks(date('Y'));
                    foreach($weeks as $week)
                    {
                        echo '<th  data-orderable="false"><div class="rotated"> '.$week.' </div></th>';
                    }
                ?>   
            </tr>
        </thead>
        <tbody id="myTable">
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
                                <td class="stiky">'.$i.'</td>
                                <td class="stiky" style="width: 120px !important;">'.$row2['name'].'</td>
                                <td class="stiky" style="width: 120px !important;">'.$row2['nick_name'].' </td>
                                <td class="stiky">'.$office['code'].'</td>
                                <td class="stiky font-weight-bold">'.$projects.'</td>
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