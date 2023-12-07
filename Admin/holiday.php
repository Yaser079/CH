<?php session_start(); include '../script/islogin.php'; $_SESSION['nav']='holiday';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Staff Annual Leave</title>
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
            <h1 class="text-dark">Staff Annual Leave</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Staff Annual Leave</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title d-flex align-self-center">Official Holidays</h3>
                    </div>
                    <div class="card-body" >
                        <div class="table-responsive">
                            <table id="office-holidays"  class=" table-bordered text-center ">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th  ><div class="rotated" >Office</div></th>
                                    <th  ><div class="rotated" >Total</div></th>
                                    <?php 
                                      include '../script/functions.php';
                                      $weeks=getWeeks(date('Y'));
                                          foreach($weeks as $week)
                                          {
                                              echo '<th   data-orderable="false"><div class="rotated" > '.$week.' </div></th>';
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
                                            <td class="font-weight-bold"> '.$hours.'</td>';
                                            $weeks=getWeeks(date('Y'));
                                            foreach($weeks as $week)
                                            {
                                               $Holiday= getOfficeHoliday($row['ID'],$week);
                                               if($Holiday)
                                               {
                                                echo '<td class="font-weight-bold" data-tooltip="tooltip" data-placement="top" title="'.$Holiday['description'].'">'.$Holiday['hours'].'</td>';
                                               }
                                               else
                                               {
                                                echo '<td class="font-weight-bold" >  </td>';

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
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header ">
                        <h3 class="card-title d-flex align-self-center">Annual Leaves</h3>
                    </div>
                    <div class="card-body" id="staff-holiday-list">
                        <div class="table-responsive">
                            <table id="example1"  class="table table-bordered text-center ">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th  >Name</th>
                                    <th class="rotated"><div class="rotated" > Office </div></th>
                                    <th class="rotated"><div class="rotated" > Total </div></th>
                                    <?php 
                                     
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
                                    $sql2="select * from staff order by CASE WHEN uid = '".$_SESSION['uid']."' THEN 0 ELSE 1 END, office asc;";
                                    $result=mysqli_query($conn,$sql2);
                                    if(mysqli_num_rows($result) > 0 )
                                    {
                                        $i=1;
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            $hours=getTotalStaffHoliday($row['ID']);
                                            $office=getOffice($row['office']);
                                            echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$row['nick_name'].'</td>
                                            <td>'.$office['code'].'</td>
                                            <td class="font-weight-bold"> '.$hours.'</td>';
                                            $weeks=getWeeks(date('Y'));
                                            foreach($weeks as $week)
                                            {
                                              if($_SESSION['role']==1)
                                              {
                                                  $Holiday= getStaffHoliday($row['ID'],$week);
                                                  if($Holiday)
                                                  {
                                                    echo '<td class="week font-weight-bold" id="'.$row['ID'].'_'.$week.'" onclick="HolidayForm(this.id)" data-toggle="modal" data-target="#holiday-model" data-tooltip="tooltip"  title="'.$Holiday['description'].'">'.$Holiday['hours'].'</td>';
                                                  }
                                                  else
                                                  {
                                                    echo '<td class="week font-weight-bold" id="'.$row['ID'].'_'.$week.'" onclick="HolidayForm(this.id)" data-toggle="modal" data-target="#holiday-model" >  </td>';

                                                  }
                                              }
                                              else
                                              {
                                                  $Holiday= getStaffHoliday($row['ID'],$week);
                                                  $inp=$inp2="";
                                                  $inp=$_SESSION['uid']==$row['uid']? 'week':'';
                                                  if($Holiday)
                                                  {
                                                    $inp2=$_SESSION['uid']==$row['uid']? 'onclick="HolidayForm(this.id)" data-toggle="modal" data-target="#holiday-model" data-tooltip="tooltip"  title="'.$Holiday['description'].'"':'';

                                                    echo '<td class="'.$inp.' font-weight-bold" id="'.$row['ID'].'_'.$week.'"  '.$inp2.' >'.$Holiday['hours'].'</td>';
                                                  }
                                                  else
                                                  {
                                                    $inp2=$_SESSION['uid']==$row['uid']? 'onclick="HolidayForm(this.id)" data-toggle="modal" data-target="#holiday-model"':'';
                                                    echo '<td class="'.$inp.' font-weight-bold" id="'.$row['ID'].'_'.$week.'"  '.$inp2.' >  </td>';

                                                  }
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
  <script src="../Inc/staff-holiday.js"></script>
</body>
</html>
