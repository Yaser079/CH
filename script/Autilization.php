<?php
session_start();
include 'functions.php';
$days=$_GET['days'];
$time="";
$array= array();
$array2= array();
?>
<div class="tab-pane fade show active p-0 " id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab" style="height:150px ;overflow-y: auto; overflow-y:hidden;">
                  <?php
                        include '../Inc/DBcon.php';
                        
                        $sql2="select * from staff  where office='4';";
                        $result=mysqli_query($conn,$sql2);
                        if(mysqli_num_rows($result) > 0 )
                        {
                          
                           
                            while($row2 = mysqli_fetch_array($result))
                            {
                                if($days==7)
                                {
                                    $time = date('d-M',strtotime('monday this week'));
                                    $hours= getCurrentWeekHoursOfStaff($row2['ID'], $time);
                                    $publicHlidy=getOfficeWeeklyHoliday($row2['office'], $time);
                                    $anualHolidy=getStaffWeeklyHoliday($row2['ID'], $time);
                                    $otherLeaves=getCurrentWeekLeavesOfStaff($row2['ID'], $time);
                                    $l1=$l2=$l3=$l4=$l5=$l6=0;
                                    if($otherLeaves!=0)
                                    {
                                        $l1=$otherLeaves['VACATION'];
                                        $l2=$otherLeaves['GENERAL'];
                                        $l3=$otherLeaves['MARKETING'];
                                        $l4=$otherLeaves['TRAINING'];
                                        $l5=$otherLeaves['OFFICE'];
                                        $l6=$otherLeaves['MEDICAL'];
                                    }
                                    $total=$l1+$l2+$l3+$l4+$l5+$l6+$publicHlidy+$anualHolidy;
                                   if(((int)$hours+$total)<40)
                                   {
                                    $array+=[$row2['nick_name'] => (100-((((int)$hours+$total)/40)*100))];
                                   }
                                   else{
                                      $array2+=[$row2['nick_name'] => (((((int)$hours+$total)/40)*100))];
                                   }
                                    
                                }
                                else if($days==30)
                                {
                                    $time = date('M');
                                    $hours= getCurrentmonthHoursOfStaff($row2['ID'], $time);
                                    $publicHlidy=getOfficeMonthlyHoliday($row2['office'], $time);
                                    $anualHolidy=getStaffMonthlyHoliday($row2['ID'], $time);
                                    $otherLeaves=getCurrentMonthLeavesOfStaff($row2['ID'], $time);
                                    $l1=$l2=$l3=$l4=$l5=$l6=0;
                                    if($otherLeaves!=0)
                                    {
                                        $l1=$otherLeaves['VACATION'];
                                        $l2=$otherLeaves['GENERAL'];
                                        $l3=$otherLeaves['MARKETING'];
                                        $l4=$otherLeaves['TRAINING'];
                                        $l5=$otherLeaves['OFFICE'];
                                        $l6=$otherLeaves['MEDICAL'];
                                       
                                    }
                                    $total=$l1+$l2+$l3+$l4+$l5+$l6+$publicHlidy+$anualHolidy;
                                   if(((int)$hours+$total)<160)
                                   {
                                    $array+=[$row2['nick_name'] => (100-((((int)$hours+$total)/160)*100))];
                                   }
                                   else{
                                      $array2+=[$row2['nick_name'] => (((((int)$hours+$total)/160)*100))];
                                   }
                                   
                                }
                                else{
                                    $time = date('M', strtotime('-1 month'));
                                    $hours= getCurrentmonthHoursOfStaff($row2['ID'], $time);
                                    $publicHlidy=getOfficeMonthlyHoliday($row2['office'], $time);
                                    $anualHolidy=getStaffMonthlyHoliday($row2['ID'], $time);
                                    $otherLeaves=getCurrentMonthLeavesOfStaff($row2['ID'], $time);
                                    $l1=$l2=$l3=$l4=$l5=$l6=0;
                                    if($otherLeaves!=0)
                                    {
                                        $l1=$otherLeaves['VACATION'];
                                        $l2=$otherLeaves['GENERAL'];
                                        $l3=$otherLeaves['MARKETING'];
                                        $l4=$otherLeaves['TRAINING'];
                                        $l5=$otherLeaves['OFFICE'];
                                        $l6=$otherLeaves['MEDICAL'];
                                       
                                    }
                                   
                                    $time = date('M', strtotime('-2 month'));
                                    $hours=$hours+ getCurrentmonthHoursOfStaff($row2['ID'], $time);
                                    $publicHlidy=$publicHlidy+getOfficeMonthlyHoliday($row2['office'], $time);
                                    $anualHolidy=$anualHolidy+getStaffMonthlyHoliday($row2['ID'], $time);
                                    $otherLeaves=getCurrentMonthLeavesOfStaff($row2['ID'], $time);
                                    if($otherLeaves!=0)
                                    {
                                        $l1= $l1+$otherLeaves['VACATION'];
                                        $l2= $l2+$otherLeaves['GENERAL'];
                                        $l3= $l3+$otherLeaves['MARKETING'];
                                        $l4= $l4+$otherLeaves['TRAINING'];
                                        $l5= $l5+$otherLeaves['OFFICE'];
                                        $l6= $l6+$otherLeaves['MEDICAL'];
                                       
                                    }
                                    $time = date('M', strtotime('-3 month'));
                                    $hours=$hours+ getCurrentmonthHoursOfStaff($row2['ID'], $time);
                                    $publicHlidy=$publicHlidy+getOfficeMonthlyHoliday($row2['office'], $time);
                                    $anualHolidy=$anualHolidy+getStaffMonthlyHoliday($row2['ID'], $time);
                                    $otherLeaves=getCurrentMonthLeavesOfStaff($row2['ID'], $time);
                                    if($otherLeaves!=0)
                                    {
                                        $l1= $l1+$otherLeaves['VACATION'];
                                        $l2= $l2+$otherLeaves['GENERAL'];
                                        $l3= $l3+$otherLeaves['MARKETING'];
                                        $l4= $l4+$otherLeaves['TRAINING'];
                                        $l5= $l5+$otherLeaves['OFFICE'];
                                        $l6= $l6+$otherLeaves['MEDICAL'];
                                       
                                    }
                                    $total=$l1+$l2+$l3+$l4+$l5+$l6+$publicHlidy+$anualHolidy;
                                    if(((int)$hours+$total)<480)
                                    {
                                     $array+=[$row2['nick_name'] => (100-((((int)$hours+$total)/480)*100))];
                                    }
                                    else{
                                       $array2+=[$row2['nick_name'] => (((((int)$hours+$total)/480)*100))];
                                    }
                                }
                             
                            }
                            arsort($array);
                            foreach($array as $key => $val)
                            {
                              echo '<div class="d-flex justify-content-start" style="height: 20px;">
                                        <p style="width: 130px; text-align:right;margin-right:10px; padding:0px;font-size:12px">'.$key.'</p>
                                        <div class="progress-group" style="width: 100%;padding:0px">
                                          <div class="progress progress-md">
                                            <div class="progress-bar bg-success" style="width: '.$val.'% ;">'.$val.'% available</div>
                                          </div>
                                        </div>
                                    </div>';
                            }
                            
                        }
                        mysqli_close($conn);
                        ?> 
                        
                        
                </div>
                  <div class="tab-pane fade p-0 " id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab" style="height:150px ;overflow-y: auto; overflow-y:hidden;">
                  <?php
                        arsort($array2);
                            foreach($array2 as $key => $val)
                            {
                              echo '<div class="d-flex justify-content-start" style="height: 20px;">
                                        <p style="width: 130px; text-align:right;margin-right:10px; padding:0px;font-size:12px">'.$key.'</p>
                                        <div class="progress-group" style="width: 100%;padding:0px">
                                          <div class="progress progress-md">
                                            <div class="progress-bar bg-danger" style="width: '.$val.'% ;">'.$val.'% Working</div>
                                          </div>
                                        </div>
                                    </div>';
                            }
                            
                         
                        ?> 
                </div>