<?php session_start(); include '../script/islogin.php';  $_SESSION['nav']='project-list';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Project List</title>
  <?php include '../Inc/head.php';
     
  ?>
<style>
  thead
{
  position: sticky;
  top: 0;
  z-index: 2;
  background-color: white;
}
  .stiky {
  position: sticky;
 left: 0;
  z-index: 1;
  background-color: white;
 
}
 td{width: fit-content !important;}
td.stiky:nth-child(1), th.stiky:nth-child(1) {
  left: 0px  ;
}
td.stiky:nth-child(2) , th.stiky:nth-child(2){
  left: 20px;  
}
td.stiky:nth-child(3) , th.stiky:nth-child(3){
  left: 65px;  
}
td.stiky:nth-child(4) , th.stiky:nth-child(4){
  left: 115px;  
}
td.stiky:nth-child(5) , th.stiky:nth-child(5){
  left: 290px;  
}
td.stiky:nth-child(6) , th.stiky:nth-child(6){
  left: 358px;  
}
td.stiky:nth-child(7) , th.stiky:nth-child(7){
  left: 415px;  
}
td.stiky:nth-child(8) , th.stiky:nth-child(8){
  left: 440px;  
}
td.stiky:nth-child(9) , th.stiky:nth-child(9){
  left: 468px;  
}
td.stiky:nth-child(10) , th.stiky:nth-child(10){
  left: 498px;  
}
 
 
.table-responsive1 {
  width: 100%;
  overflow-x: scroll;
  max-height: 800px;
  overflow-y: auto;
}

table {
  width: 200%;
}
</style>
</head>
<body class="<?= $_SESSION['body'];?>">
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
            <h1 class="text-dark">Project List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Project List</li>
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
                        <select class="form-control form-control-sm select2" id="foffice" style="width: 100%;" onchange="SetFilter(this.id,this.value)">
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
                        <select class="form-control form-control-sm select2" id="fregion" style="width: 100%;" onchange="SetFilter(this.id,this.value)">
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
                        <select class="form-control form-control-sm select2" id="fmanager" style="width: 100%;" onchange="SetFilter(this.id,this.value)">
                                <option value="all">All</option>
                                <?php
                                        include '../Inc/DBcon.php';
                                        $sql2="select * from staff where status='1' AND role_id='1'";
                                        $result=mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result) > 0 )
                                        {
                                            
                                            while($row = mysqli_fetch_array($result))
                                            {
                                                if(isset($_SESSION['fmanager']))
                                                {
                                                        if($_SESSION['fmanager']==$row['ID'])
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
                        <label>Project Status</label>
                        <select class="form-control form-control-sm select2" id="fstatus" style="width: 100%;" onchange="SetFilter(this.id,this.value)">
                        <option value="all">All</option>
                                <?php
                                        include '../Inc/DBcon.php';
                                        $sql2="select * from project_status where status='1'";
                                        $result=mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result) > 0 )
                                        {
                                            
                                            while($row = mysqli_fetch_array($result))
                                            {
                                                if(isset($_SESSION['fstatus']))
                                                {
                                                        if($_SESSION['fstatus']==$row['ID'])
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
                        <label>Project Stage</label>
                        <select class="form-control form-control-sm select2" id="fstage" style="width: 100%;" onchange="SetFilter(this.id,this.value)">
                        <option value="all">All</option>
                        <?php
                                        include '../Inc/DBcon.php';
                                        $sql2="select * from project_phase where status='1'";
                                        $result=mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result) > 0 )
                                        {
                                            
                                            while($row = mysqli_fetch_array($result))
                                            {
                                                if(isset($_SESSION['fstage']))
                                                {
                                                        if($_SESSION['fstatus']==$row['ID'])
                                                        {
                                                            echo '<option value="'.$row['ID'].'" selected>'.$row['short_name'].'</option>';
                                                        }
                                                        else
                                                        {
                                                            echo '<option value="'.$row['ID'].'">'.$row['short_name'].'</option>';
                                                        }
                                                }else
                                                {
                                                    echo '<option value="'.$row['ID'].'">'.$row['short_name'].'</option>';
                                                }
                                                
                                            }
                                        }
                                        mysqli_close($conn);
                                    ?>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm btn-block " style="margin-top: 31px;" onclick="ClearFilter()"><i class="fa fa-trash" ></i> Clear</button>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-primary btn-sm btn-block " data-toggle="modal" data-target="#modal-lg" style="margin-top: 31px;"><i class="fa fa-plus"></i> Add</button>
                    </div>
                </div>
            </div>

        </div>
    <div id="project-list">
        <?php include '../script/functions.php'; ?>
            <div class="card secondary d-none" style="min-height:100%;">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                <h3 class="card-title d-flex align-self-center ">Projects List</h3>
                <button class="btn btn-primary mt-2 mb-2" data-toggle="modal" data-target="#modal-avg">AVG Rate Calculator</button>
                </div>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
            <div class="table-responsive">
              <table id="example1" class="table table-head-fixed table-bordered table-hover text-center" style="font-size: 14px;">
              
                <thead>
                <tr>
                  <th colspan="12"></th>
                  
                  <?php
                    include '../Inc/DBcon.php';
                    $sql2="select * from project_phase";
                    $result=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result) > 0 )
                    {
                        
                        while($row = mysqli_fetch_array($result))
                        {
                            echo ' <th  colspan="2" style="background-color:'.$row['color'].'">'.$row['short_name'].'</th>';
                             
                             
                        }
                    }
                    mysqli_close($conn);
                ?>
              </tr>
                <tr>
                  <th >ID</th>
                  <th  data-orderable="false">Action</th>
                  <th >Code</th>
                  <th class="text-left">Project Name</th>
                  <th>PM</th>
                  <th class=" ">Status</th>
                  <th class="rotated">Country</th>
                  <th class="rotated">Hours</th>
                  <th class="rotated">%Profit</th>
                  <th class="rotated">AVG Rate</th>
                  
                  <th class="rotated">Current Stage</th>
                  <th class="rotated">Deadline Week</th>
                  <?php
                    include '../Inc/DBcon.php';
                    $sql2="select * from project_phase";
                    $result=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result) > 0 )
                    {
                        
                        while($row = mysqli_fetch_array($result))
                        {
                            echo ' <th  class="rotated"  data-orderable="false"> Hours</th>';
                            echo ' <th  class="rotated"  data-orderable="false">Budget</th>';
                             
                        }
                    }
                    mysqli_close($conn);
                ?>
                </tr>
                </thead>
                <tbody>
                <?php
                    include '../Inc/DBcon.php';
                    $sql2="select * from projects";
                    $result2=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result) > 0 )
                    {
                        $i=1;
                        while($row2 = mysqli_fetch_array($result2))
                        {
                            $pm=getManager($row2['manager_id']);
                            $country=getCountry($row2['country_id']);
                            $hours=gethours($row2['ID']);
                            $status=getStatus($row2['status']);
                            $stage1=getStage($row2['stage']);
                             
                            echo'<tr style="background-color:'.$status['color'].'">
                                    <td>'.$i.'</td>
                                    <td>
                                    <a href="javascript:void(0)"   onclick="getproject('.$row2['ID'].')"  data-toggle="modal" data-target="#modal-lg-edit"> <i class="nav-icon fas fa-edit text-secondary"></i></a> &nbsp;
                                    <a href="javascript:void(0)"   onclick="deleteProject('.$row2['ID'].')"><i class="nav-icon fas fa-trash text-danger"></i> </a> 
                                    </td>
                                    <td>'.$row2['code'].'</td>
                                    <td class="text-left"><p style="width:180px !important; margin:0px">'.$row2['name'].'</p></td>
                                    <td>'.$pm['nick_name'].'</td>
                                    <td  style="font-size:10px;font-weight:bold;">'.$status['name'].'</td>
                                    <td style="background-color:'.$country['color'].'">'.$country['tag'].'</td>
                                    <td>'.$hours.'</td>
                                    <td>'.$row2['profit'].'%</td>
                                    <td  >'.$row2['avg_rate'].'</td>
                                    
                                    <td style="background-color:'.$stage1['color'].'">'.$stage1['short_name'].'</td>
                                    <td  >'.$row2['deadline'].'</td>
                                  ';
                                  $sql2="select * from project_phase";
                                    $result3=mysqli_query($conn,$sql2);
                                    if(mysqli_num_rows($result3) > 0 )
                                    {
                                        
                                        while($row3 = mysqli_fetch_array($result3))
                                        {
                                            $phase=getPhase($row2['ID'],$row3['ID']);
                                            if($phase!=0)
                                            {
                                                echo ' <td class="font-weight-bold">'.$phase['hours'].'</td>';
                                                echo ' <td class="font-weight-bold">$'.number_format($phase['budget'],2).'</td>';
                                            }
                                            else
                                            {
                                                echo ' <td class="font-weight-bold"> </td>';
                                                echo ' <td class="font-weight-bold"> </td>';
                                            }
                                            
                                            
                                        }
                                    }
                                    echo '</tr>';
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
    <div class="modal fade show" id="modal-lg">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Project</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="project-form">
                <p class="text-danger text-right">* is required field</p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Project Code</label>
                            <input type="text" class="form-control" id="code" placeholder="Enter Project Code" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Project Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Project Name" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Project Manager</label>
                            <select class="form-control select2" id="manager" style="width: 100%;" >
                            <option>Select Manager</option>
                                <?php
                                        include '../Inc/DBcon.php';
                                        $sql2="select * from staff where status='1' AND role_id='1';";
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Project Country</label>
                            <select class="form-control select2" id="country" style="width: 100%;" >
                            <option>Select Country</option>
                                <?php
                                        include '../Inc/DBcon.php';
                                        $sql2="select * from country;";
                                        $result=mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result) > 0 )
                                        {
                                            
                                            while($row = mysqli_fetch_array($result))
                                            {
                                            
                                                echo '<option value="'.$row['ID'].'" >'.$row['name'].'</option>';
                                               
                                            }
                                        }
                                        mysqli_close($conn);
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="required"> % Profit</label>
                            <input type="number" class="form-control" id="profit" placeholder="Enter %Profit" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="required"> AVG Rate</label>
                            <input type="number" class="form-control" id="rate" placeholder="Enter AVG Rate" >
                        </div>
                    </div>
                    <div class="col-md-4  d-none">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Project Stage</label>
                            <select class="form-control select2" id="stage" style="width: 100%;" >
                            <option>Select Stage</option>
                                <?php
                                        include '../Inc/DBcon.php';
                                        $sql2="select * from project_phase;";
                                        $result=mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result) > 0 )
                                        {
                                         
                                            while($row = mysqli_fetch_array($result))
                                            {
                                            
                                                echo '<option value="'.$row['ID'].'" >'.$row['short_name'].'</option>';
                                                
                                            }
                                        }
                                        mysqli_close($conn);
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Project Status</label>
                            <select class="form-control select2" id="status" style="width: 100%;" >
                            <option>Select Status</option>
                                <?php
                                        include '../Inc/DBcon.php';
                                        $sql2="select * from project_status;";
                                        $result=mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result) > 0 )
                                        {
                                            
                                            while($row = mysqli_fetch_array($result))
                                            {
                                            
                                                echo '<option value="'.$row['ID'].'" >'.$row['name'].'</option>';
                                               
                                            }
                                        }
                                        mysqli_close($conn);
                                    ?> 
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Office</label>
                            <select class="form-control select2" id="office" style="width: 100%;" >
                            <option>Select Office</option>
                                <?php
                                        include '../Inc/DBcon.php';
                                        $sql2="select * from office;";
                                        $result=mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result) > 0 )
                                        {
                                             
                                            while($row = mysqli_fetch_array($result))
                                            {
                                                echo '<option value="'.$row['ID'].'" >'.$row['name'].'</option>';
                                              
                                            }
                                        }
                                        mysqli_close($conn);
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"  >Deadline</label>
                            <select class="form-control select2" id="deadline" style="width: 100%;" >
                            <option value="">Select Deadline</option>
                                <?php
                                        $weeks=getWeeks(date('Y'));
                                        foreach($weeks as $week)
                                        {
                                            echo '<option value="'.$week.'" >'.$week.'</option>';
                                        }
                                        
                                    ?>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <label for="exampleInputEmail1 " class="required">Project Stage</label>
                <div class="row">
                
                            <?php
                                include '../Inc/DBcon.php';
                                $sql2="select * from project_phase;";
                                $result=mysqli_query($conn,$sql2);
                                if(mysqli_num_rows($result) > 0 )
                                {   $i=1;
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        if($i==1)
                                        {
                                            echo '<div class="col-md-2"  >
                                            <div class="form-check">
                                                <input class="form-check-input stcheck" type="checkbox" value="'.$row['ID'].'" id="customCheckbox'.$row['ID'].'" checked onchange="StageBoxes(this.id)">
                                                <label class="form-check-label">'.$row['short_name'].'</label>
                                            </div>
                                        </div> ';
                                        }
                                        else
                                        {
                                            echo '<div class="col-md-2"  >
                                            <div class="form-check">
                                                <input class="form-check-input stcheck" type="checkbox" value="'.$row['ID'].'" id="customCheckbox'.$row['ID'].'" onchange="StageBoxes(this.id)">
                                                <label class="form-check-label">'.$row['short_name'].'</label>
                                            </div>
                                        </div> ';
                                        }
                                       
                                        $i++;
                                    }
                                }
                                mysqli_close($conn);
                            ?>
                           
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="add-project-close" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="NewProject()">Add Project</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade show" id="modal-lg-edit">
        <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Project</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-1 pace-primary" id="project-update-form">
                
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="add-project-close" data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade show" id="modal-avg">
        <div class="modal-dialog   modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">AVG Rate Calculator</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body pace-primary" >
            <form id='avg-calculator' action='javascript:void(0)'>
                <div class="row">
                    <?php
                        include '../Inc/DBcon.php';
                        $sql2="select * from office;";
                        $result=mysqli_query($conn,$sql2);
                        if(mysqli_num_rows($result) > 0 )
                        {
                                
                            while($row = mysqli_fetch_array($result))
                            {
                                
                                echo '<div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">'.$row['code'].' Hour Rate : '.$row['hour_rate'].'</label>
                                            <input type="number" class="form-control form-control-sm" rate="'.$row['hour_rate'].'" id="'.$row['ID'].'rate" placeholder="Enter Staff no" >
                                        </div>
                                    </div>';
                            }
                        }
                        mysqli_close($conn);
                    ?>
                </div>
            </form>
                <div class="row">
                        <div class="col-md-12 border-top"> 
                            <div class="form-group">
                                <label for="exampleInputEmail1">AVG Rate</label>
                                <input type="text" class="form-control form-control-sm"  id="avgrate" placeholder="0.00" readonly>
                            </div>
                        </div>
                        <div class="col-md-6"><button class="btn btn-primary btn-block" onclick="CalculateAVG()">Calculate AVG</button></div>
                        <div class="col-md-6"><button class="btn btn-danger btn-block" onclick="ClearAVG()">Clear</button></div>
                        
                </div>
            </div>
            <div class="modal-footer justify-content-end">
              <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>  
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function FilterSearch(value)
    {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    }
    function PrintDiv()
        {
            var restorepage = $('body').html();
            var printcontent = $('#plist').clone();
            $('body').empty().html(printcontent);
            window.print();
            window.location.href = "project-list.php";
        }
</script>                                
  <?php include '../Inc/footer.php';?>
  <script src="../Inc/project-list.js"></script>
</body>
</html>
