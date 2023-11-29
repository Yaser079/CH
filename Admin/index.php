<?php session_start(); include '../script/islogin.php'; $_SESSION['nav']='dashboard'; include '../script/functions.php';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Dashboard</title>
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
          <div class="col-sm-6 d-flex justify-content-start">
            <h1 class="text-dark mr-2"><?= $_SESSION['site']?> DASHBOARD</h1>
            <select class="form-control form-control-sm select2" id="Doffice" style="width: 150px;" onchange="SelectDFilter(this.id,this.value)">
                    <option value="all">All Office</option>
                    <?php
                        include '../Inc/DBcon.php';
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
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $_SESSION['site']?> DASHBOARD</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row mt-2">
        <div class="col-md-2 align-self-center">
          <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="far fa-building"></i></span>
              <div class="info-box-content">
                  <h6 class="info-box-text font-weight-bold">Resource</h6>
                  <h2 class="info-box-number font-weight-bolder">
                    <?php
                      $filter='1=1';
                      if(isset($_SESSION['Doffice']) && $_SESSION['Doffice']!='all')
                      {
                        $filter=" office='".$_SESSION['Doffice']."' ";
                      }
                    echo getResources($filter)?>
                  </h2>
              </div>
          </div> 
          <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="far fa-building"></i></span>
              <div class="info-box-content">
                  <h6 class="info-box-text font-weight-bold">Live Projects</h6>
                  <h2 class="info-box-number font-weight-bolder">
                    <?php 
                     $filter='1=1';
                     if(isset($_SESSION['Doffice']) && $_SESSION['Doffice']!='all')
                     {
                       $filter=" office_id='".$_SESSION['Doffice']."' ";
                     }
                    echo getLiveProjects($filter)?>
                  </h2>
              </div>
          </div>             
        </div>
        <div class="col-md-4   ">
          <div  class="border shadow p-2  bg-white rounded rounded-sm"  style="height: 300px; width: 100%;  ">
            <h3 style="text-align: center;">RESOURCE UTILIZATION</h3>
            <div style="margin-top: 20px;  " class="d-flex justify-content-center">
              <button type="button" class="btn btn-sm btn-outline-secondary m-1 ub" id="u7day" onclick="FilterDays(7,this.id)">7 Days</button>
              <button type="button" class="btn btn-sm btn-outline-secondary m-1 ub" id="u30day" onclick="FilterDays(30,this.id)">30 Days</button>
              <button type="button" class="btn btn-sm btn-outline-secondary m-1 ub" id="u90day" onclick="FilterDays(90,this.id)">90 Days</button>
           </div>
            <div class="d-flex justify-content-center">
                    
                <div id="some_element" class=" align-items-center " style="margin-top: 10px; "> </div>
            </div>
            
          
          
          </div>
        </div>
        <div class="col-md-3">
          <div    >
           
            <div class="card card-primary card-tabs" style="height: 300px; width: 100%; overflow-y:auto;  overflow-x: hidden;">
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
                        $filter='1=1';
                        if(isset($_SESSION['Doffice']) && $_SESSION['Doffice']!='all')
                        {
                          $filter=" office='".$_SESSION['Doffice']."' ";
                        }
                        $sql2="select * from staff  where ". $filter.";";
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
                              $array+=[$row2['nick_name'] => (100-((((int)$hours+$total)/40)*100))];
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
                        $filter='1=1';
                        if(isset($_SESSION['Doffice']) && $_SESSION['Doffice']!='all')
                        {
                          $filter=" office='".$_SESSION['Doffice']."' ";
                        }
                        $sql2="select * from staff  where ". $filter.";";
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
        <div class="col-md-3">
            <div class="card card-primary" style=" height: 300px;">
              <div class="card-header">
                <h3 class="card-title">Upcoming Holidays</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-1" style="display: block;  width: 100%; overflow-y:auto;  overflow-x: hidden;">
                  <table class="table table-bordered table-hover text-center">
                  <thead class="table-primary">
                    <tr>
                      <th>Event</th>
                      <th>Week</th>
                      <th>Office</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  include '../Inc/DBcon.php';
                  $filter='1=1';
                  if(isset($_SESSION['Doffice']) && $_SESSION['Doffice']!='all')
                  {
                    $filter=" office_id='".$_SESSION['Doffice']."' ";
                  }
                  $sql2="select * from office_holidays where ".$filter." order by week; ";
                  $result=mysqli_query($conn,$sql2);
                  if(mysqli_num_rows($result) > 0 )
                  {
                      
                      while($row = mysqli_fetch_array($result))
                      { $office=getOffice($row['office_id']);
                        $dateTimestamp1 = strtotime($row['week']); 
                        $dateTimestamp2 = strtotime($_SESSION['current-week']); 
                          
                        // Compare the timestamp date  
                        if ($dateTimestamp1 > $dateTimestamp2) {
                          echo '<tr>
                                  <td>'.$row['description'].'</td>
                                  <td>'.$row['week'].'</td>
                                  <td>'.$office['code'].'</td>
                                </tr>';
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
       <div class="row">
        <div class="col-md-3">
          <div id="chartContainer1" class="border shadow rounded" style="height: 250px; width: 100%;"></div>
        </div>
        <div class="col-md-3">
          <div id="chartContainer2" class="border shadow rounded" style="height: 250px; width: 100%;"></div>
        </div>
        <div class="col-md-3">
          <div id="chartContainer3" class="border shadow rounded" style="height: 250px; width: 100%;"></div>
        </div>
        <div class="col-md-3">
          <div id="chartContainer4" class="border shadow rounded" style="height: 250px; width: 100%;"></div>
        </div>
       </div>
       
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
  <script src="../dist/js/pureknob.js" type="text/javascript"></script>
  <script>
    
    function demoKnob(value) {
				// Create knob element, 300 x 300 px in size.
				const knob = pureknob.createKnob(350, 300);
				// Set properties.
				knob.setProperty('angleStart', -0.50 * Math.PI);
				knob.setProperty('angleEnd', 0.50 * Math.PI);
        knob.setProperty('colorBG', '#D8DEE1');
				knob.setProperty('colorFG', '#727B7F');
				knob.setProperty('trackWidth', 0.4);
				knob.setProperty('valMin', 0);
				knob.setProperty('valMax', 100);

				// Set initial value.
				knob.setValue(value);
				const node = knob.node();
        
				const elem = document.getElementById('some_element');
        elem.innerHTML='';
				elem.appendChild(node);
			}
 
window.onload = function () {
   
			 
    var options1 = {
      animationEnabled: true,
      title: {
        text: "Project By Status",
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
            $filter=" ";
            if(isset($_SESSION['Doffice']) && $_SESSION['Doffice']!='all')
            {
              $filter="and office_id='".$_SESSION['Doffice']."' ";
            }
            $sql2="select * from project_status ;";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                while($row = mysqli_fetch_array($result))
                {
                  $sql2="select * from projects where status='".$row['ID']."' ".$filter." ;";
                  $pro=mysqli_query($conn,$sql2);
                    echo '{ label: "'.$row['name'].'", y: '.mysqli_num_rows($pro).' },';
                }
            }
            mysqli_close($conn);
          ?> 
        ]
      }]
    };
$("#chartContainer1").CanvasJSChart(options1);
var options2 = {
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
            $filter1="";
            if(isset($_SESSION['Doffice']) && $_SESSION['Doffice']!='all')
            {
              $filter1=" AND office_id='".$_SESSION['Doffice']."' ";
            }
            $sql2="select * from project_phase ;";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                
                while($row = mysqli_fetch_array($result))
                {
                  $sql2="select * from projects where stage='".$row['ID']."'  ".$filter."  ; ";
                   
                  $result1=mysqli_query($conn,$sql2);
                    echo '{ label: "'.$row['short_name'].'", y: '.mysqli_num_rows($result1).' },';
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
            $filter1="";
            if(isset($_SESSION['Doffice']) && $_SESSION['Doffice']!='all')
            {
              $filter1=" AND office_id='".$_SESSION['Doffice']."' ";
            }
            $sql2="select * from country ;";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                while($row = mysqli_fetch_array($result))
                {
                  $sql2="select * from projects where country_id='".$row['ID']."' ".$filter1."  ; ";
                   
                  $result1=mysqli_query($conn,$sql2);
                    echo '{ label: "'.$row['name'].'", y: '.mysqli_num_rows($result1).' },';
                }
            }
            mysqli_close($conn);
          ?> 
        ]
      }]
    };
 $("#chartContainer3").CanvasJSChart(options3);
 var options4 = {
      animationEnabled: true,
      title: {
        text: "Resource By Office",
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
             
            $sql2="select * from office ;";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                while($row = mysqli_fetch_array($result))
                {
                  $sql2="select * from staff where office='".$row['ID']."'   ; ";
                   
                  $result1=mysqli_query($conn,$sql2);
                    echo '{ label: "'.$row['name'].'", y: '.mysqli_num_rows($result1).' },';
                }
            }
            mysqli_close($conn);
          ?> 
        ]
      }]
    };
 $("#chartContainer4").CanvasJSChart(options4);
 
 
 
  }
  </script>
<?php include '../Inc/footer.php';?>
<script src="../Inc/dashboard.js"></script>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>

</body>
</html>
