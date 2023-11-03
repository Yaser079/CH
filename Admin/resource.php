<?php session_start(); include '../script/islogin.php'; $_SESSION['nav']='resource';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Resource List</title>
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
            <h1 class="text-dark">Resource List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Resource List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <h5 class="mb-2">Staff Count per Office</h5>
        <div class="row">
            <?php
            include '../script/functions.php';
            include '../Inc/DBcon.php';
            $sql2="select * from office;";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                $i=1;
                while($row = mysqli_fetch_array($result))
                {
                    $numbers=getOfficeStaff($row['ID']);
                    echo '<div class="col-6 col-lg-2 ">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="far fa-building"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">'.$row['code'].'</span>
                            <span class="info-box-number">'.$numbers.'</span>
                        </div>
                    </div>
                </div>';
                }
            }
            ?>
           
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header ">
                      <div class="d-flex  justify-content-between ">
                        <h3 class="card-title d-flex align-self-center">Staff Management</h3>
                        <button class="btn btn-defult bg-white" onclick="LoadStaffForm(0)" data-toggle="modal" data-target="#modal-staff">Add New</button>
                      </div>
                    </div>
                    <div class="card-body" id="staff-list">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered text-center ">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Nick Name</th>
                                    <th>Office</th>
                                    <th>Role</th>
                                    <th>Job Title</th>
                                    <th>Skills</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    
                                    include '../Inc/DBcon.php';
                                    $sql2="select * from staff;";
                                    $result=mysqli_query($conn,$sql2);
                                    if(mysqli_num_rows($result) > 0 )
                                    {
                                        $i=1;
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            $office=getOffice($row['office']);
                                            $role=getRole($row['role_id']);
                                            echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$row['name'].'</td>
                                            <td>'.$row['nick_name'].'</td>
                                            <td>'.$office['code'].'</td>
                                            <td>'.$role['name'].'</td>
                                            <td> </td>
                                            <td>';
                                            $sql2="select * from staff_skill where staff_id='".$row['ID']."'";
                                            $result2=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result2) > 0 )
                                            {
                                                while($row2 = mysqli_fetch_array($result2))
                                                {       
                                                    $skil=getSkill($row2['skill_id']);
                                                    echo '<span class="badge badge-secondary fs-1">'.$skil['name'].' 
                                                            </span>&nbsp;';    
                                                }
                                            }
                                            echo '</td>
                                            <td> 
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" '.($row['status']==1?'checked':'').' id="customSwitchS'.$row['ID'].'" onclick="StaffStatus(this.id,'.$row['ID'].')">
                                                 <label class="custom-control-label" id="customSwitchC'.$row['ID'].'l" for="customSwitchS'.$row['ID'].'"></label>
                                                </div>
                                            </td>
                                            <td> 
                                            <a href="javascript:void(0)"  onclick="LoadStaffForm('.$row['ID'].')" data-toggle="modal" data-target="#modal-staff"> <i class="nav-icon fas fa-edit text-secondary"></i></a> &nbsp;
                                            <a href="javascript:void(0)"   onclick="deleteStaff('.$row['ID'].')"><i class="nav-icon fas fa-trash text-danger"></i> </a> 
                                        
                                            </td>
                                        </tr>';
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
            </div>
        </div>

    </section>
    <!-- /.content -->
  </div>
   <!-- /.content-wrapper -->
   <div class="modal fade" id="modal-staff">
        <div class="modal-dialog  modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Manage Staff</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="staff-form">
                
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="close-staff" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="SaveStaff()">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
      <!-- /.modal -->   

  <?php include '../Inc/footer.php';?>
  <script src="../Inc/staff.js"></script>
</body>
</html>
