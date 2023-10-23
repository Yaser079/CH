<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
     
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-clock"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
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
      
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>