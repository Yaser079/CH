<div class="row">
                    <div class="col-md-4 border border-1 p-2 m-1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Project Resource</label>
                            <select class="form-control select2" id="resource" style="width: 100%;" >
                            <option value="">Select Resource</option>
                                <?php
                                        include '../Inc/DBcon.php';
                                        include '../script/functions.php';
                                        $sql2="select * from staff;";
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
                        </div>
                        <input type="hidden" id="project_id" value="<?=$_GET['id']?>">
                        <button type="button" class="btn btn-primary float-right" onclick="AddResource()">Add Resource</button>
                    </div>
                    <div class="col-md-5 border border-1 p-2 m-1">
                    <label for="exampleInputEmail1">Remove Resource from project</label><br>
                        <div class="d-flex flex-wrap">
                            <?php
                                include '../Inc/DBcon.php';
                                $sql2="select * from project_resource where pid='".$_GET['id']."';";
                                $result=mysqli_query($conn,$sql2);
                                if(mysqli_num_rows($result) > 0 )
                                {
                                    
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        $res=getManager($row['staff_id']);
                                            echo '<span class=" border border-1 rounded m-1 pl-2 pr-2 pt-1 pb-1 mb-1" style="font-size: 20px;"> '.$res['nick_name'].' &nbsp; &nbsp; <a href="javascript:void(0)" id="'.$res['nick_name'].'" onclick="deleteResource('.$row['ID'].',this.id,'.$_GET['id'].','.$res['ID'].')"><i class="nav-icon fas fa-trash text-danger"></i></a>
                                                </span>';
                                    }
                                }
                                mysqli_close($conn);
                            ?>
                        </div>
                    
                    </div>
                    
                </div>