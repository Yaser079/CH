<div class="card">
            <div class="card-header">
              <h3 class="card-title">Users List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Country</th>
                  <th>Status</th>
                  <th>Super Admin</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    include '../Inc/DBcon.php';
                    $sql2="select users.ID as ID,users.name as name,users.email as email, users.phone as phone,  users.status as status, users.users as users, country.name as country from users inner join country on country.ID = users.country";
                    $result=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result) > 0 )
                    {
                        
                        while($row = mysqli_fetch_array($result))
                        {
                        
                            echo '<tr>
                                    <td>'.$row['ID'].'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['email'].'</td>
                                    <td>'.$row['phone'].'</td>
                                    <td>'.$row['country'].'</td>
                                    <td> 
                                         
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" '.($row['status']==1?'checked':'').' id="customSwitch'.$row['ID'].'" onclick="status(this.id,'.$row['ID'].')">
                                            <label class="custom-control-label" id="customSwitch'.$row['ID'].'l" for="customSwitch'.$row['ID'].'">'.($row['status']==1?'On':'Off').'</label>
                                        </div>
                                        
                                    </td>
                                    <td>
                                         
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" '.($row['users']==1?'checked':'').' id="customSwitchU'.$row['ID'].'" onclick="superAdmin(this.id,'.$row['ID'].')">
                                            <label class="custom-control-label" id="customSwitchU'.$row['ID'].'l" for="customSwitchU'.$row['ID'].'">'.($row['users']==1?'Yes':'No').'</label>
                                        </div>
                                        
                                    </td>
                                    <td>
                                    <a href="javascript:void(0)" onclick="getUser('.$row['ID'].')" data-toggle="modal" data-target="#modal-lg"> <i class="nav-icon fas fa-edit text-secondary"></i></a> &nbsp;
                                    <a href="javascript:void(0)" onclick="deleteUser('.$row['ID'].')"><i class="nav-icon fas fa-trash text-danger"></i> </a> 
                                    </td>
                                </tr>';
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