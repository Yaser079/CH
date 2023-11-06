<?php session_start(); include 'functions.php'; ?>
<div class="card">
    <div class="card-header">
    <h3 class="card-title">Project Resourcing for All Weeks</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <div class="table-responsive">
    <table id="example1" class="table table-bordered table-hover text-center">
        <thead>
        <tr>
        <th> </th>
        <th>Action</th>
        <th>Code</th>
        <th>Name</th>
        <th class="rotated">Country</th>
        <th class="rotated">Remaining<br>Hours</th>
        <th class="rotated">Hours to Minus</th>
        <th class="rotated">Budget<br>Hours</th>
        <th class="rotated">Resource</th>
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
            $filter="";
            if(isset($_SESSION['Rfilter']))
            {
            
                if( isset($_SESSION['roffice']) && $_SESSION['roffice']!='all')
                {
                    $filter.=" AND office_id='".$_SESSION['roffice']."' ";
                }
                if( isset($_SESSION['rregion']) && $_SESSION['rregion']!='all')
                {
                    $filter.="AND country_id='".$_SESSION['rregion']."' ";
                }
                
                if( isset($_SESSION['rmanager']) && $_SESSION['rmanager']!='all')
                {
                    $filter.="AND manager_id='".$_SESSION['rmanager']."' ";
                }
            
            }
        $sql2="select * from projects where 1=1 ".$filter." ;";
             
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
                    <td   style="vertical-align: middle;" class="bg-green"> </td>
                    <td  class="bg-green">
                        <a href="javascript:void(0)" onclick="ResourceForm('.$row['ID'].')"  data-toggle="modal" data-target="#modal-new-resource"> <i class="nav-icon fas fa-edit text-white"></i></a> &nbsp;
                    </td>
                    <td class="bg-green font-weight-bold">'.$row['code'].'</td>
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

                                        }                                    }
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
                                        <td  >'.$row['code'].' </td>
                                        <td  ><small>Resource</small> </td>
                                        <td  > </td>
                                        <td  > </td>
                                        <td  > </td>
                                        <td >'.$staffHours.'</td>
                                        <td  > '.$res['nick_name'].' </td>';
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
    
    <!-- /.card-body -->
</div> 