<?php 
$name="";
$nick="";
$office="";
$role="";
$type=0;
if($_GET['id']>0)
{
    include '../Inc/DBcon.php';
	$sql="select * from staff where ID='".$_GET['id']."'";
	$result=mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
    $name=$row['name'];
    $nick=$row['nick_name'];
    $office=$row['office'];
    $role=$row['role_id'];
    $type=$row['ID'];
    mysqli_close($conn);
}
?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Enter Full Name</label>
            <input type="text" class="form-control" id="fname" placeholder="Enter Name" value="<?= $name; ?>" >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Enter Nick Name</label>
            <input type="text" class="form-control" id="nname" placeholder="Enter Name" value="<?= $name; ?>" >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Office</label>
            <select class="form-control  select2" id="foffice" style="width: 100%;">
                    <option value="">Select Office</option>
                        <?php
                            include '../Inc/DBcon.php';
                            $sql2="select * from office where status='1'";
                            $result=mysqli_query($conn,$sql2);
                            if(mysqli_num_rows($result) > 0 )
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                            if($office==$row['ID'])
                                            {
                                                echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                            } 
                                }
                            }
                            mysqli_close($conn);
                        ?>

            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Role</label>
            <select class="form-control  select2" id="frole" style="width: 100%;">
                    <option value="">Select Role</option>
                        <?php
                            
                            include '../Inc/DBcon.php';
                            $sql2="select * from role where status='1'";
                            $result=mysqli_query($conn,$sql2);
                            if(mysqli_num_rows($result) > 0 )
                            {
                                while($row = mysqli_fetch_array($result))
                                {
                                            if($role==$row['ID'])
                                            {
                                                echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                            } 
                                }
                            }
                            mysqli_close($conn);
                        ?>

            </select>
        </div>
    </div>
    <input type="hidden" id="ftype" value="<?= $type; ?>">
</div>
<div class="row border-top">
<?php
    if($type>0)
    {
        include 'functions.php';
    
    ?>
        <div class="col-md-9">
            <div class="form-group">
                <label>Role</label>
                <select class="form-control  select2" id="skill" style="width: 100%;">
                        <option value="">Select Skill</option>
                            <?php
                                include '../Inc/DBcon.php';
                                $sql2="select * from skill where status='1'";
                                $result=mysqli_query($conn,$sql2);
                                if(mysqli_num_rows($result) > 0 )
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';     
                                    }
                                }
                                mysqli_close($conn);
                            ?>

                </select>
            </div>       
        </div>
        <div class="col-md-3" >
            <button class="btn btn-primary btn-block" style="margin-top: 32px;" onclick="AddSkill(<?=$type;?>)">Add</button>
        </div>
        <div class="col-md-12 border p-2" >
            <h4 id="skills-list">
                <?php
                    include '../Inc/DBcon.php';
                    $sql2="select * from staff_skill where staff_id='".$type."'";
                    $result=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result) > 0 )
                    {
                        while($row = mysqli_fetch_array($result))
                        {       
                            $skil=getSkill($row['skill_id']);
                            echo '<span class="badge badge-info fs-1">'.$skil['name'].' &nbsp; 
                                    <a href="javascript:void(0)" onclick="DeleteSkill('.$row['ID'].')">
                                            <i class="nav-icon fas fa-trash text-white"></i>
                                    </a>
                                 </span>&nbsp;';    
                        }
                    }
                    mysqli_close($conn);
                ?>
            </h4>
        </div>
        <div class="col-md-9">
            <div class="form-group">
                <label>Job Title</label>
                <select class="form-control  select2" id="job" style="width: 100%;">
                        <option value="">Select Job</option>
                            <?php
                                include '../Inc/DBcon.php';
                                $sql2="select * from job where status='1'";
                                $result=mysqli_query($conn,$sql2);
                                if(mysqli_num_rows($result) > 0 )
                                {
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';     
                                    }
                                }
                                mysqli_close($conn);
                            ?>

                </select>
            </div>       
        </div>
        <div class="col-md-3" >
            <button class="btn btn-primary btn-block" style="margin-top: 32px;" onclick="AddJob(<?=$type;?>)">Add</button>
        </div>
         
        <div class="col-md-12 border p-2" >
            <h4 id="jobs-list">
                <?php
                    include '../Inc/DBcon.php';
                    $sql2="select * from staff_job where staff_id='".$type."'";
                    $result=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result) > 0 )
                    {
                        while($row = mysqli_fetch_array($result))
                        {       
                            $job=getJob($row['job_id']);
                            echo '<span class="badge badge-info fs-1">'.$job['name'].' &nbsp; 
                                    <a href="javascript:void(0)" onclick="DeleteJobs('.$row['ID'].')">
                                            <i class="nav-icon fas fa-trash text-white"></i>
                                    </a>
                                 </span>&nbsp;';    
                        }
                    }
                    mysqli_close($conn);
                ?>
            </h4>
        </div>
 <?php 
    }
 ?>
</div>