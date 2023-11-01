<?php 
$name="";
$tag="";
$color="";
$type=0;
if($_GET['id']>0)
{
    include '../Inc/DBcon.php';
	$sql="select * from country where ID='".$_GET['id']."'";
	$result=mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
    $name=$row['name'];
    $tag=$row['tag'];
    $color=$row['color'];
    $type=$row['ID'];
    mysqli_close($conn);
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Enter Country Name</label>
            <input type="text" class="form-control" id="cname" placeholder="Enter Name" value="<?= $name; ?>" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Enter Country Tag</label>
            <input type="text" class="form-control" id="ctag" placeholder="Enter Tag" value="<?= $tag; ?>"  >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Select Country Color</label>
            <input type="color" class="form-control" id="ccolor" placeholder="Enter Tag"  value="<?= $color; ?>" >
        </div>
        <input type="hidden" id="ctype" value="<?= $type; ?>">
    </div>
</div>