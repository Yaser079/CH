<?php session_start(); include '../script/islogin.php'; $_SESSION['nav']='location';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Location Management</title>
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
            <h1 class="text-dark">Location Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Location Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header ">
                      <div class="d-flex  justify-content-between ">
                        <h3 class="card-title d-flex align-self-center">Country Management</h3>
                        <button class="btn btn-defult bg-white" onclick="LoadCountryForm(0)" data-toggle="modal" data-target="#modal-country">Add New</button>
                      </div>
                    </div>
                    <div class="card-body" id="country-list">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered text-center ">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Tag</th>
                                    <th>Color</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    include '../Inc/DBcon.php';
                                    $sql2="select * from country;";
                                    $result=mysqli_query($conn,$sql2);
                                    if(mysqli_num_rows($result) > 0 )
                                    {
                                        $i=1;
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$row['name'].'</td>
                                            <td>'.$row['tag'].'</td>
                                            <td><div style="background-color: '.$row['color'].'; height:20px; width: 50px; margin:auto; border-radius:5px; border: 1px solid grey;"> </div></td>
                                            <td> 
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" '.($row['status']==1?'checked':'').' id="customSwitchC'.$row['ID'].'" onclick="CountryStatus(this.id,'.$row['ID'].')">
                                                 <label class="custom-control-label" id="customSwitchC'.$row['ID'].'l" for="customSwitchC'.$row['ID'].'"></label>
                                                </div>
                                            </td>
                                            <td> 
                                            <a href="javascript:void(0)"  onclick="LoadCountryForm('.$row['ID'].')" data-toggle="modal" data-target="#modal-country"> <i class="nav-icon fas fa-edit text-secondary"></i></a> &nbsp;
                                            <a href="javascript:void(0)"   onclick="deleteCountry('.$row['ID'].')"><i class="nav-icon fas fa-trash text-danger"></i> </a> 
                                        
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
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header ">
                      <div class="d-flex  justify-content-between">
                        <h3 class="card-title d-flex align-self-center">Office Management</h3>
                        <button class="btn btn-defult bg-white" onclick="LoadOfficeForm(0)" data-toggle="modal" data-target="#modal-office">Add New</button>
                      </div>
                    </div>
                    <div class="card-body" id="office-list">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered text-center ">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Hour Rate</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    include '../Inc/DBcon.php';
                                    $sql2="select * from office;";
                                    $result=mysqli_query($conn,$sql2);
                                    if(mysqli_num_rows($result) > 0 )
                                    {
                                        $i=1;
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$row['name'].'</td>
                                            <td>'.$row['code'].'</td>
                                            <td>'.$row['hour_rate'].'</td>
                                            <td> 
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" '.($row['status']==1?'checked':'').' id="customSwitchO'.$row['ID'].'" onclick="OfficeStatus(this.id,'.$row['ID'].')">
                                                 <label class="custom-control-label" id="customSwitchC'.$row['ID'].'l" for="customSwitchO'.$row['ID'].'"></label>
                                                </div>
                                            </td>
                                            <td> 
                                            <a href="javascript:void(0)"  onclick="LoadOfficeForm('.$row['ID'].')" data-toggle="modal" data-target="#modal-office"> <i class="nav-icon fas fa-edit text-secondary"></i></a> &nbsp;
                                            <a href="javascript:void(0)"   onclick="deleteOffice('.$row['ID'].')"><i class="nav-icon fas fa-trash text-danger"></i> </a> 
                                        
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
    <div class="modal fade" id="modal-country">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Manage Country</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="country-form">
                
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="close-country" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="SaveCountry()">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
      <!-- /.modal -->      
      <div class="modal fade" id="modal-office">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Manage Office</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="office-form">
                
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="close-office" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="SaveOffice()">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
      <!-- /.modal -->                            
  <?php include '../Inc/footer.php';?>
  <script src="../Inc/location.js"></script>
</body>
</html>
