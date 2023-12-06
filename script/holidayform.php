<?php 
$desc="";
$hours="";
$type=0;
    include '../Inc/DBcon.php';
	$sql="select * from office_holidays where office_id='".$_GET['id']."' AND week='".$_GET['week']."'";
	$result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);
        $desc=$row['description'];
        $hours=$row['hours'];
        $type=$row['ID'];
    }
	
    mysqli_close($conn);
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <label for="exampleInputEmail1">Exact Dates</label>
            <input type="text" class="form-control" id="des" placeholder="Exact Dates" value="<?= $desc;?>" >
            <label for="exampleInputEmail1">Enter Hours</label>
            <input type="number" class="form-control" id="hours" placeholder="Enter hours" value="<?= $hours;?>" >
            <input type="hidden" id="office" value="<?= $_GET['id'];?>">
            <input type="hidden" id="week" value="<?= $_GET['week'];?>">
            <input type="hidden" id="type" value="<?= $type;?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php
        if($type>0)
            {
                echo '<div class="col-md-12">
                <a href="javascript:void(0)" onclick="ClearHoliday('.$type.')">Remove Holiday <i class="nav-icon fas fa-trash text-danger"></i></a>
            </div>';
            }
    ?>
    </div>
</div>
