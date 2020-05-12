<?php
session_start();
include('include/config.php');

if(isset($_SESSION['aid'])){
  unset($_SESSION['uid']);
  unset($_SESSION['sid']);
}else if(isset($_SESSION['uid'])){
  unset($_SESSION['aid']);
  unset($_SESSION['sid']);
}else if(isset($_SESSION['sid'])){
  unset($_SESSION['aid']);
  unset($_SESSION['uid']);
  header("Location: gate_security.php");
}  
else{
  header("Location: login.php");
}

$totalmember = getTotalRecords($db,'member', 'status', 'Y');

$total_income = getSumOfSingleColumn($db, 'money', 'moneys', 'money_type', 'income');

$expenses_show = getSumOfSingleColumn($db, 'money', 'moneys', 'money_type', 'expenses');

$total_notice = getTotalNumber($db, 'notice');

$total_complain = getTotalNumber($db, 'complain');

$total_balance = $total_income - $expenses_show;

$total_percent = ($expenses_show*100)/$total_income;

$final_percent = 100-$total_percent;
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Society Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <style>
    #style_show{
      width: <?php echo $final_percent . '%'; ?>;
    }
  </style>
</head>

<body id="page-top">
  <div id="wrapper">
  <?php include('include/side_header.php'); ?>
    <div class="container-fluid">

          <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
      </div>

          <!-- Content Row -->
      <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <a href="member.php">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Member</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalmember; ?></div>
                  </div>
                  <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
                  </div>
                </div>
                </a>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total  complain</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_complain; ?></div>
                  </div>
                  <div class="col-auto">
                      <i class="fas fa-question fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

                      <!-- Pending Requests Card Example -->
          <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <a href="notice_board.php">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Notice</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_notice; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>

            <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Income</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_income; ?></div>
                  </div>
                  <div class="col-auto">
                    <i title="Income" class="fas fa-piggy-bank fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

            <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Expenses</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $expenses_show; ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Balance</div>
                    <div class="row no-gutters align-items-center">
                      <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $total_balance; ?></div>
                      </div>
                      <div class="col">
                        <div class="progress progress-sm mr-2">
                          <div class="progress-bar bg-info" role="progressbar" id="style_show" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-donate fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
  </div>
  
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
