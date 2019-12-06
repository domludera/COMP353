<?php
error_reporting(E_ALL);

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['user']) && $_SESSION["user"]) {
    $id = $_SESSION['user'];
    require_once(ROOT . 'Models/Mail.php');
    require_once(ROOT . 'Models/User.php');
    $mails = new Mail();
    $user = new User();
    $results["mail"] = Mail::resultToArray($mails->findAll($id));
    $this->set($results);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Share Contribute & Comment System</title><!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link href="/Bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" /><!-- Custom styles for this template-->
  <link href="/Bootstrap/css/sb-admin-2.min.css" rel="stylesheet" />

  <!-- Js Files -->
  <!-- Bootstrap core JavaScript-->
  <script src="/Bootstrap/vendor/jquery/jquery.min.js"></script> 
  <script src="/Bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> <!-- Core plugin JavaScript-->
   
  <script src="/Bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script> <!-- Custom scripts for all pages-->
   
  <script src="/Bootstrap/js/sb-admin-2.min.js"></script> <!-- Page level plugins -->
   
  <script src="/Bootstrap/vendor/datatables/jquery.dataTables.min.js"></script> 
  <script src="/Bootstrap/vendor/datatables/dataTables.bootstrap4.min.js"></script> <!-- Page level custom scripts -->
   
  <script src="/Bootstrap/js/demo/datatables-demo.js"></script>

</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!--IF SIGNED IN NAV SIDE BAR-->
      <?php if (isset($_SESSION['user']) && $_SESSION["user"]) : ?><!-- Sidebar - Brand -->
       <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home/home">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">
        <?=User::resultToArray($user->find($id))[0]["name"] ?>
      </div></a><!-- Divider -->
      <hr class="sidebar-divider my-0" />
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" style="text-align:center" href="/home/home">Home</a>
      </li><!-- Divider -->
      <hr class="sidebar-divider" />
      <!-- Heading -->
      <div class="sidebar-heading" style="text-align:center">
        Dashboard
      </div>
	  <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"><i class="fas fa-fw fa-star"></i> <span>Events</span></a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">My Events:</h6>
            <a class="collapse-item" href="/events">Active</a>
            <a class="collapse-item" href="/events/attending">Attending</a>
            <a class="collapse-item" href="/events/managing">Managing</a>
          </div>
        </div>
      </li>
	  <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="/groups"><i class="fas fa-fw fa-users"></i> <span>Groups</span></a>
      </li>
    
	  <!--IF SYSTEM ADMIN-->
    <?php if($user->isAdmin($id)) : ?>
      <!-- Divider -->
      <hr class="sidebar-divider" />
      <!-- Heading -->
      <div class="sidebar-heading" style="text-align:center">
        Admin
      </div>
	  <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="/events"><i class="fas fa-fw fa-cog"></i> <span>Configuration</span></a>
      </li>
	  <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTo" aria-expanded="true" aria-controls="collapseTo"><i class="fas fa-fw fa-cog"></i> <span>Events</span></a>
        <div id="collapseTo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Select:</h6><a class="collapse-item" href="/events/create">Create</a> <a class="collapse-item" href="/events/edit">Edit</a>
          </div>
        </div>
      </li>
	  <!--END IF SYSTEM ADMIN-->
    <?php endif; ?>
	  <!--END IF Logged in-->
    <?php endif; ?>
	  <!--IF NOT SIGNED IN NAV SIDE BAR-->
      <?php if (!isset($_SESSION['user']) || !$_SESSION["user"]) : ?><!-- Sidebar - Brand -->
       <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3" style="text-align:center">
        Welcome!
      </div></a>
      <hr class="sidebar-divider my-0" />
      <div class="sidebar-heading"></div>
	  <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"><span>Description of project details goes here.</span></a> <?php endif; ?> <!-- Divider -->
        <hr class="sidebar-divider my-0" />
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </li>
    </ul>
	<!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
           <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button> <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
              <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search fa-sm"></i></button>
              </div>
            </div>
          </form>
		  <!--IF SIGNED IN NAV TOP BAR-->
          <?php if (isset($_SESSION['user']) && $_SESSION["user"]) : ?><!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-search fa-fw"></i></a> <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button"><i class="fas fa-search fa-sm"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
			<!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell fa-fw"></i> <!-- Counter - Alerts -->
               <span class="badge badge-danger badge-counter"><?= count($results["mail"]); ?>
              </span></a> 
			  <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">Alerts Center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle bg-primary">
                    <i class="fas fa-file-alt text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">
                    December 12, 2019
                  </div><span class="font-weight-bold">Event1 date has been changed!</span>
                </div></a> <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle bg-success">
                    <i class="fas fa-donate text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">
                    December 7, 2019
                  </div>You have been invited to join Group2
                </div></a> <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle bg-warning">
                    <i class="fas fa-exclamation-triangle text-white"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">
                    December 2, 2019
                  </div>Event3: PersonX has shared a photo!
                </div></a> <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>
			<!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-envelope fa-fw"></i> <!-- Counter - Messages --> <span class="badge badge-danger badge-counter"><?= count($results["mail"]); ?>
              </span></a> 
			  <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">Mail Center</h6><a class="dropdown-item d-flex align-items-center" href="/mails/show/4">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="" />
                  <div class="status-indicator bg-success"></div>
                </div>
                <div class="font-weight-bold">
                  <div class="text-truncate"></div>
                  <div class="small text-gray-500">
                    PersonY · 58m
                  </div>
                </div></a> <a class="dropdown-item text-center small text-gray-500" href="/mails">Read More Messages</a>
              </div>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
			<!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="mr-2 d-none d-lg-inline text-gray-600 small">
              <?=User::resultToArray($user->find($id))[0]["name"] ?>
              </span> <img class="img-profile rounded-circle" src="/Bootstrap/img/Portrait_Placeholder.png" /></a> <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/users/self"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile</a> <a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Settings</a> <a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> Activity Log</a>
                <div class="dropdown-divider"></div><a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout</a>
              </div>
            </li>
          </ul><?php endif; ?>
		  <!--IF NOT SIGNED IN NAV TOP BAR-->
          <?php if (!isset($_SESSION['user']) || !$_SESSION["user"]) : ?><!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-search fa-fw"></i></a> <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button"><i class="fas fa-search fa-sm"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
			<!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell fa-fw"></i> <!-- Counter - Alerts -->
               <span class="badge badge-danger badge-counter"></span></a> <!-- Nav Item - Messages -->
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-envelope fa-fw"></i> <!-- Counter - Messages -->
               <span class="badge badge-danger badge-counter"></span></a>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div><!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="mr-2 d-none d-lg-inline text-gray-600 small"></span> <img class="img-profile rounded-circle" src="/Bootstrap/img/Portrait_Placeholder.png" /></a>
            </li>
          </ul><?php endif; ?>
        </nav>
		<!-- End of Topbar -->
        <!-- Begin Page Content -->
        <main role="main" class="container">
          <div class="container-fluid">
            <?php
				echo $content_for_layout;
			?>
          </div>
        </main>
      </div>
	  <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Comp 353 - Fall 2019</span>
          </div>
        </div>
      </footer>
	  <!-- End of Footer -->
    </div>
	<!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
   <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a> <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          Select "Logout" below if you are ready to end your current session.
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> <a class="btn btn-primary" href="/auth/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
