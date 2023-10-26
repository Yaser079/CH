<?php session_start(); include '../script/islogin.php';  $_SESSION['nav']='logs';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Logs</title>
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
            <h1 class="text-dark">Site Logs</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Site Logs</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  
    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Logs List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Action Description</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    include '../Inc/DBcon.php';
                    $sql2="select users.name as name, logs.ID as ID, logs.action as action, logs.created_at as date from logs inner join users on users.ID=logs.uid order by logs.ID desc";
                    $result=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result) > 0 )
                    {
                        $i=1;
                        while($row = mysqli_fetch_array($result))
                        {
                        
                            echo '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['action'].'</td>
                                    <td>'.$row['date'].'</td>
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
            
            <!-- /.card-body -->
            </div> 
       

    </section>
    <!-- /.content -->
   
  </div>
  <!-- /.content-wrapper -->

  <?php include '../Inc/footer.php';?>
  
</body>
</html>
