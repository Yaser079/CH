<div class="row">
    <?php
    include 'functions.php';
    include '../Inc/DBcon.php';
    $sql2="select * from office;";
    $result=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result) > 0 )
    {
        $i=1;
        while($row = mysqli_fetch_array($result))
        {
            $numbers=getOfficeStaff($row['ID']);
            echo '<div class="col-6 col-lg-2 ">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="far fa-building"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">'.$row['code'].'</span>
                    <span class="info-box-number">'.$numbers.'</span>
                </div>
            </div>
        </div>';
        }
    }
    ?>

</div>
<h5 class="mb-2">Staff Count per Skill</h5>
<div class="row">
    <?php
        
        include '../Inc/DBcon.php';
        $sql2="select * from skill;";
        $result=mysqli_query($conn,$sql2);
        if(mysqli_num_rows($result) > 0 )
        {
            $i=1;
            while($row = mysqli_fetch_array($result))
            {
                $numbers=getCountSkillStaff($row['ID']);
                echo '<div class="col-6 col-lg-2 ">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary"><i class="fab fa-dev"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">'.$row['name'].'</span>
                        <span class="info-box-number">'.$numbers.'</span>
                    </div>
                </div>
            </div>';
            }
        }
        ?>
    </div>