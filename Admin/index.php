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

       <div class="row">
        <div class="col-md-3">
          <div id="chartContainer1" class="border shadow" style="height: 250px; width: 100%;"></div>
        </div>
        <div class="col-md-3">
          <div id="chartContainer2" class="border shadow" style="height: 250px; width: 100%;"></div>
        </div>
        <div class="col-md-3">
          <div id="chartContainer3" class="border shadow" style="height: 250px; width: 100%;"></div>
        </div>
        <div class="col-md-3">
          <div id="chartContainer4" class="border shadow" style="height: 250px; width: 100%;"></div>
        </div>
       </div>
       <div class="row mt-2">
        <div class="col-md-2 align-self-center">
          <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="far fa-building"></i></span>
              <div class="info-box-content">
                  <h6 class="info-box-text font-weight-bold">Resource</h6>
                  <h2 class="info-box-number font-weight-bolder"><?=getResources("1=1")?></h2>
              </div>
          </div> 
          <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="far fa-building"></i></span>
              <div class="info-box-content">
                  <h6 class="info-box-text font-weight-bold">Live Projects</h6>
                  <h2 class="info-box-number font-weight-bolder"><?=getLiveProjects("1=1")?></h2>
              </div>
          </div>             
        </div>
        <div class="col-md-3  d-flex justify-content-center  ">
        <div id="some_element" class="align-self-center"    >
          <h3 style="text-align: center;">RESOURCE UTILIZATION</h3>
           
        </div>
        
          <!-- <div id="chartContainer5" class="border shadow" style="height: 250px; width: 100%;"></div> -->
        </div>
        <div class="col-md-3">
        <div id="chartContainer6" class="border shadow"  style="height: 250px; width: 100%; overflow-y:auto;  overflow-x: hidden;"></div>                  
        </div>
        <div class="col-md-4">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Upcoming Holidays</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-1" style="display: block; height: 200px; width: 100%; overflow-y:auto;  overflow-x: hidden;">
                  <table class="table table-bordered table-hover text-center">
                  <thead class="table-primary">
                    <tr>
                      <th>Name</th>
                      <th>Week</th>
                      <th>Office</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  include '../Inc/DBcon.php';
                  
                  $sql2="select * from office_holidays order by week; ";
                  $result=mysqli_query($conn,$sql2);
                  if(mysqli_num_rows($result) > 0 )
                  {
                      
                      while($row = mysqli_fetch_array($result))
                      { $office=getOffice($row['ID']);
                          echo '<tr>
                                  <td>'.$row['description'].'</td>
                                  <td>'.$row['week'].'</td>
                                  <td>'.$office['code'].'</td>
                                </tr>';
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
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
  <script src="../dist/js/pureknob.js" type="text/javascript"></script>
  <script>
    
    function demoKnob() {
				// Create knob element, 300 x 300 px in size.
				const knob = pureknob.createKnob(250, 200);
				// Set properties.
				knob.setProperty('angleStart', -0.50 * Math.PI);
				knob.setProperty('angleEnd', 0.50 * Math.PI);
        knob.setProperty('colorBG', '#D8DEE1');
				knob.setProperty('colorFG', '#727B7F');
				knob.setProperty('trackWidth', 0.4);
				knob.setProperty('valMin', 0);
				knob.setProperty('valMax', 100);

				// Set initial value.
				knob.setValue(30);
				const node = knob.node();
				const elem = document.getElementById('some_element');
				elem.appendChild(node);
			}
 
window.onload = function () {
  demoKnob();
			 
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
            $filter="";
            if(isset($_SESSION['Dfilter']) && $_SESSION['Dfilter']!='all')
            {
              $filter="and office_id='".$_SESSION['Doffice']."' ";
            }
            $sql2="select * from project_status ;";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                while($row = mysqli_fetch_array($result))
                {
                  $sql2="select * from projects where status='".$row['ID']."'   ;";
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
            if(isset($_SESSION['Dfilter']) && $_SESSION['Dfilter']!='all')
            {
              $filter1=" AND office_id='".$_SESSION['Doffice']."' ";
            }
            $sql2="select * from project_phase ;";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                
                while($row = mysqli_fetch_array($result))
                {
                  $sql2="select * from projects where stage='".$row['ID']."'   ; ";
                   
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
            if(isset($_SESSION['Dfilter']) && $_SESSION['Dfilter']!='all')
            {
              $filter1=" AND office_id='".$_SESSION['Doffice']."' ";
            }
            $sql2="select * from country ;";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                while($row = mysqli_fetch_array($result))
                {
                  $sql2="select * from projects where country_id='".$row['ID']."'   ; ";
                   
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
 
// $("#chartContainer5").CanvasJSChart(options1);
var options6 = {
	animationEnabled: true,
	title: {
		text: "Support Workload",                
		fontColor: "black",
        fontFamily: "arial"
	},	
	axisY: {
		tickThickness: 1,
		lineThickness: 1,
		valueFormatString: " ",
		includeZero: true,
		gridThickness: 1                    
	},
	axisX: {
		tickThickness: 1,
		lineThickness: 1,
		labelFontSize: 12,
		labelFontColor: "Peru",
        barPercentage: 100				
	},
	data: [{
		indexLabelFontSize: 12,
		toolTipContent: "<span style=\"color:#61C3C3\">{indexLabel}:</span> <span style=\"color:#AD858F\"><strong>{y}</strong></span>",
		indexLabelPlacement: "inside",
		indexLabelFontColor: "white",
		indexLabelFontWeight: 400,
		indexLabelFontFamily: "Verdana",
		color: "#62a9C3",
		type: "bar",
		dataPoints: [
      <?php
            include '../Inc/DBcon.php';
            $sql2="select * from staff;";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                
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
                    echo '{ y: '.(40-((int)$hours+$total)).', label: "'.((((int)$hours+$total)/40)*100).'%", indexLabel: "'.$row2['nick_name'].'" },';
                }
            }
            mysqli_close($conn);
            ?>
		]
	}]
};

$("#chartContainer6").CanvasJSChart(options6);
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
