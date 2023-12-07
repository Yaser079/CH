<?php session_start(); include 'functions.php'; ?>
<div class="card secondary" style="min-height:100%;">
<div class="card-header">
                <div class="d-flex justify-content-between">
                <h3 class="card-title d-flex align-self-center ">Projects List</h3>
                  <div class="d-flex justify-content-end align-self-center">
                    <input id="myInput" onkeyup="FilterSearch()" type="text" class="form-control form-control-sm d-flex align-self-center mr-2" style="width: 200px;" placeholder="Search..">
                    <button class="btn btn-secondary btn-sm mt-2 mb-2 mr-2" onclick="PrintDiv()">Print</button>
                    <button class="btn btn-primary btn-sm mt-2 mb-2" data-toggle="modal" data-target="#modal-avg">AVG Rate Calculator</button>
                  </div>
                </div>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
            <div class="table-responsive1">
              <table id="plist" class="table table-bordered table-hover text-center" style="font-size: 12px;">
              
                <thead>
                <tr>
                  <th class="stiky">ID</th>
                  <th class=" stiky">Action</th>
                  <th class="  stiky">Code</th>
                  <th class="text-left stiky">Project Name</th>
                  <th class=" stiky">PM</th>
                  <th class="  stiky">Status</th>
                  <th class="  stiky"><div class="rotated">Country</div></th>
                  <th class="  stiky"><div class="rotated">Hours</div></th>
                  <th class="  stiky"><div class="rotated">%Profit</div></th>
                  <th class=" stiky "><div class="rotated">AVG Rate</div></th>
                  <th class="  "><div class="rotated">Current Stage</div></th>
                  <th class="  "><div class="rotated">Deadline Week</div></th>
                  <?php
                    include '../Inc/DBcon.php';
                    $sql2="select * from project_phase";
                    $result=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result) > 0 )
                    {
                        
                        while($row = mysqli_fetch_array($result))
                        {
                         // echo ' <th  colspan="2" style="background-color:'.$row['color'].'">'.$row['short_name'].'</th>';
                            echo ' <th  style="background-color:'.$row['color'].'"  ><div class="rotated">'.$row['short_name'].' Hours</div></th>';
                            echo ' <th   style="background-color:'.$row['color'].'" ><div class="rotated">'.$row['short_name'].' Budget</div></th>';
                             
                        }
                    }
                    mysqli_close($conn);
                ?>
                </tr>
                </thead>
                <tbody id="myTable">
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
                        if( isset($_SESSION['fmanager']) && $_SESSION['fmanager']!='all')
                        {
                          $filter.="AND manager_id='".$_SESSION['fmanager']."' ";
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
                            $stage1=getStage($row2['stage']);
                            echo'<tr style="background-color: ">
                                    <td class="stiky">'.$i.'</td>
                                    <td class=" stiky">
                                    <a href="javascript:void(0)"   onclick="getproject('.$row2['ID'].')" data-toggle="modal" data-target="#modal-lg-edit"> <i class="nav-icon fas fa-edit text-secondary"></i></a> &nbsp;
                                    <a href="javascript:void(0)"   onclick="deleteProject('.$row2['ID'].')"><i class="nav-icon fas fa-trash text-danger"></i> </a> 
                                    </td>
                                    <td class="  stiky">'.$row2['code'].'</td>
                                    <td class=" stiky  text-left "><p style="width:170px !important; margin:0px;font-size:11px;font-weight:bold;">'.$row2['name'].'</p></td>
                                    <td class=" stiky">'.$pm['nick_name'].'</td>
                                    <td class=" stiky" style="font-size:10px;font-weight:bold;">'.$status['name'].'</td>
                                    <td class=" stiky" style="background-color:'.$country['color'].'">'.$country['tag'].'</td>
                                    <td class=" stiky">'.$hours.'</td>
                                    <td class=" stiky"> '.$row2['profit'].'%</td>
                                    <td class=" stiky" >'.$row2['avg_rate'].'</td>
                                    
                                    <td class=" " style="background-color:'.$stage1['color'].'">'.$stage1['short_name'].'</td>
                                    <td class=" " >'.$row2['deadline'].'</td> 
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