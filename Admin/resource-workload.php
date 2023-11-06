<?php session_start(); include '../script/islogin.php'; $_SESSION['nav']='workload'; include '../script/functions.php';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Resource Workload</title>
  <?php include '../Inc/head.php';?>
  <style>
 
      .narrow{width: 20px !important;}
      .name{ cursor: pointer;}
</style>
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
            <h1 class="text-dark">Resource Workload</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Resource Workload</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="card card-primary">
            <div class="card-header">
                <div class="d-flex justfiy-content-start">
                    <h3 class="card-title mr-4 d-flex align-self-center ">Resource Workload</h3>
                    <select class="form-control form-control-sm select2" id="wweek" style="width: 150px;" onchange="SelectLoadOffice(this.value)">
                              
                             <option value="0">All Office</option>
                            <?php
                                include '../Inc/DBcon.php';
                                $sql2="select * from office where status='1'";
                                $result=mysqli_query($conn,$sql2);
                                if(mysqli_num_rows($result) > 0 )
                                {
                                    
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
                                    }
                                }
                                mysqli_close($conn);
                            ?>
                            
                    </select>                             
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body " id="staff-list">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover text-center staff-list">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Nick Name</th>
                                <th class="rotated">Office</th>
                                <th class="rotated">Projects</th>
                                <?php 
                                
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
                                $sql2="select * from staff";
                                $result2=mysqli_query($conn,$sql2);
                                if(mysqli_num_rows($result) > 0 )
                                {
                                    $i=1;
                                    while($row2 = mysqli_fetch_array($result2))
                                    {
                                        $office=getOffice($row2['office']);
                                        $projects=getStaffProjectsCount($row2['ID']);
                                        $name="'".$row2['nick_name']."'";
                                        echo '<tr class="name"  onclick="AllProjects('.$row2['ID'].','.$name.')"  data-toggle="modal" data-target="#modal-all-projects">
                                                <td>'.$i.'</td>
                                                <td >'.$row2['name'].'</td>
                                                <td>'.$row2['nick_name'].' </td>
                                                <td>'.$office['code'].'</td>
                                                <td class="font-weight-bold">'.$projects.'</td>
                                                 ';
                                                 $weeks=getWeeks(date('Y'));
                                                foreach($weeks as $week)
                                                {
                                                    $hours=getStaffWeeklyHoliday($row2['ID'],$week);
                                                    $holiday=getOfficeWeeklyHoliday($row2['office'],$week);
                                                    $weekly= getStaffWeeklyWork($row2['ID'],$week);
                                                    $total=$hours+$holiday+$weekly;
                                                    $color="";
                                                    $status="No Work";
                                                    $textColor="text-muted small";
                                                    if($total<40 && $total>0)
                                                    {
                                                        $color="#BDD7EE";
                                                        $status="Needs Work";
                                                        $textColor="";

                                                    }
                                                    else if($total==40)
                                                    {
                                                        $color="#A9D08E";
                                                        $status="Good Fully Work";
                                                        $textColor="";
                                                    }
                                                    else if($total>40)
                                                    {
                                                        $color="#FFACA7";
                                                        $status="Overloaded";
                                                        $textColor="";
                                                    }
                                                    echo '<td class="font-weight-bold '. $textColor.'" style="background-color:'.$color.'" data-tooltip="tooltip" data-placement="top" title="'.$status.'">'.$total.'</td>';
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
       

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-all-projects">
        <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modal-title">Projects Working Details of Anna</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body pace-primary" id="weekly-projects">
            </div>
            <div class="modal-footer justify-content-end">
              <button type="button" class="btn btn-default" id="add-project-close" data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  <?php include '../Inc/footer.php';?>
  <script src="../Inc/resource-workload.js"></script>
</body>
</html>
