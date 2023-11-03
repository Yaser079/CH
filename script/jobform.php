<?php 
$name="";

$type=0;
if($_GET['id']>0)
{
    include '../Inc/DBcon.php';
	$sql="select * from job where ID='".$_GET['id']."'";
	$result=mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
    $name=$row['name'];
    $type=$row['ID'];
    mysqli_close($conn);
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Enter Job Title</label>
            <input type="text" class="form-control" id="job" placeholder="Enter Name" value="<?= $name; ?>" >
        </div>

        <input type="hidden" id="jtype" value="<?= $type; ?>">
    </div>
</div>