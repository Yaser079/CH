<?php
include '../Inc/DBcon.php';
$sql2="select * from users where ID='".$_GET['id']."';";
$result=mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_array($result);
mysqli_close($conn);
?>
<div class="row">
<div class="col-md-4">
        <div class="form-group">
            <label for="exampleInputEmail1">Full Name</label>
            <input type="text" class="form-control" id="exampleInputName2" placeholder="Enter name" value="<?=$row2['name']?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email" value="<?=$row2['email']?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="text" class="form-control" id="exampleInputPassword2" placeholder="Password" value="<?=$row2['password']?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="exampleInputPhone1">Phone</label>
            <input type="text" class="form-control" id="exampleInputPhone2" placeholder="Phone" value="<?=$row2['phone']?>">
            <input type="hidden" id="id" value="<?=$row2['ID']?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <label>Country</label>
        <select class="form-control select2" id="country2" style="width: 100%;" required>
            
            <?php
                include '../Inc/DBcon.php';
                $sql2="select * from country";
                $result=mysqli_query($conn,$sql2);
                if(mysqli_num_rows($result) > 0 )
                {
                    
                    while($row = mysqli_fetch_array($result))
                    {
                        if($row2['country']==$row['ID'])
                        {
                            echo '<option value="'.$row['ID'].'" selected>'.$row['name'].'</option>';
                        }
                        else
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
        
</div>