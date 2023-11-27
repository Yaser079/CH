<?php
session_start();
include 'functions.php';
include '../Inc/DBcon.php';
$filter="";
if(isset($_SESSION['Doffice']) && $_SESSION['Doffice']!='all')
{
    $filter=" Where ID='".$_SESSION['Doffice']."' ";
}
$sql2="select * from office ".$filter." ;";
$result2=mysqli_query($conn,$sql2);
$days=$_GET['days'];
$time="";
$Officeholidays=0;
$weekHours=0;
$totalManHours=0;
$i=0;
$Uti=0;
if(mysqli_num_rows($result2) > 0 )
{
    while($row2 = mysqli_fetch_array($result2))
    {
        $staffCount=getResources("office='".$row2['ID']."'");
        
        $Officeholidays=0;
        $weekHours=0;
        $totalManHours=0;
        if($days==7)
        {
            $time = date('d-M',strtotime('monday this week'));
            $Officeholidays=getWeekOfficeHoliday($row2['ID'],$time);
            $weekHours=getProjectWeekHoursOfStaffOfficeOfWeek($time,$row2['ID']);
            $ActualManHours= $staffCount*40;
        }
        else if($days==30)
        {
            $time = date('M');
            $Officeholidays=getMonthOfficeHoliday($row2['ID'],$time);
            $weekHours=getProjectWeekHoursOfStaffOfficeOfMonth($time,$row2['ID']);
            $ActualManHours= $staffCount*160;
        }
        else{
            $time = date('M', strtotime('-1 month'));
            $Officeholidays+=getMonthOfficeHoliday($row2['ID'],$time);
            $weekHours+=getProjectWeekHoursOfStaffOfficeOfMonth($time,$row2['ID']);
            $time = date('M', strtotime('-2 month'));
            $Officeholidays+=getMonthOfficeHoliday($row2['ID'],$time);
            $weekHours+=getProjectWeekHoursOfStaffOfficeOfMonth($time,$row2['ID']);
            $time = date('M', strtotime('-3 month'));
            $Officeholidays+=getMonthOfficeHoliday($row2['ID'],$time);
            $weekHours+=getProjectWeekHoursOfStaffOfficeOfMonth($time,$row2['ID']);
            $ActualManHours= $staffCount*480;
        }
        $totalManHours=$Officeholidays+$weekHours;
       // echo 'total Man Hours: '.$totalManHours," ==== Actual Man hours : ".$ActualManHours."<br>";
        if($totalManHours==0 || $ActualManHours==0)
        {
         //   echo "0% for Office : ".$row2['name']."<br><br>";
            $Uti+=0;
        }
        else{
            $utiliz=$totalManHours/$ActualManHours*100;
         //   echo number_format($utiliz,0)."% for Office : ".$row2['name']."<br><br>";
            $Uti+=number_format($utiliz,0);
        }
        $i++;
    }
}
echo number_format($Uti/$i,0);
mysqli_close($conn);
?>