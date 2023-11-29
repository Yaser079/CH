 <aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link navbar-primary">
      <img src="../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text text-white font-weight-light"><?= $_SESSION['site']?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar "  >
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/<?=$_SESSION['picture'];?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile.php" class="d-block"><?=$_SESSION['name']?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2" >
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <?php if($_SESSION['role']==1){ ?>
          <li class="nav-item ">
            <a href="index.php" class="nav-link <?= $_SESSION['nav']=='dashboard'? 'active': '';?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php } if($_SESSION['role']==1){ ?>
          <li class="nav-item ">
            <a href="project-list.php" class="nav-link <?= $_SESSION['nav']=='project-list'? 'active': '';?>">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Project List
              </p>
            </a>
          </li>
          <?php } if($_SESSION['role']==1){ ?>
          <li class="nav-item ">
            <a href="project-resource.php" class="nav-link <?= $_SESSION['nav']=='project-resource'? 'active': '';?>"> 
              <i class="nav-icon fas fa-users"></i>
              <p>
                Project Resourcing
              </p>
            </a>
          </li>
          <?php } if($_SESSION['role']>=1){ ?>
          <li class="nav-item ">
            <a href="weekly-resource.php" class="nav-link <?= $_SESSION['nav']=='weekly'? 'active': '';?>"> 
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
               Weekly Resource v1
              </p>
            </a>
          </li>
          <?php } if($_SESSION['role']>=1){ ?>
          <li class="nav-item ">
            <a href="weekly-resource2.php" class="nav-link <?= $_SESSION['nav']=='weekly2'? 'active': '';?>"> 
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
               Weekly Resource v2
              </p>
            </a>
          </li>
          <?php } if($_SESSION['role']>=1){ ?>
          <li class="nav-item ">
            <a href="resource-workload.php" class="nav-link <?= $_SESSION['nav']=='workload'? 'active': '';?>"> 
              <i class="nav-icon fas fa-user-clock"></i>
              <p>
              Resource Workload
              </p>
            </a>
          </li>
          <?php } if($_SESSION['role']>=1){ ?>
          <li class="nav-item ">
            <a href="holiday.php" class="nav-link <?= $_SESSION['nav']=='holiday'? 'active': '';?>"> 
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
               Staff Annual Leave
              </p>
            </a>
          </li>
          <?php } if($_SESSION['role']==1){ ?>
          <li class="nav-item ">
            <a href="resource.php" class="nav-link <?= $_SESSION['nav']=='resource'? 'active': '';?>"> 
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Resource List
              </p>
            </a>
          </li>
          <?php } if($_SESSION['role']==1){ ?>
          <li class="nav-item ">
            <a href="support-dashboard.php" class="nav-link <?= $_SESSION['nav']=='support'? 'active': '';?>"> 
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Support Dashboard
              </p>
            </a>
          </li>
          <?php } if($_SESSION['role']==1){ ?>
          <li class="nav-item ">
            <a href="support-admin.php" class="nav-link <?= $_SESSION['nav']=='support-admin'? 'active': '';?>"> 
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Support Admin
              </p>
            </a>
          </li>
          <?php } if($_SESSION['role']==1){ ?>
          <li class="nav-header">SOFTWARE MANAGEMENT</li>
          <li class="nav-item ">
            <a href="location.php" class="nav-link <?= $_SESSION['nav']=='location'? 'active': '';?>">
              <i class="nav-icon fas">&#xf5a0;</i>
              <p>
                Country & Office
              </p>
            </a>
          </li>
          <?php } if($_SESSION['role']==1){ ?>
          <li class="nav-item ">
            <a href="phase.php" class="nav-link <?= $_SESSION['nav']=='phase'? 'active': '';?>">
              <i class="nav-icon fa">&#xf085;</i>
              <p>
                Phase & Status
              </p>
            </a>
          </li>
          <?php } if($_SESSION['role']==1){ ?>
          <li class="nav-item ">
            <a href="role.php" class="nav-link <?= $_SESSION['nav']=='role'? 'active': '';?>">
              <i class="nav-icon fa">&#xf4fe;</i>
              <p>
                Role & Job Title
              </p>
            </a>
          </li>
          <?php } if($_SESSION['role']==1){ ?>
          <li class="nav-item ">
            <a href="skill.php" class="nav-link <?= $_SESSION['nav']=='skill'? 'active': '';?>">
              <i class="nav-icon fa">&#xf7d9;</i>
              <p>
                Skills
              </p>
            </a>
          </li>
          <?php } if($_SESSION['role']==1){ ?>
          <li class="nav-item ">
            <a href="admin-holiday.php" class="nav-link <?= $_SESSION['nav']=='admin-holiday'? 'active': '';?>"> 
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Admin Holiday
              </p>
            </a>
          </li>  
          <?php
               }
            if($_SESSION['admin']==1)
            {
              ?>
              <li class="nav-header">USERS</li>
              <li class="nav-item">
                  <a href="users.php" class="nav-link <?= $_SESSION['nav']=='users'? 'active': '';?>">
                    <i class="nav-icon far fa-user"></i>
                    <p>Users</p>
                  </a>
              </li>
              
              <li class="nav-header">SITE</li>
              <li class="nav-item">
                <a href="site.php" class="nav-link <?= $_SESSION['nav']=='site'? 'active': '';?>">
                  <i class="nav-icon fa">&#xf085;</i>
                  <p>Setting</p>
                </a>
              </li>
              <?php  } ?>
          
          <li class="nav-header">PERSONAL</li>   
          <li class="nav-item ">
            <a href="logs.php" class="nav-link <?= $_SESSION['nav']=='logs'? 'active': '';?>">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Logs
              </p>
            </a>
          </li>        
          <li class="nav-item">
            <a href="../script/logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
               <p>Logout</p>
            </a>
          </li>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>