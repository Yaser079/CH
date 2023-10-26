<?php session_start(); include '../script/islogin.php';
 $_SESSION['nav']='users';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Users Managment</title>
  <?php include '../Inc/head.php';?>

</head>
<body class="hold-transition sidebar-mini pace-primary">
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
            <h1 class="text-dark">Users Managment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Managment</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create new user</h3>
                    </div>
                    <div class="card-body">
                         

                        
                        <div class="row">
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Full Name</label>
                                    <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter name" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputPhone1">Phone</label>
                                    <input type="text" class="form-control" id="exampleInputPhone1" placeholder="Phone" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label>Office</label>
                                <select class="form-control select2" id="country" style="width: 100%;" required>
                                    
                                    <?php
                                        include '../Inc/DBcon.php';
                                        $sql2="select * from office";
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
                            <div class="col-md-2 pt-4">
                                <div class="form-group" >
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch0" >
                                        <label class="custom-control-label" for="customSwitch0">Super Admin</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 pt-4">
                                <button type="submit" class="btn btn-block btn-primary" onclick="AddNewUser()">Add User</button>
                            </div>
                        </div>
                        
                    </div> 
                </div>
            </div>
        </div>
        <div id="list">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Users List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Office</th>
                  <th>Status</th>
                  <th>Super Admin</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    include '../Inc/DBcon.php';
                    $sql2="select users.ID as ID,users.name as name,users.email as email, users.phone as phone,  users.status as status, users.users as users, office.name as office from users inner join office on office.ID = users.office";
                    $result=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result) > 0 )
                    {
                        
                        while($row = mysqli_fetch_array($result))
                        {
                        
                            echo '<tr>
                                    <td>'.$row['ID'].'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['email'].'</td>
                                    <td>'.$row['phone'].'</td>
                                    <td>'.$row['office'].'</td>
                                    <td> 
                                         
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" '.($row['status']==1?'checked':'').' id="customSwitch'.$row['ID'].'" onclick="status(this.id,'.$row['ID'].')">
                                            <label class="custom-control-label" id="customSwitch'.$row['ID'].'l" for="customSwitch'.$row['ID'].'">'.($row['status']==1?'On':'Off').'</label>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" '.($row['users']==1?'checked':'').' id="customSwitchU'.$row['ID'].'" onclick="superAdmin(this.id,'.$row['ID'].')">
                                            <label class="custom-control-label" id="customSwitchU'.$row['ID'].'l" for="customSwitchU'.$row['ID'].'">'.($row['users']==1?'Yes':'No').'</label>
                                        </div>
                                         
                                    </td>
                                    <td>
                                     <a href="javascript:void(0)"  onclick="getUser('.$row['ID'].')" data-toggle="modal" data-target="#modal-lg"> <i class="nav-icon fas fa-edit text-secondary"></i></a> &nbsp;
                                    <a href="javascript:void(0)"   onclick="deleteUser('.$row['ID'].')"><i class="nav-icon fas fa-trash text-danger"></i> </a> 
                                    </td>
                                </tr>';
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
  <div class="modal fade show" id="modal-lg">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="update-form">
            
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="update-close" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="updateUser()">Update User</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  <?php include '../Inc/footer.php';?>
  <!-- user Script -->
  <script src="../Inc/users.js"></script>

</body>
</html>
