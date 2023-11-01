<?php 
$name="";
$tag="";
$color="";
$type=0;
if($_GET['id']>0)
{
    include '../Inc/DBcon.php';
	$sql="select * from project_phase where ID='".$_GET['id']."'";
	$result=mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
    $name=$row['short_name'];
    $color=$row['color'];
    $type=$row['ID'];
    mysqli_close($conn);
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Enter Phase Name</label>
            <input type="text" class="form-control" id="pname" placeholder="Enter Name" value="<?= $name; ?>" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Select Country Color</label>
            <input type="color" class="form-control" id="pcolor" placeholder="Enter Color"  value="<?= $color; ?>" >
        </div>
        <input type="hidden" id="ptype" value="<?= $type; ?>">
    </div>
</div>