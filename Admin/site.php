<?php session_start(); include '../script/islogin.php';  $_SESSION['nav']='site';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Site Settings</title>
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
        <?php
          include '../Inc/DBcon.php';
          $sql99="select * from site";
          $result99=mysqli_query($conn,$sql99);
          $row = mysqli_fetch_array($result99);
        ?>
        <div class="card-body">
            <form action="../script/updatesite.php"  method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Site Name</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="site" value="<?= $row['site'];?>" placeholder="Enter site name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Prefix</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="prefix" value="<?= $row['prefix'];?>"  placeholder="Enter prefix" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Suffix</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="suffix" value="<?= $row['suffix'];?>"  placeholder="Enter suffix" required>
                        </div>
                    </div>
                     
                    <div class="col-md-3">
                         <div class="card">
                            <div class="card-body text-center">
                                <img src="../dist/img/<?= $row['logo'];?>" id="logo" class="img-circle elevation-2"   width="200px" height="200px" >
                            </div>
                            <div class="card-footer">
                              <div class="form-group">
                                <label for="exampleInputFile">Site Logo</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="logo" id="Inputlogo" onchange="PreviewLogo()">
                                    <label class="custom-file-label" for="exampleInputFile"  >Choose file</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                         </div>
                    </div>
                    <div class="col-md-3">
                         <div class="card">
                            <div class="card-body text-center">
                                <img src="../dist/img/<?= $row['fav'];?>" id="fav" class="img-circle elevation-2"  width="200px" height="200px" >
                            </div>
                            <div class="card-footer">
                              <div class="form-group">
                                <label for="exampleInputFile">Fav Icon</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fav" id="Inputfav"  onchange="PreviewFav()">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                         </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-block"  >Update</button>
                  </div>  
                </div>
            </form>
        </div> 
    </div>
       

    </section>
    <!-- /.content -->
   
  </div>
  <!-- /.content-wrapper -->
  <script>
  
    function PreviewLogo() {
						var oFReader = new FileReader();
						oFReader.readAsDataURL(document.getElementById("Inputlogo").files[0]);

						oFReader.onload = function (oFREvent) {
							document.getElementById("logo").src = oFREvent.target.result;
						};
					};
          function PreviewFav() {
						var oFReader = new FileReader();
						oFReader.readAsDataURL(document.getElementById("Inputfav").files[0]);

						oFReader.onload = function (oFREvent) {
							document.getElementById("fav").src = oFREvent.target.result;
						};
					};
  </script>
  <?php include '../Inc/footer.php';?>
  <?php
    if(isset($_SESSION['response']))
    {
      if($_SESSION['response']==1)
      {
        echo '<script>toastr["success"]("Site settings updated.");</script>';
      }
      else
      {
        echo '<script>toastr["error"]("Failed to update site settings.");</script>';
      }
      unset($_SESSION['response']);
    }
    
    ?>
</body>
</html>
