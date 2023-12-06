<?php session_start(); include '../script/islogin.php'; $_SESSION['nav']='workload'; include '../script/functions.php';?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Resource Workload</title>
  <?php include '../Inc/head.php';?>
  <style>
 
      .narrow{width: 20px !important;}
      .name{ cursor: pointer;}
      thead
{
  position: sticky;
  top: 0;
  z-index: 2;
  background-color: white;
}
  .stiky {
  position: sticky;
 left: 0;
  z-index: 1;
  background-color: white;
 
}
  
td.stiky:nth-child(1), th.stiky:nth-child(1) {
  left: 0px  ;
}
td.stiky:nth-child(2) , th.stiky:nth-child(2){
  left: 20px;  
}
td.stiky:nth-child(3) , th.stiky:nth-child(3){
  left: 135px;  
}
td.stiky:nth-child(4) , th.stiky:nth-child(4){
  left: 253px;  
}
td.stiky:nth-child(5) , th.stiky:nth-child(5){
  left: 290px;  
}
 
 
.table-responsive1 {
  width: 100%;
  overflow-x: scroll;
  max-height: 800px;
  overflow-y: auto;
}

table {
  width: 200%;
}
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
                    <button class="btn btn-light btn-sm  ml-2 mr-2" onclick="PrintDiv()">Print</button> 
                    <input id="myInput" onkeyup="FilterSearch()" type="text" class="form-control form-control-sm d-flex align-self-center mr-2" style="width: 200px;" placeholder="Search..">                          
                                            
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body " id="staff-list">
                <div class="table-responsive1">
                    <table id="wtable" class="table table-bordered table-hover text-center staff-list">
                        <thead>
                            <tr>
                                <th class="stiky">ID</th>
                                <th class="stiky" style="width: 120px !important;">Name</th>
                                <th class="stiky" style="width: 120px !important;">Nick Name</th>
                                <th class="rotated stiky">Office</th>
                                <th class="rotated stiky">Projects</th>
                                <?php 
                                
                                $weeks=getWeeks(date('Y'));
                                    foreach($weeks as $week)
                                    {
                                        echo '<th class="rotated" data-orderable="false"> '.$week.' </th>';
                                    }
                                ?>   
                            </tr>
                        </thead>
                        <tbody id="myTable">
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
                                                <td class="stiky">'.$i.'</td>
                                                <td class="stiky" style="width: 120px !important;">'.$row2['name'].'</td>
                                                <td class="stiky" style="width: 120px !important;">'.$row2['nick_name'].' </td>
                                                <td class="stiky">'.$office['code'].'</td>
                                                <td class="stiky font-weight-bold">'.$projects.'</td>
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
      <script>
        function PrintDiv()
        {
            var restorepage = $('body').html();
            var printcontent = $('#wtable').clone();
            $('body').empty().html(printcontent);
            window.print();
            window.location.href = "resource-workload.php";
        }
        function FilterSearch(value)
        {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        }
      </script>
  <?php include '../Inc/footer.php';?>
  <script src="../Inc/resource-workload.js"></script>
</body>
</html>
