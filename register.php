<?php session_start();

include 'script/getsite.php';
if(isset($_SESSION['uid']))
{
  if($_SESSION['role']==1)
  {
    header("Location:Admin/index.php");
  }
  else{
    header("Location:Admin/weekly-resource.php");
  }
} ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $_SESSION['site']?> | Register</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="dist/img/<?= $_SESSION['fav']?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <!-- SweetAlert2 -->
   <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
     <!-- pace-progress -->
     <link rel="stylesheet" href="plugins/pace-progress/themes/black/pace-theme-flat-top.css">
</head>
<body class="hold-transition login-page  pace-primary accent-primary">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b><?= $_SESSION['prefix']?></b><?= $_SESSION['suffix']?></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Register to join our team</p>

      <form action="script/register.php" method="post" >
      <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Name" name="name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="tel" class="form-control" placeholder="Phone" name="phone" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <select class="form-control " name="office" required>
                    <option value="">Select Office</option>
                    <?php
                        include 'Inc/DBcon.php';
                        $sql2="select * from office where status='1'";
                        $result=mysqli_query($conn,$sql2);
                        if(mysqli_num_rows($result) > 0 )
                        {
                            
                            while($row = mysqli_fetch_array($result))
                            {
                                if(isset($_SESSION['Doffice']))
                                {
                                        if($_SESSION['Doffice']==$row['ID'])
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
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-building"></span>
            </div>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="pass" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
           
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Create Account</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
     
      <div class="social-auth-links text-center mb-3">
      
        
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="index.php">Already have Account?</a>
      </p>
       
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

 <!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Login Script -->
<script src="Inc/login-script.js"></script>
  <!-- pace-progress -->
  <script src="plugins/pace-progress/pace.min.js"></script>
  <?php
    if(isset($_SESSION['response']))
    {
      if($_SESSION['response']=="true")
      {
        echo '<script>toastr["success"]("Account Created Successfully.Now you can Login.");</script>';
      }
      else
      {
        echo '<script>toastr["error"]("Failed to create account.");</script>';
      }
      unset($_SESSION['response']);
    }
    
    ?>
</body>
</html>
