<?php 
$hours="";

$type=0;
if($_GET['id']>0)
{
    include '../Inc/DBcon.php';
	$sql="select * from projects where ID='".$_GET['id']."'";
	$result=mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
    $hours=$row['minus_hours'];
    $type=$row['ID'];
    mysqli_close($conn);
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Enter Hours to Minus</label>
            <input type="number" class="form-control" id="mhours" placeholder="Enter Hours" value="<?= $hours; ?>" >
        </div>

        <input type="hidden" id="mtype" value="<?= $type; ?>">
    </div>
</div>