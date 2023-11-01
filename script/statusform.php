<?php 
$name="";
$color="";
$type=0;
if($_GET['id']>0)
{
    include '../Inc/DBcon.php';
	$sql="select * from project_status where ID='".$_GET['id']."'";
	$result=mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
    $name=$row['name'];
    $color=$row['color'];
    $type=$row['ID'];
    mysqli_close($conn);
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Enter Status Name</label>
            <input type="text" class="form-control" id="sname" placeholder="Enter Name" value="<?= $name; ?>" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Select Status Color</label>
            <input type="color" class="form-control" id="scolor" placeholder="Enter Color"  value="<?= $color; ?>" >
        </div>
        <input type="hidden" id="stype" value="<?= $type; ?>">
    </div>
</div>