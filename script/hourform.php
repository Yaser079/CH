<?php 
$name="";

$type=0;
if($_GET['id']>0)
{
    include '../Inc/DBcon.php';
	$sql="select * from resource_weeks where pid='".$_GET['id']."' AND week='".$_GET['week']."' AND staff_id='".$_GET['staff']."';";
	$result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0 )
    {
        $row = mysqli_fetch_array($result);
        $type=$row['ID'];
    }
	
    mysqli_close($conn);
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Enter Hours</label>
            <input type="number" class="form-control" id="hours" placeholder="Enter hours" >
            <input type="hidden" id="project" value="">
            <input type="hidden" id="staff" value="">
            <input type="hidden" id="week" value="">

        </div>
    </div>
</div>
<?php 
if($type>0)
{
    echo '<div class="col-md-12">
    <a href="javascript:void(0)" onclick="ClearHour('.$type.')">Remove Hour <i class="nav-icon fas fa-trash text-danger"></i></a>
</div>';
}
?>
