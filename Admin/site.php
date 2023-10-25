<?php session_start(); include '../script/islogin.php';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Site Settings</title>
  <?php include '../Inc/head.php';?>

</head>
<body class="hold-transition sidebar-mini">
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
            <h1 class="text-dark">Site Settings</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Site Settings</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Site General Setting</h3>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Site Name</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="site" placeholder="Enter site name" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Prefix</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="prefix" placeholder="Enter prefix" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Suffix</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="suffix" placeholder="Enter suffix" required>
                        </div>
                    </div>
                    
                    <div class="col-md-2 pt-4">
                        <button type="submit" class="btn btn-block btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div> 
    </div>
       

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include '../Inc/footer.php';?>
</body>
</html>
