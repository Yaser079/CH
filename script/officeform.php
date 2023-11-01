<?php 
$name="";
$code="";
$raate="";
$type=0;
if($_GET['id']>0)
{
    include '../Inc/DBcon.php';
	$sql="select * from office where ID='".$_GET['id']."'";
	$result=mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
    $name=$row['name'];
    $code=$row['code'];
    $rate=$row['hour_rate'];
    $type=$row['ID'];
    mysqli_close($conn);
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Enter Office Name</label>
            <input type="text" class="form-control" id="oname" placeholder="Enter Name" value="<?= $name; ?>" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Enter Office Code</label>
            <input type="text" class="form-control" id="ocode" placeholder="Enter Code" value="<?= $code; ?>"  >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Select Hour Rate</label>
            <input type="number" class="form-control" id="orate" placeholder="Enter Hour Raate"  value="<?= $rate; ?>" >
        </div>
        <input type="hidden" id="otype" value="<?= $type; ?>">
    </div>
</div>