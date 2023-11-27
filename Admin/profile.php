<?php session_start(); include '../script/islogin.php';  $_SESSION['nav']='profile';  include '../script/functions.php';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Profile</title>
  <?php include '../Inc/head.php';?>

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
            <h1 class="text-dark">Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section> 
  
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php 
           include '../Inc/DBcon.php';
           $sql2="select * from users where ID='".$_SESSION['uid']."'";
           $result2=mysqli_query($conn,$sql2);
           $user = mysqli_fetch_array($result2);
           $staff=getUserStaff($user['ID']);

           mysqli_close($conn);
        ?>
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../dist/img/<?=$user['picture'];?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?=$user['name'];?></h3>

                <p class="text-muted text-center"><?=$user['users']==1?'Super Admin':'User';?></p>

                <ul class="list-group list-group-unbordered mb-0">
                <li class="list-group-item">
                    <b>Nick Name</b> <a class="float-right"><?=$staff['nick_name'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right"><?=$user['email'];?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Phone</b> <a class="float-right"><?=$user['phone'];?></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-user-tie mr-1"></i> Job Title</strong>

                <p class="text-muted">
                <?php
                    include '../Inc/DBcon.php';
                    $sql2="select * from staff_job where staff_id='".$staff['ID']."'";
                    $result=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result) > 0 )
                    {
                        while($row = mysqli_fetch_array($result))
                        {       
                            $job=getJob($row['job_id']);
                            echo '<span class="badge badge-success p-1" style="font-size:12px;">'.$job['name'].'</span>&nbsp;';    
                        }
                    }
                    mysqli_close($conn);
                ?>
                </p>

                <hr>
                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                <?php
                    include '../Inc/DBcon.php';
                    $sql2="select * from staff_skill where staff_id='".$staff['ID']."'";
                    $result=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result) > 0 )
                    {
                        while($row = mysqli_fetch_array($result))
                        {       
                            $skil=getSkill($row['skill_id']);
                            echo '<span class="badge badge-secondary p-1" style="font-size:12px;">'.$skil['name'].' &nbsp; </span>&nbsp;';    
                        }
                    }
                    mysqli_close($conn);
                ?>
                </p>
                <hr>
                <strong><i class="fas fa-map-marker-alt mr-1"></i> Office</strong>

                    <p class="text-muted"><?=getOffice($staff['office'])['name'];?></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                  <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Password</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="settings">
                    <form class="form-horizontal" action="../script/updateprodile.php" method="post" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"   name="name" placeholder="Name" value="<?= $user['name']?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control"  placeholder="Email" value="<?= $user['email']?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                          <input type="tel" class="form-control"   name="phone" placeholder="Phone" value="<?= $user['phone']?>">
                        </div>
                      </div>
                       
                      <div class="card">
                            <div class="card-body text-center">
                                <img src="../dist/img/<?= $user['picture'];?>" id="fav" class="img-circle elevation-2"  width="200px" height="200px" >
                            </div>
                            <div class="card-footer">
                              <div class="form-group">
                                <label for="exampleInputFile">Profile Picture</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="img" id="Inputfav"  onchange="PreviewFav()">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                         </div>
                      <div class="form-group row">
                        <div class="col-md-12">
                          <button type="submit" class="btn btn-danger float-right">Update Profile</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="password">
                  <form class="form-horizontal" action="../script/updatepassword.php" onsubmit="return ComparePass()" method="post" enctype="multipart/form-data">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Current Password</label>
                        <div class="col-sm-8">
                          <input type="password" class="form-control" id="cpass" placeholder="Current Password" >
                          <input type="hidden" id="ccpass" value="<?= $user['password']?>">
                        </div>
                        <div class="col-sm-2">
                          <a href="javascript:void(0)" class="btn btn-secondary btn-block text-white" onclick="CurrentPass()">Continue</a>
                        </div>
                      </div>
                      <div id="new-pass-box" style="display: none;">
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">New Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" name="pass" id="npass" placeholder="New Password" >
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Confirm Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="ncpass" placeholder="Confirm Password" >
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-12">
                            <button type="submit" class="btn btn-danger float-right">Update Password</button>
                          </div>
                        </div>
                      </div>

                  </form>
                  </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
   
  </div>
  <!-- /.content-wrapper -->
    <script>
       function PreviewFav() {
						var oFReader = new FileReader();
						oFReader.readAsDataURL(document.getElementById("Inputfav").files[0]);

						oFReader.onload = function (oFREvent) {
							document.getElementById("fav").src = oFREvent.target.result;
						};
					};
          function CurrentPass()
          {
              var cpass=document.getElementById("cpass").value;
              var ccpass=document.getElementById("ccpass").value;
              if(cpass==ccpass)
              {
                $("#new-pass-box").slideDown();
                 
              }
              else
              {
                $("#new-pass-box").slideUp();
                toastr["error"]("Invalid Current Password.");
              }
          }
          function ComparePass()
          {
            var cpass=document.getElementById("npass").value;
            var ccpass=document.getElementById("ncpass").value;
            if(ccpass==cpass)
            {
              return true;
            }
            else
            {
              toastr["error"]("Password didn't matched.");
              return false;
            }
          }
    </script>

  <?php include '../Inc/footer.php';?>
         <?php
         
    if(isset($_SESSION['response']))
    {
      if($_SESSION['response']==1)
      {
        echo '<script>toastr["success"]("Profile updated.");</script>';
      }
      else if($_SESSION['response']==11)
      {
        echo '<script>toastr["success"]("Password updated.");</script>';
      }
      else
      {
        echo '<script>toastr["error"]("Failed to update Profile.");</script>';
      }
      unset($_SESSION['response']);
    }
    
    ?>
</body>
</html>
