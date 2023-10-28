<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Select Stage</label>
            <select class="form-control select2" id="prstage" style="width: 100%;" >
            <option value="">Select Stage</option>
                <?php
                        include '../Inc/DBcon.php';
                        include '../script/functions.php';
                        $stage='';
                        $rswid='';
                        $stg=0;
                        if(getWeekStage($_GET['id'],$_GET['week'])!="")
                        {
                            $stage=getWeekStage($_GET['id'],$_GET['week']);
                            $rswid=$stage['ID'];
                            $stg=$stage['stage_id'];
                        }
                        $sql2="select * from project_phase;";
                        $result=mysqli_query($conn,$sql2);
                        if(mysqli_num_rows($result) > 0 )
                        {
                            
                            while($row = mysqli_fetch_array($result))
                            {
                                if($stg==$row['ID'])
                                {
                                    echo '<option value="'.$row['ID'].'" selected>'.$row['short_name'].'</option>';

                                }
                                else
                                {
                                    echo '<option value="'.$row['ID'].'" >'.$row['short_name'].'</option>';
                                }
                                
                            }
                        }
                        mysqli_close($conn);

                    ?>
            </select>
            <input type="hidden" id="sproject" value="<?=$_GET['id'];?>">
            <input type="hidden" id="sweek" value="<?=$_GET['week'];?>">
        </div>
    </div>
    <?php
    if($rswid>0)
    {
        echo '<div class="col-md-12">
        <a href="javascript:void(0)" onclick="ClearStage('.$rswid.')">Remove Stage<i class="nav-icon fas fa-trash text-danger"></i></a>
    </div>';
    }
    ?>

    
</div>