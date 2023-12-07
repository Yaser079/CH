<?php session_start(); include '../script/islogin.php';  $_SESSION['nav']='project-resource2'; ?>
<!DOCTYPE html>
<html>
<head>
 
  <title><?= $_SESSION['site']?> | Project Resourcing History</title>
  <?php include '../Inc/head.php';?>
 <style>
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
   
 
}
  
td{min-width: 30px !important;}
 
td.stiky:nth-child(2) , th.stiky:nth-child(2){
  left: 0px;  
}
td.stiky:nth-child(3) , th.stiky:nth-child(3){
  left: 48px;  
}
td.stiky:nth-child(4) , th.stiky:nth-child(4){
  left: 103px;  
}
td.stiky:nth-child(6) , th.stiky:nth-child(6){
  left: 275px;  
}
td.stiky:nth-child(7) , th.stiky:nth-child(7){
  left: 303px;  
}
td.stiky:nth-child(8) , th.stiky:nth-child(8){
  left: 348px;  
}
td.stiky:nth-child(9) , th.stiky:nth-child(9){
  left: 375px;  
}
td.stiky:nth-child(10) , th.stiky:nth-child(10){
  left: 423px;  
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
<body class="<?= $_SESSION['body'];?>" >
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
            <h1 class="text-dark">Project Resourcing History</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Project Resourcing History</li>
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
                            <select class="form-control form-control-sm select2" id="roffice" style="width: 100%;" onchange="SetRFilter(this.id,this.value)">
                                    <option value="all">All</option>
                                    <?php
                                            include '../Inc/DBcon.php';
                                            $sql2="select * from office where status='1'";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if(isset($_SESSION['roffice']))
                                                    {
                                                            if($_SESSION['roffice']==$row['ID'])
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
                        <div class="col-md-2">
                            <div class="form-group">
                            <label>Project Region</label>
                            <select class="form-control form-control-sm select2" id="rregion" style="width: 100%;" onchange="SetRFilter(this.id,this.value)">
                                    <option value="all">All</option>
                                    <?php
                                            include '../Inc/DBcon.php';
                                            $sql2="select * from country where status='1'";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if(isset($_SESSION['rregion']))
                                                    {
                                                            if($_SESSION['rregion']==$row['ID'])
                                                            {
                                                                echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'-'.$row['tag'].'</option>';
                                                            }
                                                            else
                                                            {
                                                                echo '<option value="'.$row['ID'].'">'.$row['name'].'-'.$row['tag'].'</option>';
                                                            }
                                                    }else
                                                    {
                                                        echo '<option value="'.$row['ID'].'">'.$row['name'].'-'.$row['tag'].'</option>';
                                                    }
                                                    
                                                }
                                            }
                                            mysqli_close($conn);
                                        ?>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <label>Project Manager</label>
                            <select class="form-control form-control-sm select2" id="rmanager" style="width: 100%;" onchange="SetRFilter(this.id,this.value)">
                                    <option value="all">All</option>
                                    <?php
                                        include '../Inc/DBcon.php';
                                        $sql2="select * from staff where status='1' AND role_id='1'";
                                        $result=mysqli_query($conn,$sql2);
                                        if(mysqli_num_rows($result) > 0 )
                                        {
                                            
                                            while($row = mysqli_fetch_array($result))
                                            {
                                                if(isset($_SESSION['rmanager']))
                                                {
                                                        if($_SESSION['rmanager']==$row['ID'])
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
                        <div class="col-md-2">
                            <div class="form-group">
                            <label>Year</label>
                            <select class="form-control form-control-sm select2" id="hyear" style="width: 100%;" onchange="SetRFilter(this.id,this.value)">
                                     
                                    <?php
                                            include '../Inc/DBcon.php';
                                            $sql2="select * from year where status='1'";
                                            $result=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result) > 0 )
                                            {
                                                
                                                while($row = mysqli_fetch_array($result))
                                                {
                                                    if(isset($_SESSION['hyear']))
                                                    {
                                                            if($_SESSION['hyear']==$row['ID'])
                                                            {
                                                                echo '<option value="'.$row['year'].'" selected>'.$row['year'].'</option>';
                                                            }
                                                            else
                                                            {
                                                                echo '<option value="'.$row['year'].'">'.$row['year'].'</option>';
                                                            }
                                                    }else
                                                    {
                                                        echo '<option value="'.$row['year'].'">'.$row['year'].'</option>';
                                                    }
                                                    
                                                }
                                            }
                                            mysqli_close($conn);
                                        ?>

                            </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm btn-block " style="margin-top: 31px;" onclick="ClearRFilter()"><i class="fa fa-trash" ></i> Clear</button>
                        </div>
                    </div>
                </div>

        </div>
        <div id="resourcing-list">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Project Resourcing for All Weeks</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body"  >
                 
                <div class="row">
                  <div class="col-md-12">
                  <table class="table table-bordered table-hover text-center d-none"   >
                    <thead>
                    <tr>
                    <th  style="width: 0px !important;"> </th>
                    <th data-orderable="false" style="position: relative;" >Action</th>
                    <th>Code</th>
                    <th data-orderable="false">Name</th>
                    <th data-orderable="false" class="d-none" style="position:sticky;">Name</th>
                    <th class="rotated" data-orderable="false">Country</th>
                    <th class="rotated" data-orderable="false">Remaining<br>Hours</th>
                    <th class="rotated" data-orderable="false">Hours to Minus</th>
                    <th class="rotated" data-orderable="false">Budget<br>Hours</th>
                    <th class="rotated" data-orderable="false">Resource</th>
                    <?php 
                    include '../script/functions.php';
                    $weeks=getWeeks(date('Y'));
                        foreach($weeks as $week)
                        {
                            echo '<th class="rotated" data-orderable="false"> '.$week.' </th>';
                        }
                    ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        include '../Inc/DBcon.php';
                        
                        $sql2="select * from projects";
                        $result=mysqli_query($conn,$sql2);
                        if(mysqli_num_rows($result) > 0 )
                        {
                            $i=1;
                            while($row = mysqli_fetch_array($result))
                            {
                                $country=getCountry($row['country_id']);
                                $resource=countResource($row['ID']);
                                $hours=gethours($row['ID']);
                                $res=$resource>0?'rowspan="'.($resource+1).'':'';
                                $res2=$resource>0?'<td></td>':'';
                                $budgthour=getbudgetHours($row['ID']);
                                $remaining=$hours-($budgthour+(int)$row['minus_hours']);
                                echo '<tr>
                                            <td   style="vertical-align: middle; " class="bg-green" > </td>
                                            <td  class="bg-green">
                                                <a href="javascript:void(0)" onclick="ResourceForm('.$row['ID'].')"  data-toggle="modal" data-target="#modal-new-resource"> <i class="nav-icon fas fa-edit text-white"></i></a> &nbsp;
                                            </td>
                                            <td class="bg-green font-weight-bold">'.$row['code'].'</td>
                                            <td class="bg-green font-weight-bold d-none">'.$row['name'].'</td>
                                            <td class="bg-green font-weight-bold">'.$row['name'].'</td>
                                            <td class="bg-green font-weight-bold">'.$country['tag'].'</td>
                                            <td class="bg-green font-weight-bold">'.$remaining.' </td>
                                            <td class="week  font-weight-bold" onclick="MinusHours('.$row['ID'].')" data-toggle="modal" data-target="#minus-model">'.$row['minus_hours'].'</td>
                                            <td class="bg-green font-weight-bold">'.$budgthour.'</td>
                                            <td class="font-weight-bold" class="bg-green"> '.$resource.' </td>
                                            ';
                                                $weeks=getWeeks(date('Y'));
                                                foreach($weeks as $week)
                                                {   
                                                   
                                                    if(getResourceStageWeek($row['ID'],$week)!="")
                                                    {
                                                        $stage=getResourceStageWeek($row['ID'],$week);
                                                        $stageN=getStage($stage);
                                                        echo '<td class="stage" id="'.$row['ID'].'_'.$week.'" onclick="StageForm(this.id)" data-toggle="modal" data-target="#stage-model" style="background-color:'.$stageN['color'].'">'.$stageN['short_name'].'</td>';

                                                    }
                                                    else
                                                    {
                                                        echo '<td class="stage" id="'.$row['ID'].'_'.$week.'" onclick="StageForm(this.id)" data-toggle="modal" data-target="#stage-model"></td>';

                                                    }
                                                }
                                            echo'</tr>';
                                
                                            $sql2="select * from project_resource where pid='".$row['ID']."';";
                                            $result2=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result2) > 0 )
                                            {
                                                
                                                while($row2 = mysqli_fetch_array($result2))
                                                {
                                                    $res=getManager($row2['staff_id']);
                                                    $staffHours=getStaffHours($row['ID'],$row2['staff_id']);
                                                    echo '<tr>
                                                    <td ></td>
                                                    <td ></td>
                                                    <td >'.$row['code'].' </td>
                                                    <td class="bg-green font-weight-bold d-none">'.$row['name'].'</td>
                                                    <td ><small>Resource</small> </td>
                                                    <td > </td>
                                                    <td > </td>
                                                    <td > </td>
                                                    <td >'.$staffHours.'</td>
                                                    <td > '.$res['nick_name'].' </td>';
                                                    $weeks=getWeeks(date('Y'));
                                                    foreach($weeks as $week)
                                                    {
                                                        $wheekHours=getResourceWeek($row['ID'],$res['ID'],$week);
                                                        echo '<td class="week font-weight-bold" id="'.$row['ID'].'_'.$res['ID'].'_'.$week.'" onclick="ShowM(this.id,'.$res['ID'].','.$row['ID'].')" data-toggle="modal" data-target="#hors-model">'.$wheekHours.'</td>';
                                                    }
                                                    echo'</tr>';
                                                }
                                                
                                            }
                                            
                                ;
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
                
                <!-- /.card-body -->
            </div> 
        </div>
        
       

    </section>
    <!-- /.content -->
   
  </div>
  <!-- /.content-wrapper -->
            
    <script>
    function FilterSearch(value)
    {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    }
    function PrintDiv()
        {
            var restorepage = $('body').html();
            var printcontent = $('#rtable').clone();
            $('body').empty().html(printcontent);
            window.print();
            window.location.href = "project-resource.php";
        }
</script>         
  <?php include '../Inc/footer.php';?>
  <script src="../Inc/project-resource-history.js"></script>
 
</body>
</html>
