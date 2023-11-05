<div class="table-responsive">
                            <table id="example1" class="table table-bordered text-center ">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Nick Name</th>
                                    <th>Office</th>
                                    <th>Role</th>
                                    <th>Job Title</th>
                                    <th>Skills</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    
                                    include '../Inc/DBcon.php';
                                    include 'functions.php';
                                    $sql2="select * from staff;";
                                    $result=mysqli_query($conn,$sql2);
                                    if(mysqli_num_rows($result) > 0 )
                                    {
                                        $i=1;
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            $office=getOffice($row['office']);
                                            $role=getRole($row['role_id']);
                                            echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$row['name'].'</td>
                                            <td>'.$row['nick_name'].'</td>
                                            <td>'.$office['code'].'</td>
                                            <td>'.$role['name'].'</td>
                                            <td>';
                                            $sql2="select * from staff_job where staff_id='".$row['ID']."'";
                                            $result2=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result2) > 0 )
                                            {
                                                while($row2 = mysqli_fetch_array($result2))
                                                {       
                                                    $job=getJob($row2['job_id']);
                                                    echo '<span class="badge badge-secondary fs-1">'.$job['name'].' 
                                                            </span>&nbsp;';    
                                                }
                                            }
                                            echo ' </td>
                                            <td>';
                                            $sql2="select * from staff_skill where staff_id='".$row['ID']."'";
                                            $result2=mysqli_query($conn,$sql2);
                                            if(mysqli_num_rows($result2) > 0 )
                                            {
                                                while($row2 = mysqli_fetch_array($result2))
                                                {       
                                                    $skil=getSkill($row2['skill_id']);
                                                    echo '<span class="badge badge-secondary fs-1">'.$skil['name'].' 
                                                            </span>&nbsp;';    
                                                }
                                            }
                                            echo '</td>
                                            <td> 
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" '.($row['status']==1?'checked':'').' id="customSwitchS'.$row['ID'].'" onclick="StaffStatus(this.id,'.$row['ID'].')">
                                                 <label class="custom-control-label" id="customSwitchC'.$row['ID'].'l" for="customSwitchS'.$row['ID'].'"></label>
                                                </div>
                                            </td>
                                            <td> 
                                            <a href="javascript:void(0)"  onclick="LoadStaffForm('.$row['ID'].')" data-toggle="modal" data-target="#modal-staff"> <i class="nav-icon fas fa-edit text-secondary"></i></a> &nbsp;
                                            <a href="javascript:void(0)"   onclick="deleteStaff('.$row['ID'].')"><i class="nav-icon fas fa-trash text-danger"></i> </a> 
                                        
                                            </td>
                                        </tr>';
                                        $i++;
                                          
                                        }
                                    }
                                    mysqli_close($conn);
                                ?>
                                
                                
                            
                                </tbody>
                                
                            </table>
                        </div>