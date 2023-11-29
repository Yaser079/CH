<?php session_start(); include '../script/islogin.php'; $_SESSION['nav']='support-admin';  include '../script/functions.php';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Support Admin</title>
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
          <div class="col-sm-6 d-flex justify-content start">
            <h1 class="text-dark mr-2">Support Admin</h1>
            <select class="form-control form-control-sm select2" id="Amanager" style="width: 150px;" onchange="SelectMFilter(this.id,this.value)">
                              
                             <option value="all">All Manager</option>
                             <?php
                                        include '../Inc/DBcon.php';
                                        $sql2="select * from staff where status='1' AND role_id='1';";
                                        $result=mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result) > 0 )
                                        {
                                            
                                            while($row = mysqli_fetch_array($result))
                                            {
                                              if(isset($_SESSION['Amanager']))
                                              {
                                                      if($_SESSION['Amanager']==$row['ID'])
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
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Support Admin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" id="admin-support">
        <div class="row">
          <div class="col-md-3 ">
              <div id="chartContainer" class="border shadow" style="height: 250px; width: 100%;"></div>     
          </div>
          <div class="col-md-3  ">
              <div id="chartContainer2" class="border shadow"  style="height: 250px; width: 100%;"></div>             
          </div>
          <div class="col-md-3  ">
              <div id="chartContainer3" class="border shadow"  style="height: 250px; width: 100%;"></div>             
          </div>
          <div class="col-md-3  ">
          <div class="card card-primary card-tabs" style="height: 250px; width: 100%; overflow-y:auto;  overflow-x: hidden;">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">AVAILABLE STAFF</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">OVERLOADED STAFF</a>
                  </li>
                   
                </ul>
              </div>
              <div class="card-body p-2">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active p-0" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                  <?php
                        include '../Inc/DBcon.php';
                        $sql2="select * from staff where office='4';";
                        $result=mysqli_query($conn,$sql2);
                        if(mysqli_num_rows($result) > 0 )
                        {
                          $array= array();
                            while($row2 = mysqli_fetch_array($result))
                            {
                              $hours= getCurrentWeekHoursOfStaff($row2['ID'],$_SESSION['current-week']);
                              $publicHlidy=getOfficeWeeklyHoliday($row2['office'],$_SESSION['current-week']);
                              $anualHolidy=getStaffWeeklyHoliday($row2['ID'],$_SESSION['current-week']);
                              $otherLeaves=getCurrentWeekLeavesOfStaff($row2['ID'],$_SESSION['current-week']);
                              $l1=$l2=$l3=$l4=$l5=$l6=0;
                              $remarks='';
                              if($otherLeaves!=0)
                              {
                                  $l1=$otherLeaves['VACATION'];
                                  $l2=$otherLeaves['GENERAL'];
                                  $l3=$otherLeaves['MARKETING'];
                                  $l4=$otherLeaves['TRAINING'];
                                  $l5=$otherLeaves['OFFICE'];
                                  $l6=$otherLeaves['MEDICAL'];
                                  $remarks=$otherLeaves['REMARKS'];
                              }
                              $total=$l1+$l2+$l3+$l4+$l5+$l6+$publicHlidy+$anualHolidy;
                              if(((int)$hours+$total)<40)
                               {
                                $array+=[$row2['nick_name']=> (100-((((int)$hours+$total)/40)*100))];
                               }
                              
                            }
                            arsort($array);
                            foreach($array as $key => $val)
                            {
                              echo '<div class="d-flex justify-content-start" style="height: 20px;">
                                        <p style="width: 100px; text-align:right;margin-right:10px; padding:0px">'.$key.'</p>
                                        <div class="progress-group" style="width: 100%;padding:0px">
                                          <div class="progress progress-md">
                                            <div class="progress-bar bg-success" style="width: '.$val.'% ;">'.$val.'% available</div>
                                          </div>
                                        </div>
                                    </div>';
                            }
                            
                        }
                        mysqli_close($conn);
                        ?>   
                </div>
                  <div class="tab-pane fade p-0" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                  <?php
                        include '../Inc/DBcon.php';
                        $sql2="select * from staff where office='4';";
                        $result=mysqli_query($conn,$sql2);
                        if(mysqli_num_rows($result) > 0 )
                        {
                          $array= array();
                            while($row2 = mysqli_fetch_array($result))
                            {
                              $hours= getCurrentWeekHoursOfStaff($row2['ID'],$_SESSION['current-week']);
                              $publicHlidy=getOfficeWeeklyHoliday($row2['office'],$_SESSION['current-week']);
                              $anualHolidy=getStaffWeeklyHoliday($row2['ID'],$_SESSION['current-week']);
                              $otherLeaves=getCurrentWeekLeavesOfStaff($row2['ID'],$_SESSION['current-week']);
                              $l1=$l2=$l3=$l4=$l5=$l6=0;
                              $remarks='';
                              if($otherLeaves!=0)
                              {
                                  $l1=$otherLeaves['VACATION'];
                                  $l2=$otherLeaves['GENERAL'];
                                  $l3=$otherLeaves['MARKETING'];
                                  $l4=$otherLeaves['TRAINING'];
                                  $l5=$otherLeaves['OFFICE'];
                                  $l6=$otherLeaves['MEDICAL'];
                                  $remarks=$otherLeaves['REMARKS'];
                              }
                              $total=$l1+$l2+$l3+$l4+$l5+$l6+$publicHlidy+$anualHolidy;
                              if(((int)$hours+$total)>40)
                               {
                                $array+=[$row2['nick_name']=> (((((int)$hours+$total)/40)*100))];
                               }
                              
                            }
                            arsort($array);
                            foreach($array as $key => $val)
                            {
                              echo '<div class="d-flex justify-content-start" style="height: 20px;">
                                        <p style="width: 100px; text-align:right;margin-right:10px; padding:0px">'.$key.'</p>
                                        <div class="progress-group" style="width: 100%;padding:0px">
                                          <div class="progress progress-md">
                                            <div class="progress-bar bg-danger" style="width: '.$val.'% ;">'.$val.'% Working</div>
                                          </div>
                                        </div>
                                    </div>';
                            }
                            
                        }
                        mysqli_close($conn);
                        ?> 
                       
                </div>
                  
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-5" >
          <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Upcoming Projects Deadline</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i> </button>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-1" style="display: block; height:250px; overflow-y:auto;  overflow-x: hidden;">
                    <table class="table table-bordered table-hover text-center ">
                      <thead class="table-danger">
                        <tr>
                          <th>Deadline</th>
                          <th class="text-left">Project Name</th>
                          <th>PM</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          include '../Inc/DBcon.php';
                          $filter='';
                          if(isset($_SESSION['Amanager']) && $_SESSION['Amanager']!='all')
                          {
                            $filter=" AND ID='".$_SESSION['Amanager']."' ";
                          }
                          $sql2="select * from staff where role_id='1' ".$filter." ;";
                          $result1=mysqli_query($conn,$sql2);
                          if(mysqli_num_rows($result1) > 0 )
                          {
                            $i=1;
                            while($row1 = mysqli_fetch_array($result1))
                              {
                                $sql2="select * from projects where manager_id='".$row1['ID']."' order by deadline;";
                                $result2=mysqli_query($conn,$sql2);
                                if(mysqli_num_rows($result2) > 0 )
                                {
                                    while($row2 = mysqli_fetch_array($result2))
                                    {
                                        if(getBaliResourceProject($row2['ID']))
                                        {
                                          $pm=getManager($row2['manager_id']);
                                          $review=getProjectLatestReview($row2['ID']);
                                          $status="";
                                          $comments="";
                                          if($review!=0)
                                          {
                                              $comments=$review['comments'];
                                              if($review['status']!=0)
                                              {   $re=getProjectReview($review['status']);
                                                  $status=$re['name'];
                                                  
                                              }
                                          }
                                              echo '<tr>
                                                      <td>'.$row2['deadline'].'</td>
                                                      <td class="text-left">'.$row2['name'].'</td>
                                                      <td>'.$pm['nick_name'].'</td>
                                                    </tr>';
                                            $i++;
                                        }
                                    }
                                  }
                                }
                              }
                          mysqli_close($conn);
                        ?>
                      </tbody>
                    </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-md-7 " >
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Project Highlights</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i> </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-1" style="display: block; height: 250px; overflow-y:auto;  overflow-x: hidden">
              <table class="table  table-bordered table-hover text-center">
                    <thead class="table-primary">
                        <tr>
                            <th data-orderable="false">Code</th>
                            <th class="text-left" data-orderable="false">Projects</th>
                            <th data-orderable="false">PM</th>
                            <th data-orderable="false">Status</th>
                            <th data-orderable="false" class="text-left">Additional Comments</th>    
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include '../Inc/DBcon.php';
                            $filter='';
                          if(isset($_SESSION['Amanager']) && $_SESSION['Amanager']!='all')
                          {
                            $filter=" AND ID='".$_SESSION['Amanager']."' ";
                          }
                            $sql2="select * from staff where role_id='1' ".$filter." ;";
                            $result1=mysqli_query($conn,$sql2);
                            if(mysqli_num_rows($result1) > 0 )
                            {
                                $i=1;
                                while($row1 = mysqli_fetch_array($result1))
                                {
                                    $sql2="select * from projects where manager_id='".$row1['ID']."' order by deadline;";
                                    $result2=mysqli_query($conn,$sql2);
                                    if(mysqli_num_rows($result2) > 0 )
                                    {
                                      while($row2 = mysqli_fetch_array($result2))
                                        {
                                          if(getBaliResourceProject($row2['ID']))
                                          {
                                            $pm=getManager($row2['manager_id']);
                                            $review=getProjectLatestReview($row2['ID']);
                                            $status="";
                                            $comments="";
                                            if($review!=0)
                                            {
                                                $comments=$review['comments'];
                                                if($review['status']!=0)
                                                {   $re=getProjectReview($review['status']);
                                                    $status=$re['name'];
                                                    
                                                }
                                            }
                                            $state=getStatus($row2['status']);
                                            echo '<tr>
                                                    
                                                    
                                                    <td  >'.$row2['code'].'</td>
                                                    <td class="text-left">'.$row2['name'].'</td>
                                                    <td>'.$pm['nick_name'].'</td>
                                                    <td>'.$status.'</td>
                                                    <td class="text-left"> '.$comments.'</td>
                                                  </tr>';
                                                  $i++;
                                          }
                                        }
                                    }   
                                }
                            }
                            mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-12">
            <?php
            include '../Inc/DBcon.php';
            $filter='';
            if(isset($_SESSION['Amanager']) && $_SESSION['Amanager']!='all')
            {
              $filter=" AND ID='".$_SESSION['Amanager']."' ";
            }
            $sql2="select * from staff where role_id='1' ".$filter." ;";
            $staffresult=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($staffresult) > 0 )
            {
               $pro=0;
              while($staffrow = mysqli_fetch_array($staffresult))
                {
                  $sql2="select * from projects where manager_id='".$staffrow['ID']."';";
                  $proresult=mysqli_query($conn,$sql2);
                  if(mysqli_num_rows($proresult) > 0 )
                  {
                     
                    while($prorow = mysqli_fetch_array($proresult))
                      {
                         if(getBaliResourceProject($prorow['ID']))
                         {
                           $pro=$pro+1;
                         }
                      }
                  }
                  if($pro>0)
                  {
                    ?>
                      <div class="card card-primary  ">
                          <div class="card-header">
                            <h3 class="card-title"><?= $staffrow['nick_name']?> : <?=getBaliProjects($staffrow['ID'])?></h3>

                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i> </button>
                              <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i> </button>
                            </div>
                            <!-- /.card-tools -->
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body p-2"   style="display: none;">
                              <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover text-center">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PM</th>
                                            <th>Code</th>
                                            <th class="text-left">Name</th>
                                            <th>Resource</th>
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
                                            $sql2="select * from projects where manager_id='".$staffrow['ID']."' ;";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                    $i=1;
                                                while($row = mysqli_fetch_array($result))
                                                {  
                                                  if(getBaliResourceProject($row['ID']))
                                                  {
                                                    $sql2="select * from project_resource where pid='".$row['ID']."';";
                                                    $result0=mysqli_query($conn,$sql2);
                                                    if(mysqli_num_rows($result0) > 0 )
                                                    {
                                                        
                                                        while($row0 = mysqli_fetch_array($result0))
                                                        {
                                                          $resor=getManager($row0['staff_id']);
                                                          if($resor['office']==4)
                                                          {
                                                            $prject=getProject($row['ID']);
                                                            $country=getCountry($prject['country_id']);
                                                            $stage=getStage($prject['stage']);
                                                            $pm=getManager($prject['manager_id']);
                                                            
                                                            echo '<tr>
                                                              <td>'.$i.'</td>
                                                              <td>'.$pm['nick_name'].'</td>
                                                              <td>'.$prject['code'].'</td>
                                                              <td class="text-left">'.$prject['name'].'</td>
                                                              <td>'.$resor['nick_name'].'</td>';
                                                             
                                                              $weeks=getWeeks(date('Y'));
                                                              foreach($weeks as $week)
                                                              {
                                                                  
                                                                  $weekly=getResourceWeek($row['ID'],$row0['staff_id'],$week);
                                                                  $total=$weekly>0?$weekly:0;
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
                                                                  echo '<td class=" font-weight-bold '.$textColor.'" style="background-color:'.$color.'" data-tooltip="tooltip" data-placement="top" title="'.$status.'">'.$total.'</td>';
                                                              }
                                                              echo'</tr>';
                                                          }
                                                          
                                                        }
                                                    }
                                                    

                                                    $i++;
                                                  }
                                                    
                                                }
                                            }
                                              
                                        ?>
                                        </tbody>          
                                  </table>

                            </div>
                          </div>
                          <!-- /.card-body -->
                      </div>
                    <?php
                  }
                }
            }
            mysqli_close($conn);
            ?>
            
           
                
          </div>            
        </div>
       
        <script>
window.onload = function () {

    var options1 = {
      animationEnabled: true,
      title: {
        text: "Project By Region",
            fontFamily: "arial"
      },
      data: [{
        type: "doughnut",
        innerRadius: "70%",

        legendText: "{label}",
        indexLabel: "{label}: {y}",
        dataPoints: [
          <?php
            include '../Inc/DBcon.php';
            $filter='1=1';
            if(isset($_SESSION['Amanager']) && $_SESSION['Amanager']!='all')
            {
              $filter=" manager_id='".$_SESSION['Amanager']."' ";
            }
            $sql2="select * from country where status='1'";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                
                while($row = mysqli_fetch_array($result))
                {
                    echo '{ label: "'.$row['name'].'", y: '.getProjectsByCountry($row['ID'],$filter).' },';
                }
            }
            mysqli_close($conn);
            ?>
        ]
      }]
    };
$("#chartContainer").CanvasJSChart(options1);
var options2 = {
      animationEnabled: true,
      title: {
        text: "Project By PM",
            fontFamily: "arial"
      },
      data: [{
        type: "doughnut",
        innerRadius: "70%",

        legendText: "{label}",
        indexLabel: "{label}: {y}",
        dataPoints: [
          <?php
            include '../Inc/DBcon.php';
            $filter='';
            if(isset($_SESSION['Amanager']) && $_SESSION['Amanager']!='all')
            {
              $filter=" AND ID='".$_SESSION['Amanager']."' ";
            }
            $sql2="select * from staff where role_id='1' ".$filter."";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                
                while($row = mysqli_fetch_array($result))
                {
                    echo '{ label: "'.$row['nick_name'].'", y: '.getBaliProjects($row['ID']).' },';
                }
            }
            mysqli_close($conn);
            ?>
        ]
      }]
    };
$("#chartContainer2").CanvasJSChart(options2);
var options3 = {
      animationEnabled: true,
      title: {
        text: "Project By Stages",
            fontFamily: "arial"
      },
      data: [{
        type: "doughnut",
        innerRadius: "70%",

        legendText: "{label}",
        indexLabel: "{label}: {y}",
        dataPoints: [
          <?php
            include '../Inc/DBcon.php';
            $filter='1=1';
            if(isset($_SESSION['Amanager']) && $_SESSION['Amanager']!='all')
            {
              $filter=" manager_id='".$_SESSION['Amanager']."' ";
            }
            $sql2="select * from project_phase ;";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                
                while($row = mysqli_fetch_array($result))
                {
                    echo '{ label: "'.$row['short_name'].'", y: '.getBaliProjectsByStage($row['ID'],$filter).' },';
                }
            }
            mysqli_close($conn);
            ?>
        ]
      }]
    };
$("#chartContainer3").CanvasJSChart(options3);
 
}
</script>
       

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include '../Inc/footer.php';?>
  <script src="../Inc/admin-support.js"></script>
  <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
</body>
</html>
