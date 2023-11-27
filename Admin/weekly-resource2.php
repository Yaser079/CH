<?php session_start(); include '../script/islogin.php'; $_SESSION['nav']='weekly2'; include '../script/functions.php';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Weekly Resource</title>
  <?php include '../Inc/head.php';?>
<style>
td {
         padding: 5px !important;
      }
      th{
         padding: 5px  !important;
      }
      .narrow{width: 20px !important;}
      .name{ cursor: pointer;}
</style>
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
            <h1 class="text-dark">Weekly Resource</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Weekly Resource</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title ">Filters</h3>
                </div>
                <div class="card-body">
                <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                            <label>Office</label>
                            <select class="form-control form-control-sm select2" id="woffice" style="width: 100%;" onchange="SetWFilter(this.id,this.value)">
                                    <option value="all">All</option>
                                    <?php
                                            include '../Inc/DBcon.php';
                                            $sql2="select * from office where status='1'";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if(isset($_SESSION['woffice']))
                                                    {
                                                            if($_SESSION['woffice']==$row['ID'])
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
                        </div>
                         
                        <div class="col-md-2 d-none">
                            <div class="form-group">
                            <label>Resource Capacity</label>
                            <select class="form-control form-control-sm select2" id="wcapacity" style="width: 100%;" onchange="SetWFilter(this.id,this.value)">
                                    <option value="all">All</option>
                                    
                            </select>
                            </div>
                        </div>
                        
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm btn-block " style="margin-top: 31px;" onclick="ClearWFilter()"><i class="fa fa-trash" ></i> Clear</button>
                        </div>
                    </div>
                </div>

        </div>
         
        <div class="card card-primary">
            <div class="card-header">
                <div class="d-flex justfiy-content-start">
                    <h3 class="card-title mr-4 d-flex align-self-center ">Project Resourcing for Week</h3>
                    <select class="form-control form-control-sm select2" id="wweek" style="width: 150px;" onchange="SelectWeeklyResource(this.value)">
                             <option>Select Week</option>
                             <?php
                                $weeks=getWeeks(date('Y'));
                                foreach($weeks as $week)
                                {   
                                    if(isset($_SESSION['weekly-resource']) && $_SESSION['weekly-resource']==$week)
                                    {
                                        echo '<option value="'.$week.'" selected>'.$week.'</option>';
                                    }
                                    else
                                    {
                                        echo '<option value="'.$week.'">'.$week.'</option>';
                                    }
                                   
                                }
                             ?>
                    </select>                             
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body " id="weekly-rescource">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th class="narrow">ID</th>
                                <th class="narrow">View</th>
                                <th class="narrow">Name</th>
                                <th class="narrow">Office</th>
                                <th class=" narrow ">No of Projects</th>
                                <th class=" narrow "><?= $_SESSION['weekly-resource'];?> Hours</th>
                                <th class=" narrow ">Capacity</th>
                                <th class=" narrow ">Utilisation</th>
                                <th class=" narrow ">Utilisation (including leave)</th>
                                <th class=" narrow ">VACATION / HOLIDAY</th>
                                <th class=" narrow ">GENERAL OFFICE</th>
                                <th class=" narrow ">MARKETING / BD</th>
                                <th class=" narrow ">TRAINING/ RESERVIST</th>
                                <th class=" narrow ">OFFICE HOLIDAY</th>
                                <th class=" narrow ">PUBLIC HOLIDAY</th>
                                <th class=" narrow ">MEDICAL LEAVE/<br>HOSPITALIZATION LEAVE</th>
                                <th class=" narrow ">ANNUAL LEAVE/BIRTHDAY LEAVE<br>/CHILD CARE/UNPAID LEAVE</th>
                                <th class=" narrow ">REMARKS</th>
                            </tr>
                        </thead>
                        <tbody class="font-weight-bold">
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
                                        $projectsCount=getCurrentWeekProjectsOfStaff($row2['ID'],$_SESSION['weekly-resource']);
                                        $hours= getCurrentWeekHoursOfStaff($row2['ID'],$_SESSION['weekly-resource']);
                                        $publicHlidy=getOfficeWeeklyHoliday($row2['office'],$_SESSION['weekly-resource']);
                                        $anualHolidy=getStaffWeeklyHoliday($row2['ID'],$_SESSION['weekly-resource']);
                                        $otherLeaves=getCurrentWeekLeavesOfStaff($row2['ID'],$_SESSION['weekly-resource']);
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
                                        $name="'".$row2['nick_name']."'";
                                        $week="'".$_SESSION['weekly-resource']."'";
                                        $cp=(40-((int)$hours+$total))>0?"#BDD7EE":"#FFACA7";
                                        echo '<tr >
                                                <td>'.$i.'</td>
                                                <td >
                                                <a href="javascript:void(0)" class="name" onclick="WeeklyReport('.$row2['ID'].','.$name.','.$week.')"  data-toggle="modal" data-target="#modal-weekly">
                                                 <i class="nav-icon fas fa-eye"></i></a>
                                                </td>
                                                <td >'.$row2['nick_name'].'</td>
                                                <td>'.$office['code'].'</td>
                                                <td>'.$projectsCount.'</td>
                                                <td>'.$hours.'</td>
                                                <td style="background-color: '.$cp.'">'.(40-((int)$hours+$total)).'</td>
                                                <td>'.(((int)$hours/40)*100).'% </td>
                                                <td>'.((((int)$hours+$total)/40)*100).'% </td>
                                                <td class="week" id="VACATION_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l1.'</td>
                                                <td class="week" id="GENERAL_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l2.'</td>
                                                <td class="week" id="MARKETING_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l3.'</td>
                                                <td class="week" id="TRAINING_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l4.'</td>
                                                <td class="week" id="OFFICE_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l5.'</td>
                                                <td>'.$publicHlidy.'</td>
                                                <td class="week" id="MEDICAL_'.$_SESSION['weekly-resource'].'" onclick="NewLeves('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-hour">'.$l6.'</td>
                                                <td>'.$anualHolidy.'</td>
                                                <td class="week" id="REMARKS_'.$_SESSION['weekly-resource'].'" onclick="NewRemakrs('.$row2['ID'].',this.id)"  data-toggle="modal" data-target="#modal-remark">'.$remarks.'</td>
                                                 ';
                                                
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
  <div class="modal fade" id="modal-weekly">
        <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modal-title">Projects Working Details of Anna for Week </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body pace-primary" id="weekly-projects">

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="add-project-close" data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-hour">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modal-title">Other Leves</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body pace-primary">
                <label for="exampleInputEmail1">Enter Hours</label>
                <input type="number" class="form-control" id="hours" placeholder="Enter hours" >
                <input type="hidden" id="staff" value="">
                <input type="hidden" id="week" value=""> 
                <input type="hidden" id="column" value="">                  
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="add-hours-close" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="updateLeves()">Add Project</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-remark">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modal-title">Remarks</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body pace-primary">
                <label for="exampleInputEmail1">Enter Remarks</label>
                <textarea class="form-control" id="remarks"></textarea>
                <input type="hidden" id="rstaff" value="">
                <input type="hidden" id="rweek" value=""> 
                <input type="hidden" id="rcolumn" value="">                  
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" id="add-remark-close" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="updateRemarks()">Add Project</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  <?php include '../Inc/footer.php';?>
  <script src="../Inc/weekly-resource.js"></script>
</body>
</html>
