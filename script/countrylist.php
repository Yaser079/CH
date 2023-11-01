<div class="table-responsive">
                            <table id="example1" class="table table-bordered text-center country-list">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Tag</th>
                                    <th>Color</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    include '../Inc/DBcon.php';
                                    $sql2="select * from country;";
                                    $result=mysqli_query($conn,$sql2);
                                    if(mysqli_num_rows($result) > 0 )
                                    {
                                        $i=1;
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$row['name'].'</td>
                                            <td>'.$row['tag'].'</td>
                                            <td><div style="background-color: '.$row['color'].'; height:20px; width: 50px; margin:auto; border-radius:5px; border: 1px solid grey;"> </div></td>
                                            <td> 
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" '.($row['status']==1?'checked':'').' id="customSwitchC'.$row['ID'].'" onclick="ColorStatus(this.id,'.$row['ID'].')">
                                                 <label class="custom-control-label" id="customSwitchC'.$row['ID'].'l" for="customSwitchC'.$row['ID'].'"></label>
                                                </div>
                                            </td>
                                            <td> 
                                            <a href="javascript:void(0)"  onclick="LoadCountryForm('.$row['ID'].')" data-toggle="modal" data-target="#modal-country"> <i class="nav-icon fas fa-edit text-secondary"></i></a> &nbsp;
                                            <a href="javascript:void(0)"   onclick="deleteCountry('.$row['ID'].')"><i class="nav-icon fas fa-trash text-danger"></i> </a> 
                                        
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