<?php session_start(); include 'functions.php';?>
<div class="table-responsive1">
                    <table id="rtable" class="table table-bordered table-hover text-center weekly-table" style="font-size: 12px !important;">
                        <thead>
                            
                        <?php 
                            
                            include '../Inc/DBcon.php';
                            $filter='';
                            if(isset($_SESSION['woffice']) && $_SESSION['woffice']!='all')
                            {
                                $filter=" And staff.office='".$_SESSION['woffice']."' ";
                            }
                            $sqlProjects="select projects.* from projects INNER join resource_weeks on resource_weeks.pid=projects.ID  INNER join staff on resource_weeks.staff_id=staff.ID where resource_weeks.week='".$_SESSION['weekly-resource']."' ".$filter."  group by projects.code;";
                            $projects=mysqli_query($conn,$sqlProjects);
                            if(mysqli_num_rows($projects) > 0 )
                            {
                                $i=1;
                                echo '<tr>
                                <th colspan="15" style="  border: none;"> </th>';
                                while($row2 = mysqli_fetch_array($projects))
                                {
                                    $country=getCountry($row2['country_id']);
                                        echo '<th style="background-color:'.$country['color'].';">'.$country['tag'].'</th>';
                                }
                                echo '</tr>';
                            }
                        ?>
                        
                        <tr>
                            <th class="narrow font-weight-bold stiky" data-orderable="false" rowspan="4"  >ID</th>
                            <th class="narrow font-weight-bold stiky" data-orderable="false" rowspan="4"  >View</th>
                            <th class="  narrow text-left font-weight-bold stiky" rowspan="4"  >Name</th>
                            <th class="  narrow font-weight-bold stiky" rowspan="4">Office</th>
                            <th class=" text-left stiky narrow font-weight-bold" rowspan="4"><div class="rotated">Projects</div></th>
                            <th class=" text-left stiky  narrow font-weight-bold" rowspan="4"><div class="rotated">Capacity</div></th>
                            <th class=" text-left stiky  narrow font-weight-bold" rowspan="4"><div class="rotated">Utilisation</div></th>
                            <th class=" text-left stiky  narrow font-weight-bold" rowspan="4"><div class="rotated">Utilisation (including leave)</div></th>
                            <th class=" text-left   narrow font-weight-bold" rowspan="4"><div class="rotated">VACATION / HOLIDAY</div></th>
                            <th class=" text-left   narrow font-weight-bold" rowspan="4"><div class="rotated">GENERAL OFFICE</div></th>
                            <th class=" text-left  narrow font-weight-bold" rowspan="4"><div class="rotated">MARKETING / BD</div></th>
                            <th class=" text-left   narrow font-weight-bold" rowspan="4"><div class="rotated">PUBLIC HOLIDAY</div></th>
                            <th class=" text-left   narrow font-weight-bold" rowspan="4"><div class="rotated">MEDICAL LEAVE/<br>HOSPITALIZATION LEAVE</div></th>
                            <th class=" text-left   narrow font-weight-bold" rowspan="4"><div class="rotated">ANNUAL LEAVE/BIRTHDAY LEAVE<br>/CHILD CARE/UNPAID LEAVE</div></th>
                            <th class="  narrow font-weight-bold" rowspan="2">REMARKS</th>
                                <?php 
                                
                                    include '../Inc/DBcon.php';
                                     
                                    $projects=mysqli_query($conn,$sqlProjects);
                                    if(mysqli_num_rows($projects) > 0 )
                                    {
                                        $i=1;
                                        while($row2 = mysqli_fetch_array($projects))
                                        {
                                            $country=getCountry($row2['country_id']);
                                                echo '<th class=" narrow font-weight-bold" style="background-color:'.$country['color'].';"><div class="rotated">'.$row2['name'].'</div></th>';
                                        }
                                    }
                                    mysqli_close($conn);
                                ?>
                        </tr>
                        
                         
                            <?php 
                                include '../Inc/DBcon.php';
                                $projects=mysqli_query($conn,$sqlProjects);
                                if(mysqli_num_rows($projects) > 0 )
                                {
                                    $i=1;
                                    echo '<tr>';
                                    while($row2 = mysqli_fetch_array($projects))
                                    {
                                        $country=getCountry($row2['country_id']);
                                            echo '<th class="  font-weight-bold" style="background-color:'.$country['color'].';"><div class="rotated">'.$row2['code'].'</div></th>';
                                    }
                                    echo '</tr>';
                                }
                                mysqli_close($conn);
                            ?>
                       
                        
                            <?php 
                                include '../Inc/DBcon.php';
                                $projects=mysqli_query($conn,$sqlProjects);
                                if(mysqli_num_rows($projects) > 0 )
                                {
                                    $i=1;
                                    echo '<tr>
                        
                                    <th class="narrow" >Stage</th>';
                                    while($row2 = mysqli_fetch_array($projects))
                                    {
                                        $res=getProjectStageOfWeek($row2['ID'],$_SESSION['weekly-resource']);
                                        if($res)
                                        {
                                            $stage=getStage($res['stage_id']);
                                            echo '<th class=" week"  id="'.$row2['ID'].'_'.$_SESSION['weekly-resource'].'" onclick="StageForm(this.id)" data-toggle="modal" data-target="#stage-model"  style="background-color:'.$stage['color'].';"><div class="rotated">'.$stage['short_name'].'</div></th>';
                                        }
                                        else
                                        {
                                            echo '<th class=" week"  id="'.$row2['ID'].'_'.$_SESSION['weekly-resource'].'" onclick="StageForm(this.id)" data-toggle="modal" data-target="#stage-model" ></th>';
                                        }
                                         
                                    }
                                    echo '</tr>';
                                }
                                mysqli_close($conn);
                            ?>
                         
                        
                            <?php 
                                include '../Inc/DBcon.php';
                                $projects=mysqli_query($conn,$sqlProjects);
                                if(mysqli_num_rows($projects) > 0 )
                                {
                                    $i=1;
                                    echo '<tr> <th class="narrow" data-orderable="false">Deadline</th>';
                                    while($row2 = mysqli_fetch_array($projects))
                                    {
                                            echo '<th class=" week" id="'.$row2['ID'].'-D" onclick="FetchDeadline(this.id)"   data-orderable="false" data-toggle="modal" data-target="#deadline-model" ><div class="rotated"> '.$row2['deadline'].'</div></th>';
                                    }
                                    echo '</tr>';
                                }
                                mysqli_close($conn);
                            ?>
                        <?php 
                                include '../Inc/DBcon.php';
                                $projects=mysqli_query($conn,$sqlProjects);
                                if(mysqli_num_rows($projects) > 0 )
                                {
                                    $i=1;
                                    echo '<tr> 
                                     <th class="narrow text-right" data-orderable="false" colspan="15">All Office Total Hours</th>';
                                    while($row2 = mysqli_fetch_array($projects))
                                    {
                                        $hours=getCurrentWeekHoursOfProject($row2["ID"],$_SESSION['weekly-resource']);
                                        if($hours>0)
                                        {
                                            echo '<th    data-orderable="false"> '.$hours.'</th>';
                                        }
                                        else{
                                            echo '<th    data-orderable="false"> 0</th>';
                                        }
                                            
                                    }
                                    echo '</tr>';
                                }
                                mysqli_close($conn);
                            ?>
                    </thead>
                    <tbody id="myTable">
                        <?php
                            include '../Inc/DBcon.php';
                             $filter='';
                            if(isset($_SESSION['woffice']) && $_SESSION['woffice']!='all')
                            {
                                $filter=" where office='".$_SESSION['woffice']."' ";
                            }
                            $sql2="select * from staff ".$filter.";";
                            $result2=mysqli_query($conn,$sql2);
                            if(mysqli_num_rows($result2) > 0 )
                            {
                                $ii=1;
                                while($row2 = mysqli_fetch_array($result2))
                                {
                                    $office=getOffice($row2['office']);
                                    $projectsCount=getCurrentWeekProjectsOfStaff($row2['ID'],$_SESSION['weekly-resource']);
                                    $hours= getCurrentWeekHoursOfStaff($row2['ID'],$_SESSION['weekly-resource']);
                                    $publicHlidy=getOfficeWeeklyHoliday($row2['office'],$_SESSION['weekly-resource']);
                                    $anualHolidy=getStaffWeeklyHoliday($row2['ID'],$_SESSION['weekly-resource']);
                                    $otherLeaves=getCurrentWeekLeavesOfStaff($row2['ID'],$_SESSION['weekly-resource']);
                                    $l1=$l2=$l3=$l4=$l5=$l6=0;
                                    $remarks='';
                                    if($otherLeaves!=0)
                                    {
                                        $l1=$otherLeaves['VACATION'];
                                        $l2=$otherLeaves['GENERAL'];
                                        $l3=$otherLeaves['MARKETING'];
                                        $l4=$otherLeaves['TRAINING'];
                                        $l5=$otherLeaves['OFFICE'];
                                        $l6=$otherLeaves['MEDICAL'];
                                        $remarks=$otherLeaves['REMARKS'];
                                    }
                                    $total=$l1+$l2+$l3+$l4+$l5+$l6+$publicHlidy+$anualHolidy;
                                    $name="'".$row2['nick_name']."'";
                                    $week="'".$_SESSION['weekly-resource']."'";
                                    $cp=(40-((int)$hours+$total))>0?"#BDD7EE":"#FFACA7";
                                    echo '<tr>
                                                <td class="stiky">'.$ii.'</td>
                                                <td class="stiky"> <a href="javascript:void(0)" class="name" onclick="WeeklyReport('.$row2['ID'].','.$name.','.$week.')"  data-toggle="modal" data-target="#modal-weekly">
                                                    <i class="nav-icon fas fa-eye"></i></a></td>
                                                <td class="text-left stiky">'.$row2['nick_name'].'</td>
                                                <td class="stiky">'.$office['code'].'</td>
                                                <td class="stiky font-weight-bold ">'.$projectsCount.' </td>
                                                <td class="stiky font-weight-bold" style="background-color: '.$cp.'">'.(40-((int)$hours+$total)).'</td>
                                                <td class="stiky font-weight-bold">'.(((int)$hours/40)*100).'% </td>
                                                <td class="stiky font-weight-bold">'.((((int)$hours+$total)/40)*100).'% </td>
                                                <td class="week font-weight-bold" id="VACATION_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l1.'</td>
                                                <td class="week font-weight-bold" id="GENERAL_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l2.'</td>
                                                <td class="week font-weight-bold" id="MARKETING_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l3.'</td>
                                                <td class="font-weight-bold">'.$publicHlidy.'</td>
                                                <td class="week font-weight-bold" id="MEDICAL_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l6.'</td>
                                                <td class="font-weight-bold">'.$anualHolidy.'</td>
                                                <td class="week" id="REMARKS_'.$_SESSION['weekly-resource'].'" onclick="NewRemakrs('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-remark">'.$remarks.'</td>';
                                                
                                  
                                                $projects=mysqli_query($conn,$sqlProjects);
                                                if(mysqli_num_rows($projects) > 0 )
                                                {
                                                    $i=1;
                                                    while($row1 = mysqli_fetch_array($projects))
                                                    {
                                                       $staffhours= getProjectWeekHoursOfStaff($row1['ID'],$_SESSION['weekly-resource'],$row2['ID']);
                                                       if($staffhours>0) 
                                                       {
                                                        echo '<td class="font-weight-bold">'.$staffhours.'</td>';
                                                       }
                                                       else{
                                                        echo '<td> </td>';
                                                       }
                                                      
                                                    }
                                                     
                                                }
                                            echo '</tr>';
                                
                           
                                            $ii++;
                                }
                            }
                            mysqli_close($conn);
                        ?>
                        </tbody>
                    </table>
                </div>