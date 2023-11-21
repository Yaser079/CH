
<?php 
 include '../Inc/DBcon.php';
 include 'functions.php';
 $project=getProject($_GET['id']);
?>
<div class="row">
    <div class="col-md-12 col-sm-6">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Project Edit</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Stage Edit</a>
                </li>
            </ul>
            </div>
            <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Project Code</label>
                                <input type="text" class="form-control" id="code1" placeholder="Enter Project Code" value="<?= $project['code'];?>" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Project Name</label>
                                <input type="text" class="form-control" id="name1" placeholder="Enter Project Name"  value="<?= $project['name'];?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Project Manager</label>
                                <select class="form-control select2" id="manager1" style="width: 100%;" >
                                    <?php
                                           include '../Inc/DBcon.php';
                                            $sql2="select * from staff";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if($project['manager_id']==$row['ID'])
                                                    {
                                                        echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'</option>';
                                                    }
                                                    else{
                                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                                    }
                                                    
                                                }
                                            }
                                            mysqli_close($conn);
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Project Country</label>
                                <select class="form-control select2" id="country1" style="width: 100%;" >
                                    <?php
                                            include '../Inc/DBcon.php';
                                            $sql2="select * from country";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if($project['country_id']==$row['ID'])
                                                    {
                                                        echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'</option>';
                                                    }
                                                    else{
                                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                                    }
                                                    
                                                }
                                            }
                                            mysqli_close($conn);
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> % Profit</label>
                                <input type="number" class="form-control" id="profit1" placeholder="Enter %Profit" value="<?= $project['profit'];?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> AVG Rate</label>
                                <input type="number" class="form-control" id="rate1" placeholder="Enter AVG Rate" value="<?= $project['avg_rate'];?>">
                                <input type="hidden" class="form-control" id="id"  value="<?= $project['ID'];?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Project Stage</label>
                                <select class="form-control select2" id="stage1" style="width: 100%;" >
                                    <?php
                                           include '../Inc/DBcon.php';
                                            $sql2="select * from project_phase";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if($project['stage']==$row['ID'])
                                                    {
                                                        echo '<option value="'.$row['ID'].'" selected>'.$row['short_name'].'</option>';
                                                    }
                                                    else{
                                                        echo '<option value="'.$row['ID'].'">'.$row['short_name'].'</option>';
                                                    }
                                                }
                                            }
                                            mysqli_close($conn);
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Project Status</label>
                                <select class="form-control select2" id="status1" style="width: 100%;" >
                                    <?php
                                            include '../Inc/DBcon.php';
                                            $sql2="select * from project_status";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if($project['status']==$row['ID'])
                                                    {
                                                        echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'</option>';
                                                    }
                                                    else{
                                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                                    }
                                                    
                                                }
                                            }
                                            mysqli_close($conn);
                                        ?> 
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Office</label>
                                <select class="form-control select2" id="office1" style="width: 100%;" >
                                    <?php
                                           include '../Inc/DBcon.php';
                                            $sql2="select * from office";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if($project['office_id']==$row['ID'])
                                                    {
                                                        echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'</option>';
                                                    }
                                                    else{
                                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                                    }
                                                     
                                                }
                                            }
                                            mysqli_close($conn);
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Deadline</label>
                            <select class="form-control select2" id="deadline2" style="width: 100%;" >
                            <option>Select Deadline</option>
                                <?php
                                        $weeks=getWeeks(date('Y'));
                                        foreach($weeks as $week)
                                        {   if($project['deadline']==$week)
                                            {
                                                echo '<option value="'.$week.'" selected>'.$week.'</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="'.$week.'" >'.$week.'</option>';
                                            }
                                         
                                        }
                                        
                                    ?>
                            </select>
                        </div>
                    </div>
                    </div>
                    <button type="button" class="btn btn-primary float-right" onclick="UpdateProject()">Update Project</button>
                </div>
                <div class="tab-pane fade p-0" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                    <div class="row">
                        <?php
                            include '../Inc/DBcon.php';
                            $sql2="select * from project_phase";
                            $result=mysqli_query($conn,$sql2);
                            if(mysqli_num_rows($result) > 0 )
                            {
                                
                                while($row = mysqli_fetch_array($result))
                                {
                                    
                                    $phase = getPhase($project["ID"],$row['ID']);
                                    $budget='';
                                    $hours='';
                                    if($phase!=0)
                                    {
                                        $budget=$phase['budget'];
                                        $hours=$phase['hours'];
                                    }
                                     
                                    echo '<div class="col-md-3">
                                    <div class="card">
                                        <div class="card-header" style="background-color:'.$row['color'].'">
                                            <h3 class="card-title font-weight-bold" id="'.$row['ID'].'title">'.$row['short_name'].'</h3>
                                        </div>
                                        <div class="card-body p-2">
                                            <label>Budget</label>
                                            <input type="number" id="'.$row['ID'].'budget" class="form-control form-control-sm" value="'.$budget.'" placeholder="0.00" onkeyup="calcHours('.$row['ID'].')">
                                            <label>Hours</label>
                                            <input type="number" id="'.$row['ID'].'hours" class="form-control form-control-sm" value="'.$hours.'" placeholder="0" readonly><br>
                                            <button class="btn btn-secondary btn-block btn-sm" onclick="UpdateStage('.$row['ID'].','.$project['ID'].')">Update</button>
                                        </div>
                                    </div>
                                </div>';
                                    
                                }
                            }
                            mysqli_close($conn);
                        ?>
                    
                         
                        
                    </div>
                </div>
                 
            </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
  
</div>
 
