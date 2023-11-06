<?php
$Months = array("January", "February", "March","April","May","June","July","August","September","October","November","December");
///Staff Functions
function getManager($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from staff where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}

function countResource($pid)
{
    include '../Inc/DBcon.php';
    $sql2="select * from project_resource where pid='".$pid."' ;";
    $result2=mysqli_query($conn,$sql2);
    return mysqli_num_rows($result2);
    mysqli_close($conn);
}
function getduplicateResource($pid,$sid)
{
    include '../Inc/DBcon.php';
    $sql2="select * from project_resource where pid='".$pid."' AND staff_id='".$sid."' ;";
    $result2=mysqli_query($conn,$sql2);
    return mysqli_num_rows($result2);
    mysqli_close($conn);
}

/// Country Functions
function getCountry($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from country where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
/// Office Functions
function getOffice($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from office where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}

/// phase details

function gethours($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select SUM(hours) AS hours FROM phase_details where project_id='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return 0;
    }
    mysqli_close($conn);
}
function getPhase($pid,$phase_id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from phase_details where project_id='".$pid."' AND phase_id='".$phase_id."'";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    }
    else
    {
        return 0;
    }
    mysqli_close($conn);
}
function getStage($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from project_phase where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
/// project details
function getProject($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from projects where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
///Role
function getRole($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from role where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
///Job
function getJob($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from job where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
///Skill
function getSkill($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from skill where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
/// project Status
function getStatus($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from project_status where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}


function getWeeksNumbers($month, $year){
    $num_of_days = date("t", mktime(0,0,0,$month,1,$year)); 
    $lastday = date("t", mktime(0, 0, 0, $month, 1, $year)); 
    $no_of_weeks = 0; 
    $count_weeks = 0; 
    while($no_of_weeks < $lastday){ 
        $no_of_weeks += 7; 
        $count_weeks++; 
    } 
return $count_weeks;
} 

function getWeeks($year)
{
    $weeks=array();

$d=date("d-M", strtotime("first Monday of ".$year."-01"));
  for($i=1; $i<=12;$i++)
  {
      $number = cal_days_in_month(CAL_GREGORIAN, $i, 2023);
      $j=1;
      for($j=1; $j<=$number;$j++)
          {
              $timestamp = strtotime($d);
              $a=date("D", $timestamp);
          if($a=="Mon" )
          {
           array_push($weeks,$d);

           }
            $d=date("d-M",strtotime("+1 day", strtotime($d)));

       }
  }
  return $weeks;
}

/// project Rescourcing weeks
function getResourceWeek($pid,$staff_id,$week)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from resource_weeks where pid='".$pid."' AND staff_id='".$staff_id."' AND week='".$week."' ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getbudgetHours($pid)
{ 
    include '../Inc/DBcon.php';
    $sql2="select SUM(hours) AS hours from resource_weeks where pid='".$pid."' ; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getStaffHours($pid,$sid)
{ 
    include '../Inc/DBcon.php';
    $sql2="select SUM(hours) AS hours from resource_weeks where pid='".$pid."' AND staff_id='".$sid."' ; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getStaffProjectsCount($sid)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from resource_weeks where staff_id='".$sid."' AND hours>'0' group by pid ; ";
    $result2=mysqli_query($conn,$sql2);
    return mysqli_num_rows($result2);
    mysqli_close($conn);
}
/// get project resource date
function getResourceStageWeek($pid,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from resource_stage where pid='".$pid."'  AND week='".$week."' ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['stage_id'];
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getWeekStage($pid,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from resource_stage where pid='".$pid."'  AND week='".$week."' ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getWeekFullStage($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from resource_stage where ID='".$id."' ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getOfficeStaff($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from staff where office='".$id."' ";
    $result2=mysqli_query($conn,$sql2);
    return mysqli_num_rows($result2);
    mysqli_close($conn);
}
function getStaffSkills($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from staff_skill where ID='".$id."'; ";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
function getCountSkillStaff($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from staff_skill where skill_id='".$id."'; ";
    $result2=mysqli_query($conn,$sql2);
    return mysqli_num_rows($result2);
    mysqli_close($conn);
}
function getStaffJob($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from staff_job where ID='".$id."'; ";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
function getOfficeHoliday($office,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from office_holidays where office_id='".$office."'  AND week='".$week."' ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getTotalOfficeHoliday($office)
{
    include '../Inc/DBcon.php';
    $sql2="select SUM(hours) AS hours from office_holidays where office_id='".$office."' ; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getOfficeHolidays($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from office_holidays where ID='".$id."' ";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    
    mysqli_close($conn);
}
function getStaffHoliday($staff,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from staff_holiday where staff_id='".$staff."'  AND week='".$week."' ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getTotalStaffHoliday($staff)
{
    include '../Inc/DBcon.php';
    $sql2="select SUM(hours) AS hours from staff_holiday where staff_id='".$staff."' ; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return '';
    }
    mysqli_close($conn);
}
function getStaffWeeklyHoliday($staff,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from staff_holiday where staff_id='".$staff."' AND week='".$week."' ; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getOfficeWeeklyHoliday($office,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from office_holidays where office_id='".$office."' AND week='".$week."' ; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getStaffWeeklyWork($staff,$week)
{
    include '../Inc/DBcon.php';
    $sql2="select * from resource_weeks where staff_id='".$staff."' AND week='".$week."' and hours>'0' ; ";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return '0';
    }
    mysqli_close($conn);
}
function getProjectResource($id)
{
    include '../Inc/DBcon.php';
    $sql2="select * from resource_weeks where ID='".$id."' ; ";
    $result2=mysqli_query($conn,$sql2);
    
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    mysqli_close($conn);
}
?>