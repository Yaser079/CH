<?php session_start(); include '../script/islogin.php'; $_SESSION['nav']='support-admin';  include '../script/functions.php';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Support Dashboard</title>
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
            <h1 class="text-dark mr-2">Support Dashboard</h1>
            <select class="form-control form-control-sm select2 mr-2" id="Aoffice" style="width: 150px;" onchange="SelectMFilter(this.id,this.value)">
                    <option value="all">All Support Office</option>
                    <?php
                        include '../Inc/DBcon.php';
                        $sql2="select * from office where status='1' and ID in (2,4)";
                        $result=mysqli_query($conn,$sql2);
                        if(mysqli_num_rows($result) > 0 )
                        {
                            
                            while($row = mysqli_fetch_array($result))
                            {
                                if(isset($_SESSION['Aoffice']))
                                {
                                        if($_SESSION['Aoffice']==$row['ID'])
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
            <select class="form-control form-control-sm select2" id="Amanager" style="width: 150px;" onchange="SelectMFilter(this.id,this.value)">
                              
                             <option value="all">All Manager</option>
                             <?php
                                        include '../Inc/DBcon.php';
                                        $filter=" AND office in (2,4)";
                                        if(isset($_SESSION['Aoffice']) && $_SESSION['Aoffice']!="all")
                                        {
                                          $filter=" AND  office='".$_SESSION['Aoffice']."' ";
                                        }
                                        $sql2="select * from staff where status='1' AND role_id='1' ".$filter.";";
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
              <li class="breadcrumb-item active">Support Dashboard</li>
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
          <div class="card card-primary card-tabs" style="height: 250px; width: 100%;">
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
              <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-sm btn-outline-secondary m-1 sb" id="s7day" onclick="FilterDaysS(7,this.id)">7 Days</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary m-1 sb" id="s30day" onclick="FilterDaysS(30,this.id)">30 Days</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary m-1 sb" id="s90day" onclick="FilterDaysS(90,this.id)">90 Days</button>
                </div>
                <div class="tab-content" id="custom-tabs-one-tabContent">
                
                  
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
                          $filter1=" office in (2,4)";
                          if(isset($_SESSION['Aoffice']) && $_SESSION['Aoffice']!='all')
                          {
                            $filter1=" office='".$_SESSION['Aoffice']."' ";
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
                                        if(getBaliAndHResourceProject($row2['ID'],$filter1))
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
                          $filter1=" office in (2,4)";
                          if(isset($_SESSION['Aoffice']) && $_SESSION['Aoffice']!='all')
                          {
                            $filter1=" office='".$_SESSION['Aoffice']."' ";
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
                                          if(getBaliAndHResourceProject($row2['ID'],$filter1))
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
            $filter3=" office in (2,4) ";
            if( isset($_SESSION['Aoffice']) && $_SESSION['Aoffice']!='all')
            {
              $filter3=" office='".$_SESSION['Aoffice']."' ";
            }
            $sql2="select * from staff where role_id='1' ".$filter."  ;";
            $staffresult=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($staffresult) > 0 )
            {
               
              while($staffrow = mysqli_fetch_array($staffresult))
                {$pro=0;
                  $sql2="select * from projects where manager_id='".$staffrow['ID']."';";
                  $proresult=mysqli_query($conn,$sql2);
                  if(mysqli_num_rows($proresult) > 0 )
                  {
                     
                    while($prorow = mysqli_fetch_array($proresult))
                      {
                         if(getBaliAndHResourceProject($prorow['ID'],$filter3))
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
                            <h3 class="card-title"><?= $staffrow['nick_name']?> : <?=getBaliProjects($staffrow['ID'],$filter3)?></h3>

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
                                            $weeks=getWeeks2();
                                                foreach($weeks as $week)
                                                {
                                                    echo '<th  ><div class="rotated" > '.$week.' </div></th>';
                                                }
                                            ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            include '../Inc/DBcon.php';
                                            $filter3=" office in (2,4) ";
                                            if( isset($_SESSION['Aoffice']) && $_SESSION['Aoffice']!='all')
                                            {
                                              $filter3=" office='".$_SESSION['Aoffice']."' ";
                                            }
                                            $sql2="select * from projects where manager_id='".$staffrow['ID']."' ;";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                    $i=1;
                                                while($row = mysqli_fetch_array($result))
                                                {  
                                                  if(getBaliAndHResourceProject($row['ID'],$filter3))
                                                  {
                                                    $sql2="select * from project_resource where pid='".$row['ID']."';";
                                                    $result0=mysqli_query($conn,$sql2);
                                                    if(mysqli_num_rows($result0) > 0 )
                                                    {
                                                        
                                                        while($row0 = mysqli_fetch_array($result0))
                                                        {
                                                          $resor=getManager($row0['staff_id']);
                                                          $res="";
                                                          if(isset($_SESSION['Aoffice']) && $_SESSION['Aoffice']!='all')
                                                          {
                                                             
                                                            if($resor['office']==$_SESSION['Aoffice'])
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
                                                              
                                                                $weeks=getWeeks2();
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
                                                          else if($resor['office']==2 || $resor['office']==4)
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
                                                              
                                                                $weeks=getWeeks2();
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
            $filter3=" office in (2,4) ";
            if( isset($_SESSION['Aoffice']) && $_SESSION['Aoffice']!='all')
            {
              $filter3=" office='".$_SESSION['Aoffice']."' ";
            }
            $sql2="select * from country where status='1'";
            $result=mysqli_query($conn,$sql2);
            $array2= array();
            if(mysqli_num_rows($result) > 0 )
            {
                
                while($row = mysqli_fetch_array($result))
                {
                  if(getProjectsByCountry($row['ID'],$filter,$filter3)>0)
                  {
                    $array2+=[$row['name']=> getProjectsByCountry($row['ID'],$filter,$filter3)];
                  }
                    //echo '{ label: "'.$row['name'].'", y: '.getProjectsByCountry($row['ID'],$filter).' },';
                }
                foreach($array2 as $key => $val)
                {
                  echo '{ label: "'.$key.'", y: '.$val.' },';
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
            $filter3=" office in (2,4) ";
            if( isset($_SESSION['Aoffice']) && $_SESSION['Aoffice']!='all')
            {
              $filter3=" office='".$_SESSION['Aoffice']."' ";
            }
            $sql2="select * from staff where role_id='1' ".$filter."";
            $result=mysqli_query($conn,$sql2);
            $array2= array();
            if(mysqli_num_rows($result) > 0 )
            {
                
                while($row = mysqli_fetch_array($result))
                {
                  if(getBaliProjects($row['ID'],$filter3)>0)
                  {
                    $array2+=[$row['nick_name']=> getBaliProjects($row['ID'],$filter3)];
                  }
                  //  echo '{ label: "'.$row['nick_name'].'", y: '.getBaliProjects($row['ID']).' },';
                }
                foreach($array2 as $key => $val)
                {
                  echo '{ label: "'.$key.'", y: '.$val.' },';
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
            $filter3=" office in (2,4) ";
            if( isset($_SESSION['Aoffice']) && $_SESSION['Aoffice']!='all')
            {
              $filter3=" office='".$_SESSION['Aoffice']."' ";
            }
            $sql2="select * from project_phase ;";
            $result=mysqli_query($conn,$sql2);
            $array2= array();
            if(mysqli_num_rows($result) > 0 )
            {
                
                while($row = mysqli_fetch_array($result))
                {
                  if(getBaliProjectsByStage($row['ID'],$filter,$filter3)>0)
                  {
                    $array2+=[$row['short_name']=> getBaliProjectsByStage($row['ID'],$filter,$filter3)];
                  }
                  //  echo '{ label: "'.$row['short_name'].'", y: '.getBaliProjectsByStage($row['ID'],$filter).' },';
                }
                foreach($array2 as $key => $val)
                {
                  echo '{ label: "'.$key.'", y: '.$val.' },';
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
