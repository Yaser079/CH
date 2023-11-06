<?php session_start(); include '../script/islogin.php'; $_SESSION['nav']='weekly2'; include '../script/functions.php';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Weekly Resource</title>
  <?php include '../Inc/head.php';?>
<style>
td {
         padding: 5px !important;
      }
      th{
         padding: 5px  !important;
      }
      .narrow{width: 20px !important;}
      .name{ cursor: pointer;}
</style>
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
            <h1 class="text-dark">Weekly Resource</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Weekly Resource</li>
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
                            <select class="form-control form-control-sm select2" id="woffice" style="width: 100%;" onchange="SetWFilter(this.id,this.value)">
                                    <option value="all">All</option>
                                    <?php
                                            include '../Inc/DBcon.php';
                                            $sql2="select * from office where status='1'";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if(isset($_SESSION['woffice']))
                                                    {
                                                            if($_SESSION['woffice']==$row['ID'])
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
                            <select class="form-control form-control-sm select2" id="wregion" style="width: 100%;" onchange="SetWFilter(this.id,this.value)">
                                    <option value="all">All</option>
                                    <?php
                                            include '../Inc/DBcon.php';
                                            $sql2="select * from country where status='1'";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if(isset($_SESSION['wregion']))
                                                    {
                                                            if($_SESSION['wregion']==$row['ID'])
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
                            <select class="form-control form-control-sm select2" id="wmanager" style="width: 100%;" onchange="SetWFilter(this.id,this.value)">
                                    <option value="all">All</option>
                                    <?php
                                        include '../Inc/DBcon.php';
                                        $sql2="select * from staff where status='1' AND role_id='1'";
                                        $result=mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result) > 0 )
                                        {
                                            
                                            while($row = mysqli_fetch_array($result))
                                            {
                                                if(isset($_SESSION['wmanager']))
                                                {
                                                        if($_SESSION['wmanager']==$row['ID'])
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
                            <label>Resource Capacity</label>
                            <select class="form-control form-control-sm select2" id="wcapacity" style="width: 100%;" onchange="SetWFilter(this.id,this.value)">
                                    <option value="all">All</option>
                                    
                            </select>
                            </div>
                        </div>
                        
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm btn-block " style="margin-top: 31px;" onclick="ClearWFilter()"><i class="fa fa-trash" ></i> Clear</button>
                        </div>
                    </div>
                </div>

        </div>
         
        <div class="card card-primary">
            <div class="card-header">
                <div class="d-flex justfiy-content-start">
                    <h3 class="card-title mr-4 d-flex align-self-center ">Project Resourcing for Week</h3>
                    <select class="form-control form-control-sm select2" id="wweek" style="width: 150px;" onchange="SelectWeeklyResource(this.value)">
                             <option>Select Week</option>
                             <?php
                                $weeks=getWeeks(date('Y'));
                                foreach($weeks as $week)
                                {   
                                    if(isset($_SESSION['weekly-resource']) && $_SESSION['weekly-resource']==$week)
                                    {
                                        echo '<option value="'.$week.'" selected>'.$week.'</option>';
                                    }
                                    else
                                    {
                                        echo '<option value="'.$week.'">'.$week.'</option>';
                                    }
                                   
                                }
                             ?>
                            
                    </select>                             
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body ">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th class="narrow">ID</th>
                                <th class="narrow">Name</th>
                                <th class="narrow">Office</th>
                                <th class="rotated narrow ">No of Projects</th>
                                <th class="rotated narrow ">Weekly Hours</th>
                                <th class="rotated narrow ">Capacity</th>
                                <th class="rotated narrow ">Utilisation</th>
                                <th class="rotated narrow ">Utilisation (including leave)</th>
                                <th class="rotated narrow ">VACATION / HOLIDAY</th>
                                <th class="rotated narrow ">GENERAL OFFICE</th>
                                <th class="rotated narrow ">MARKETING / BD</th>
                                <th class="rotated narrow ">TRAINING/ RESERVIST</th>
                                <th class="rotated narrow ">OFFICE HOLIDAY</th>
                                <th class="rotated narrow ">PUBLIC HOLIDAY</th>
                                <th class="rotated narrow ">MEDICAL LEAVE/<br>HOSPITALIZATION LEAVE</th>
                                <th class="rotated narrow ">ANNUAL LEAVE/BIRTHDAY LEAVE<br>/CHILD CARE/UNPAID LEAVE</th>
                                <th class=" narrow ">REMARKS</th>
                                    
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include '../Inc/DBcon.php';
                                $sql2="select * from staff";
                                $result2=mysqli_query($conn,$sql2);
                                if(mysqli_num_rows($result) > 0 )
                                {
                                    $i=1;
                                    while($row2 = mysqli_fetch_array($result2))
                                    {
                                        $office=getOffice($row2['office']);
                                        $name="'".$row2['nick_name']."'";
                                        $week="'".$_SESSION['weekly-resource']."'";
                                        echo '<tr class="name" onclick="WeeklyReport('.$row2['ID'].','.$name.','.$week.')"  data-toggle="modal" data-target="#modal-weekly">
                                                <td>'.$i.'</td>
                                                <td >'.$row2['nick_name'].'</td>
                                                <td>'.$office['code'].'</td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                 ';
                                                
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
        </div>
       



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-weekly">
        <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modal-title">Projects Working Details of Anna for Week </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body pace-primary" id="weekly-projects">

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="add-project-close" data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  <?php include '../Inc/footer.php';?>
  <script src="../Inc/weekly-resource.js"></script>
</body>
</html>
