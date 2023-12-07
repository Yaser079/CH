<?php session_start();?>
<div class="table-responsive">
    <table id="example1"  class="table table-bordered text-center staff-holiday">
        <thead>
        <tr>
            <th>ID</th>
            <th  >Name</th>
            <th class="rotated"><div class="rotated" > Office </div></th>
            <th class="rotated"><div class="rotated" > Total </div></th>
            <?php 
                include 'functions.php';
                $weeks=getWeeks(date('Y'));
                    foreach($weeks as $week)
                    {
                        echo '<th  data-orderable="false"><div class="rotated" > '.$week.' </div></th>';
                    }
                ?>
        </tr>
        </thead>
        <tbody>
        <?php
            include '../Inc/DBcon.php';
            
            $sql2="select * from staff order by CASE WHEN uid = '".$_SESSION['uid']."' THEN 0 ELSE 1 END, office asc;";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                $i=1;
                while($row = mysqli_fetch_array($result))
                {
                    $hours=getTotalStaffHoliday($row['ID']);
                    $office=getOffice($row['office']);
                    echo '<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['nick_name'].'</td>
                    <td>'.$office['code'].'</td>
                    <td class="font-weight-bold"> '.$hours.'</td>';
                    $weeks=getWeeks(date('Y'));
                    foreach($weeks as $week)
                    {
                        
                        if($_SESSION['role']==1)
                        {
                            $Holiday= getStaffHoliday($row['ID'],$week);
                            if($Holiday)
                            {
                              echo '<td class="week font-weight-bold" id="'.$row['ID'].'_'.$week.'" onclick="HolidayForm(this.id)" data-toggle="modal" data-target="#holiday-model" data-tooltip="tooltip"  title="'.$Holiday['description'].'">'.$Holiday['hours'].'</td>';
                            }
                            else
                            {
                              echo '<td class="week font-weight-bold" id="'.$row['ID'].'_'.$week.'" onclick="HolidayForm(this.id)" data-toggle="modal" data-target="#holiday-model" >  </td>';

                            }
                        }
                        else
                        {
                            $Holiday= getStaffHoliday($row['ID'],$week);
                            $inp=$inp2="";
                            $inp=$_SESSION['uid']==$row['uid']? 'week':'';
                            if($Holiday)
                            {
                              $inp2=$_SESSION['uid']==$row['uid']? 'onclick="HolidayForm(this.id)" data-toggle="modal" data-target="#holiday-model" data-tooltip="tooltip"  title="'.$Holiday['description'].'"':'';

                              echo '<td class="'.$inp.' font-weight-bold" id="'.$row['ID'].'_'.$week.'"  '.$inp2.' >'.$Holiday['hours'].'</td>';
                            }
                            else
                            {
                              $inp2=$_SESSION['uid']==$row['uid']? 'onclick="HolidayForm(this.id)" data-toggle="modal" data-target="#holiday-model"':'';
                              echo '<td class="'.$inp.' font-weight-bold" id="'.$row['ID'].'_'.$week.'"  '.$inp2.' >  </td>';

                            }
                        }
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