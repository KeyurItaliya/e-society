<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">E-Society</sup></div>
  </a>
  <hr class="sidebar-divider my-0">

  <?php if(isset($_SESSION['sid'])){ ?>
    <li class="nav-item">
      <a class="nav-link" href="gate_security.php">
      <i class="fas fa-users"></i>
      <span>Security Guard</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="notice_board.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Notice</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="complain.php">
        <i class="fas fa-question"></i>
        <span>complain</span></a>
    </li>
  <?php } 
   if(isset($_SESSION['aid']) || isset($_SESSION['uid'])){ ?>
    <li class="nav-item active">
      <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Admin Interface
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseUtilities" >
        <i class="fas fa-dollar-sign"></i>
        <span>Money Manager</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Society spend:</h6>
          <a class="collapse-item" href="expenses.php">Money</a>
          <a class="collapse-item" href="expenses_category.php">Money category</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="notice_board.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Notice</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="complain.php">
        <i class="fas fa-question"></i>
        <span>complain</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="help.php">
        <i class="fab fa-hire-a-helper"></i>
        <span>Help</span></a>
    </li>
  <?php } 
  if(isset($_SESSION['aid'])){ ?>
    <li class="nav-item">
      <a class="nav-link" href="member.php">
      <i class="fas fa-users"></i>
      <span>Member</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="admin.php" >
        <i class="fas fa-fw fa-cog"></i>
        <span>Admin Setting</span>
      </a>
    </li>
  <?php } ?>
<!-- Nav Item - Utilities Collapse Menu -->

<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
      <div class="input-group">
        <?php if(isset($_SESSION['uid'])){ echo $_SESSION['user_email']; }else { echo ' '; } ?>
      </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

      <!-- Nav Item - Search Dropdown (Visible Only XS) -->
      <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
          <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Nav Item - Alerts -->
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" title="Alert" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <!-- Counter - Alerts -->
          <span class="badge badge-danger badge-counter">1+</span>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
          <h6 class="dropdown-header">
            Alerts Center
          </h6>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-primary">
                <i class="fas fa-file-alt text-white"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500">December 12, 2019</div>
              <span class="font-weight-bold">A new monthly report is ready to download!</span>
            </div>
          </a>
          
          <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
        </div>
      </li>

      <!-- Nav Item - Messages -->
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" title="Messages" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <!-- Counter - Messages -->
          <span class="badge badge-danger badge-counter">1</span>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
          <h6 class="dropdown-header">
            Message Center
          </h6>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="dropdown-list-image mr-3">
              <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
              <div class="status-indicator bg-success"></div>
            </div>
            <div class="font-weight-bold">
              <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
              <div class="small text-gray-500">Emily Fowler · 58m</div>
            </div>
          </a>
          
          <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
        </div>
      </li>

      <div class="topbar-divider d-none d-sm-block"></div>

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small" title="User name"><?php if(isset($_SESSION["user_name"])){ echo $_SESSION["user_name"];}else if(isset($_SESSION["admin_name"])){ echo $_SESSION["admin_name"]; } ?></span>
          <img class="img-profile rounded-circle" title="Profile Image" src="images/colors-1596915_960_720.webp">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="text-dark dropdown-item" href="process/logout.php">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>
        </div>
      </li>

    </ul>

  </nav>