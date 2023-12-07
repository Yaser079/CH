<?php session_start(); include '../script/islogin.php'; $_SESSION['nav']='admin-holiday';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Manage Holiday</title>
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
                       <div class="d-flex justify-content-between">
                        <h3 class="card-title d-flex align-self-center">Office Official Holidays</h3>
                        <button class="btn btn-light" data-toggle="modal" data-target="#new-holiday-model">Add Holiday</button>
                      </div>
                  </div>
                    <div class="card-body" id="holiday-list">
                        <div class="table-responsive">
                            <table   class="table table-bordered text-center ">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th  > Office </th>
                                    <th  ><div class="rotated" >Total</div></th>
                                    <?php 
                                      include '../script/functions.php';
                                      $weeks=getWeeks(date('Y'));
                                          foreach($weeks as $week)
                                          {
                                            echo '<th  data-orderable="false"><div class="rotated" > '.$week.' </div></th>';
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
            <div class="col-md-5">
              <div class="card card-primary">
                      <div class="card-header ">
                          <h3 class="card-title d-flex align-self-center ">Holidays List</h3>
                          
                      </div>
                      <div class="card-body">
                         <table class="table table-bordered text-center">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Date</th>
                              <th>Description</th>
                              <th>Office</th>
                              <th>Hours</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                               include '../Inc/DBcon.php';
                               $sql2="select * from holiday;";
                               $result=mysqli_query($conn,$sql2);
                               if(mysqli_num_rows($result) > 0 )
                               {
                                   $i=1;
                                   while($row = mysqli_fetch_array($result))
                                   {
                                       $office=getOffice($row['office_id']);
                                       echo '<tr>
                                       <td>'.$i.'</td>
                                       <td>'.$row['date_des'].'</td>
                                       <td>'.$row['description'].'</td>
                                       <td>'.$office['code'].'</td>
                                       <td>'.$row['hours'].'</td>
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
       

    </section>
    <!-- /.content -->
  </div>
  <div class="modal fade" id="new-holiday-model">
        <div class="modal-dialog modal-md modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">New Holiday Hours</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                          <label class="required">Date range (Current Week):</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="far fa-calendar-alt"></i>
                                </span>
                              </div>
                              <input type="text" class="form-control float-right" id="reservation">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="required">Description</label>
                            <input type="text" class="form-control" id="adesc" placeholder="Enter Description" >
                        </div>
                        <label for="exampleInputEmail1" class="required">Office</label>
                         <div class="row">
                         <?php
                                include '../Inc/DBcon.php';
                                $sql2="select * from office;";
                                $result=mysqli_query($conn,$sql2);
                                if(mysqli_num_rows($result) > 0 )
                                {   $i=0;
                                    while($row = mysqli_fetch_array($result))
                                    {
                                         
                                            echo '<div class="col-md-2"  >
                                            <div class="form-check">
                                                <input class="form-check-input stcheck" type="checkbox" value="'.$row['ID'].'" id="office'.$row['ID'].'"  >
                                                <label class="form-check-label">'.$row['code'].'</label>
                                            </div>
                                        </div> ';
                                         
                                        $i++;
                                    }
                                }
                                mysqli_close($conn);
                            ?>
                             <input type="hidden" id="aoffice" value="<?=$i;?>" >
                         </div>   
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="close-Nholiday" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="AddHoliday()">Add</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
