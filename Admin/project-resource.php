<?php session_start(); include '../script/islogin.php';  $_SESSION['nav']='project-resource';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Project Resourcing</title>
  <?php include '../Inc/head.php';?>
 

</head>
<body class="hold-transition sidebar-mini pace-white accent-primary">
<!-- Site wrapper -->
<div class="wrapper">
  
  <!-- /.navbar -->
  <?php include '../Inc/top-nav.php';?>
  <!-- Main Sidebar Container -->
  <?php include '../Inc/side-bar.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="text-dark">Project Resourcing</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Project Resourcing</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  
    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title ">Filters</h3>
                </div>
                <div class="card-body">
                <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                            <label>Office</label>
                            <select class="form-control form-control-sm select2" id="roffice" style="width: 100%;" onchange="SetRFilter(this.id,this.value)">
                                    <option value="all">All</option>
                                    <?php
                                            include '../Inc/DBcon.php';
                                            $sql2="select * from office where status='1'";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if(isset($_SESSION['foffice']))
                                                    {
                                                            if($_SESSION['foffice']==$row['ID'])
                                                            {
                                                                echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'</option>';
                                                            }
                                                            else
                                                            {
                                                                echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                                            }
                                                    }else
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
                        <div class="col-md-2">
                            <div class="form-group">
                            <label>Project Region</label>
                            <select class="form-control form-control-sm select2" id="rregion" style="width: 100%;" onchange="SetRFilter(this.id,this.value)">
                                    <option value="all">All</option>
                                    <?php
                                            include '../Inc/DBcon.php';
                                            $sql2="select * from country where status='1'";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if(isset($_SESSION['fregion']))
                                                    {
                                                            if($_SESSION['fregion']==$row['ID'])
                                                            {
                                                                echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'-'.$row['tag'].'</option>';
                                                            }
                                                            else
                                                            {
                                                                echo '<option value="'.$row['ID'].'">'.$row['name'].'-'.$row['tag'].'</option>';
                                                            }
                                                    }else
                                                    {
                                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'-'.$row['tag'].'</option>';
                                                    }
                                                    
                                                }
                                            }
                                            mysqli_close($conn);
                                        ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <label>Project Manager</label>
                            <select class="form-control form-control-sm select2" id="rmanager" style="width: 100%;" >
                                    <option value="all">All</option>
                            </select>
                            </div>
                        </div>
                        
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm btn-block " style="margin-top: 31px;" onclick="ClearRFilter()"><i class="fa fa-trash" ></i> Clear</button>
                        </div>
                    </div>
                </div>

        </div>
        <div id="resourcing-list">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Project Resourcing for All Weeks</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <div class="table-responsive">
                <table id="example1" class="table table-bordered table-hover text-center">
                    <thead>
                    <tr>
                    <th> </th>
                    <th>Action</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th class="rotated">Country</th>
                    <th class="rotated">Remaining<br>Hours</th>
                    <th class="rotated">Budget<br>Hours</th>
                    <th class="rotated">Resource</th>
                    <?php 
                    include '../script/functions.php';
                    $weeks=getWeeks(date('Y'));
                        foreach($weeks as $week)
                        {
                            echo '<th class="rotated"> '.$week.' </th>';
                        }
                    ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        include '../Inc/DBcon.php';
                        
                        $sql2="select * from projects";
                        $result=mysqli_query($conn,$sql2);
                        if(mysqli_num_rows($result) > 0 )
                        {
                            $i=1;
                            while($row = mysqli_fetch_array($result))
                            {
                                $country=getCountry($row['country_id']);
                                $resource=countResource($row['ID']);
                                $hours=gethours($row['ID']);
                                $res=$resource>0?'rowspan="'.($resource+1).'':'';
                                $res2=$resource>0?'<td></td>':'';
                                $budgthour=getbudgetHours($row['ID']);
                                echo '<tr>
                                            <td   style="vertical-align: middle;" class="bg-green"> </td>
                                            <td  class="bg-green">
                                                <a href="javascript:void(0)" onclick="ResourceForm('.$row['ID'].')"  data-toggle="modal" data-target="#modal-new-resource"> <i class="nav-icon fas fa-edit text-white"></i></a> &nbsp;
                                            </td>
                                            <td class="bg-green">'.$row['code'].'</td>
                                            <td class="bg-green">'.$row['name'].'</td>
                                            <td class="bg-green">'.$country['tag'].'</td>
                                            <td class="bg-green">'.($hours-$budgthour).' </td>
                                            <td class="bg-green">'.$budgthour.'</td>
                                            <td class="font-weight-bold" class="bg-green"> '.$resource.' </td>
                                            ';
                                                $weeks=getWeeks(date('Y'));
                                                foreach($weeks as $week)
                                                {   
                                                   
                                                    if(getResourceStageWeek($row['ID'],$week)!="")
                                                    {
                                                        $stage=getResourceStageWeek($row['ID'],$week);
                                                        $stageN=getStage($stage);
                                                        echo '<td class="stage" id="'.$row['ID'].'_'.$week.'" onclick="StageForm(this.id)" data-toggle="modal" data-target="#stage-model" style="background-color:'.$stageN['color'].'">'.$stageN['short_name'].'</td>';

                                                    }
                                                    else
                                                    {
                                                        echo '<td class="stage" id="'.$row['ID'].'_'.$week.'" onclick="StageForm(this.id)" data-toggle="modal" data-target="#stage-model"></td>';

                                                    }
                                                }
                                            echo'</tr>';
                                
                                            $sql2="select * from project_resource where pid='".$row['ID']."';";
                                            $result2=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result2) > 0 )
                                            {
                                                
                                                while($row2 = mysqli_fetch_array($result2))
                                                {
                                                    $res=getManager($row2['staff_id']);
                                                    echo '<tr>
                                                    <td ></td>
                                                    <td ></td>
                                                    <td >'.$row['code'].' </td>
                                                    <td ><small>Resource</small> </td>
                                                    
                                                    <td > </td>
                                                    <td > </td>
                                                    <td > </td>
                                                    <td > '.$res['nick_name'].' </td>';
                                                    $weeks=getWeeks(date('Y'));
                                                    foreach($weeks as $week)
                                                    {
                                                        $wheekHours=getResourceWeek($row['ID'],$res['ID'],$week);
                                                        echo '<td class="week font-weight-bold" id="'.$row['ID'].'_'.$res['ID'].'_'.$week.'" onclick="ShowM(this.id,'.$res['ID'].','.$row['ID'].')" data-toggle="modal" data-target="#hors-model">'.$wheekHours.'</td>';
                                                    }
                                                    echo'</tr>';
                                                }
                                                
                                            }
                                            
                                ;
                                $i++;
                            }
                        }
                        mysqli_close($conn);
                    
                    
                    
                
                    ?>
                    
                
                    </tbody>
                </table>
                </div>
                </div>
                
                <!-- /.card-body -->
            </div> 
        </div>
        
       

    </section>
    <!-- /.content -->
   
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade show" id="modal-new-resource">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Manage Project Resource</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="resource-form">
               
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="add-project-close" data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    <div class="modal fade" id="hors-model">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Enter Hours</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
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
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="close-hours" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="UpdateHourse()">Update</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
      <!-- /.modal -->
      <div class="modal fade" id="stage-model">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">project Stage</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="stage-form">
                
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="close-stage" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="UpdateStage()">Update</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
      <!-- /.modal -->                     
  <?php include '../Inc/footer.php';?>
  <script src="../Inc/project-resource.js"></script>
 
</body>
</html>
