
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="javascript:void(0)" class="nav-link">Welcome back! <?= $_SESSION['name']?></a>
      </li>
     
    </ul>

    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item ">
        <a class="nav-link" href="javascript:void(0)">Week <?= $_SESSION['current-week']?></a>
      </li>
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" onclick="activty()">
          <i class='fas'>&#xf1da;</i>
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="logs">
        <?php
                 include 'DBcon.php';
                $sql2="  (select *,users.name as name from logs inner join users on users.ID=logs.uid order by logs.ID desc limit 5);";
                $result=mysqli_query($conn,$sql2);
                if(mysqli_num_rows($result) > 0 )
                {
                     
                    while($row = mysqli_fetch_array($result))
                    {
                        echo '<a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                           
                          <div class="media-body">
                            <h3 class="dropdown-item-title"><b> '.$row['name'].' </b></h3>
                            <p class="text-sm">'.$row['action'].'</p>
                            <small class="text-sm text-muted"><i class="far fa-clock mr-1"></i>'.$row['created_at'].'</small>
                          </div>
                        </div>
                        <!-- Message End -->
                      </a>
                      <div class="dropdown-divider"></div>';
                    }
                }
                mysqli_close($conn);
            ?>
          
          <a href="#" class="dropdown-item dropdown-footer">See All Logs</a>
        </div>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right " style="left: inherit; right: 0px;">
            <div class="dropdown-divider"></div>
            <?php
                 include 'DBcon.php';
                $sql2="  (select * from logs order by ID desc limit 5) ORDER BY ID ASC;;";
                $result=mysqli_query($conn,$sql2);
                if(mysqli_num_rows($result) > 0 )
                {
                     
                    while($row = mysqli_fetch_array($result))
                    {
                       
                        echo ' <a href="#" class="dropdown-item">
                        <i class="fas fa-user mr-1"></i>'.$row['action'].'
                        <span class="float-right text-muted text-sm">'.$row['created_at'].'</span>
                        </a>';
                    }
                }
                mysqli_close($conn);
            ?>
           
            
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Logs</a>
            </div>
       </li>
      
       
    </ul>
  </nav>