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
?>