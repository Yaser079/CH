<?php session_start(); include '../script/islogin.php'; $_SESSION['nav']='admin-holiday';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Manage Holiday</title>
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
            <h1 class="text-dark">Manage Holiday</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Holiday</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header ">
                        <h3 class="card-title d-flex align-self-center">Office Official Holidays</h3>
                         
                    </div>
                    <div class="card-body" id="holiday-list">
                        <div class="table-responsive">
                            <table   class="table table-bordered text-center ">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="rotated">Office</th>
                                    <th class="rotated">Total</th>
                                    <?php 
                                      include '../script/functions.php';
                                      $weeks=getWeeks(date('Y'));
                                          foreach($weeks as $week)
                                          {
                                              echo '<th class="rotated"> '.$week.' </th>';
                                          }
                                      ?>
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
                                            $hours=getTotalOfficeHoliday($row['ID']);
                                            echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$row['code'].'</td>
                                            <td> '.$hours.'</td>';
                                            $weeks=getWeeks(date('Y'));
                                            foreach($weeks as $week)
                                            {
                                               $Holiday= getOfficeHoliday($row['ID'],$week);
                                               if($Holiday)
                                               {
                                                echo '<td class="week font-weight-bold" id="'.$row['ID'].'_'.$week.'" onclick="HolidayForm(this.id)" data-toggle="modal" data-target="#holiday-model" data-tooltip="tooltip"  title="'.$Holiday['description'].'">'.$Holiday['hours'].'</td>';
                                               }
                                               else
                                               {
                                                echo '<td class="week font-weight-bold" id="'.$row['ID'].'_'.$week.'" onclick="HolidayForm(this.id)" data-toggle="modal" data-target="#holiday-model">  </td>';

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
                </div>
            </div>
        </div>
       

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="holiday-model">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Holiday Hours</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="holiday-form">
                
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="close-holiday" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="UpdateHoliday()">Update</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
  <?php include '../Inc/footer.php';?>
  <script src="../Inc/admin-holiday.js"></script>
</body>
</html>
