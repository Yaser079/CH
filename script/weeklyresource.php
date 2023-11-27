<?php session_start(); include 'functions.php'; ?>
<div class="table-responsive">
    <table id="example1" class="table table-bordered table-hover text-center resource-table">
        <thead>
            <tr>
                <th class="narrow">ID</th>
                <th class="narrow">View</th>
                <th class="narrow">Name</th>
                <th class="narrow">Office</th>
                <th class=" narrow ">No of Projects</th>
                <th class=" narrow "><?= $_SESSION['weekly-resource'];?> Hours</th>
                <th class=" narrow ">Capacity</th>
                <th class=" narrow ">Utilisation</th>
                <th class=" narrow ">Utilisation (including leave)</th>
                <th class=" narrow ">VACATION / HOLIDAY</th>
                <th class=" narrow ">GENERAL OFFICE</th>
                <th class=" narrow ">MARKETING / BD</th>
                <th class=" narrow ">TRAINING/ RESERVIST</th>
                <th class=" narrow ">OFFICE HOLIDAY</th>
                <th class=" narrow ">PUBLIC HOLIDAY</th>
                <th class=" narrow ">MEDICAL LEAVE/<br>HOSPITALIZATION LEAVE</th>
                <th class=" narrow ">ANNUAL LEAVE/BIRTHDAY LEAVE<br>/CHILD CARE/UNPAID LEAVE</th>
                <th class=" narrow ">REMARKS</th>
            </tr>
        </thead>
        <tbody class="font-weight-bold">
            <?php
                include '../Inc/DBcon.php';
               
                $filter="";
                if(isset($_SESSION['Wfilter']))
                {
                
                    if( isset($_SESSION['woffice']) && $_SESSION['woffice']!='all')
                    {
                        $filter.=" AND office='".$_SESSION['woffice']."' ";
                    }
                
                
                }
                $sql2="select * from staff where 1=1 ".$filter." ;";
                $result2=mysqli_query($conn,$sql2);
                if(mysqli_num_rows($result2) > 0 )
                {
                    $i=1;
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
                        echo '<tr >
                                <td>'.$i.'</td>
                                <td >
                                <a href="javascript:void(0)" class="name" onclick="WeeklyReport('.$row2['ID'].','.$name.','.$week.')"  data-toggle="modal" data-target="#modal-weekly">
                                    <i class="nav-icon fas fa-eye"></i></a>
                                </td>
                                <td >'.$row2['nick_name'].'</td>
                                <td>'.$office['code'].'</td>
                                <td>'.$projectsCount.'</td>
                                <td>'.$hours.'</td>
                                <td style="background-color: '.$cp.'">'.(40-((int)$hours+$total)).'</td>
                                <td>'.(((int)$hours/40)*100).'% </td>
                                <td>'.((((int)$hours+$total)/40)*100).'% </td>
                                <td class="week" id="VACATION_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l1.'</td>
                                <td class="week" id="GENERAL_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l2.'</td>
                                <td class="week" id="MARKETING_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l3.'</td>
                                <td class="week" id="TRAINING_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l4.'</td>
                                <td class="week" id="OFFICE_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l5.'</td>
                                <td>'.$publicHlidy.'</td>
                                <td class="week" id="MEDICAL_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l6.'</td>
                                <td>'.$anualHolidy.'</td>
                                <td class="week" id="REMARKS_'.$_SESSION['weekly-resource'].'" onclick="NewRemakrs('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-remark">'.$remarks.'</td>
                                    ';
                                
                                echo '</tr>';
                    
                
                                $i++;
                    }
                }
                mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>