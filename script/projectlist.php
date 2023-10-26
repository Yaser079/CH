<?php session_start(); include 'functions.php'; ?>
<div class="card secondary" style="min-height:100%;">
            <div class="card-header">
              <h3 class="card-title ">Projects List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
            <div class="table-responsive">
              <table id="example1" class="table table-head-fixed table-bordered table-hover text-center" style="font-size: 14px;">
              
                <thead>
                <tr>
                  <th colspan="9"></th>
                  
                  <?php
                    include '../Inc/DBcon.php';
                    $sql2="select * from project_phase";
                    $result=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result) > 0 )
                    {
                        
                        while($row = mysqli_fetch_array($result))
                        {
                            echo ' <th  colspan="2" style="background-color:'.$row['color'].'">'.$row['short_name'].'</th>';
                             
                             
                        }
                    }
                    mysqli_close($conn);
                ?>
              </tr>
                <tr>
                  <th >ID</th>
                  <th >Action</th>
                  <th>Project Number</th>
                  <th >Project Name</th>
                  <th>PM</th>
                  <th class="rotated">Country</th>
                  <th class="rotated">Hours</th>
                  <th class="rotated">%Profit</th>
                  <th class="rotated">AVG Rate</th>
                  <?php
                    include '../Inc/DBcon.php';
                    $sql2="select * from project_phase";
                    $result=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result) > 0 )
                    {
                        
                        while($row = mysqli_fetch_array($result))
                        {
                            echo ' <th  class="rotated"> Hours</th>';
                            echo ' <th  class="rotated">Budget</th>';
                             
                        }
                    }
                    mysqli_close($conn);
                ?>
                </tr>
                </thead>
                <tbody>
                <?php
                    include '../Inc/DBcon.php';
                    $filter="";
                     if(isset($_SESSION['filter']))
                     {
                       
                        if( isset($_SESSION['foffice']) && $_SESSION['foffice']!='all')
                        {
                          $filter.=" AND office_id='".$_SESSION['foffice']."' ";
                        }
                        if( isset($_SESSION['fregion']) && $_SESSION['fregion']!='all')
                        {
                          $filter.="AND country_id='".$_SESSION['fregion']."' ";
                        }
                        if( isset($_SESSION['fstatus']) && $_SESSION['fstatus']!='all')
                        {
                          $filter.="AND status='".$_SESSION['fstatus']."' ";
                        }
                        if( isset($_SESSION['fstage']) && $_SESSION['fstage']!='all')
                        {
                          $filter.="AND stage='".$_SESSION['fstage']."' ";
                        }
                     }
                    $sql2="select * from projects where 1=1 ".$filter." ;";
                    $result2=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result) > 0 )
                    {
                        $i=1;
                        while($row2 = mysqli_fetch_array($result2))
                        {
                            $pm=getManager($row2['manager_id']);
                            $country=getCountry($row2['country_id']);
                            $hours=gethours($row2['ID']);
                            $status=getStatus($row2['status']);
                            echo'<tr style="background-color:'.$status['color'].'">
                                    <td>'.$i.'</td>
                                    <td>
                                    <a href="javascript:void(0)"   onclick="getproject('.$row2['ID'].')" data-toggle="modal" data-target="#modal-lg-edit"> <i class="nav-icon fas fa-edit text-secondary"></i></a> &nbsp;
                                    <a href="javascript:void(0)"   onclick="deleteProject('.$row2['ID'].')"><i class="nav-icon fas fa-trash text-danger"></i> </a> 
                                    </td>
                                    <td>'.$row2['code'].'</td>
                                    <td >'.$row2['name'].'</td>
                                    <td>'.$pm['nick_name'].'</td>
                                    <td style="background-color:'.$country['color'].'">'.$country['tag'].'</td>
                                    <td>'.$hours.'</td>
                                    <td>'.$row2['profit'].'%</td>
                                    <td class="font-weight-bold">'.$row2['avg_rate'].'</td>
                                  ';
                                  $sql2="select * from project_phase";
                                    $result3=mysqli_query($conn,$sql2);
                                    if(mysqli_num_rows($result3) > 0 )
                                    {
                                        
                                        while($row3 = mysqli_fetch_array($result3))
                                        {
                                            $phase=getPhase($row2['ID'],$row3['ID']);
                                            if($phase!=0)
                                            {
                                                echo ' <td class="font-weight-bold">'.$phase['hours'].'</td>';
                                                echo ' <td class="font-weight-bold">$'.number_format($phase['budget'],2).'</td>';
                                            }
                                            else
                                            {
                                                echo ' <td class="font-weight-bold"> </td>';
                                                echo ' <td class="font-weight-bold"> </td>';
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
            
            <!-- /.card-body -->
            </div>  