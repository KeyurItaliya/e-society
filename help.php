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
            <h1 class="h3 mb-0 text-gray-800">Contect Detail</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>

          <!-- Content Row -->
        <div class="row">
            <div class="col-xl-4 col-sm-6 col-md-6 mb-4">
                <div class="card text-center shadow">
                    <div class="card-header bg-primary text-white">
                        Electrician
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Name : Jon lovata</h5>
                        <p class="card-text">Address : 8, Samvare, Nr.BOM, surat, Gujarat</p>
                        <a href="#" ><i class="fas fa-phone-square-alt fa-2x text-success" onclick="CallModal()" title="call"></i></a>
                        <a href="#" ><i class="ml-3 fas fa-comment-dots fa-2x text-success" onclick="messageModal()" title="message"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-md-6 mb-4">
                <div class="card text-center shadow">
                    <div class="card-header bg-dark text-white">
                        Plumber
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Name : Sureshbhai dava</h5>
                        <p class="card-text">Address : 32, podar plaza, Nr.railway sation, surat, Gujarat </p>
                        <a href="#" ><i class="fas fa-phone-square-alt fa-2x text-success" onclick="CallModal()" title="call"></i></a>
                        <a href="#" ><i class="ml-3 fas fa-comment-dots fa-2x text-success" onclick="messageModal()" title="message"></i></a>
                    </div>
                </div>
            </div> 
                        <!-- Pending Requests Card Example -->
            <div class="col-xl-4 col-sm-6 col-md-6 mb-4">
                <div class="card text-center shadow">
                    <div class="card-header bg-success text-white">
                        Peon
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Name : Jon lovata</h5>
                        <p class="card-text">Address : 8, Samvare, Nr.BOM, surat, Gujarat</p>
                        <a href="#" ><i class="fas fa-phone-square-alt fa-2x text-success" onclick="CallModal()" title="call"></i></a>
                        <a href="#" ><i class="ml-3 fas fa-comment-dots fa-2x text-success" onclick="messageModal()" title="message"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card text-center shadow">
                    <div class="card-header bg-info text-white">
                        Security Guard
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Name : Sureshbhai dava</h5>
                        <p class="card-text">Address : 32, podar plaza, Nr.railway sation, surat, Gujarat</p>
                        <a href="#" ><i class="fas fa-phone-square-alt fa-2x text-success" onclick="CallModal()" title="call"></i></a>
                        <a href="#" ><i class="ml-3 fas fa-comment-dots fa-2x text-success" onclick="messageModal()" title="message"></i></a>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card text-center shadow">
                    <div class="card-header bg-warning text-white">
                        Manager
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Name : Jon lovata</h5>
                        <p class="card-text">Address : 32, podar plaza, Nr.railway sation, surat, Gujarat</p>
                        <a href="#" ><i class="fas fa-phone-square-alt fa-2x text-success" onclick="CallModal()" title="call"></i></a>
                        <a href="#" ><i class="ml-3 fas fa-comment-dots fa-2x text-success" onclick="messageModal()" title="message"></i></a>
                    </div>
                </div>
            </div>
                <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card text-center shadow">
                    <div class="card-header bg-secondary text-white">
                        Water Supply
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Name : Sureshbhai dava</h5>
                        <p class="card-text">Address : 32, podar plaza, Nr.railway sation, surat, Gujarat</p>
                        <a href="#" ><i class="fas fa-phone-square-alt fa-2x text-success" onclick="CallModal()" title="call"></i></a>
                        <a href="#" ><i class="ml-3 fas fa-comment-dots fa-2x text-success" onclick="messageModal()" title="message"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
      <!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
    <div class="copyright text-center my-auto">
        <span>Copyright &copy; Your Website 2019</span>
    </div>
    </div>
</footer>
  
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<!-- modal message  -->
    <div id="forgot-password" tabindex="-1" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content program-details row pl-3 pr-3">
                <div class="pt-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="col-12 sec-title mb-0">
                    <h2>Message send</h2>
                    <div class="separator"></div>
                </div>
				
                <div class="modal-body text-center">
					
                    <form id="reset_password">
						<div>
                            <textarea class="form-control" name="message" placeholder="Write here ......"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 mb-3">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- #call-Number -->
    <div id="call-Number" tabindex="-1" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content program-details row pl-3 pr-3">
                <div class="pt-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form>
                <div class="col-12 sec-title mb-0">
                    <h2>Call</h2>
                    <div class="separator"></div>
                </div>
				
                <div class="modal-body text-center">
					<h3> Number : 8160203064</h3>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-3 mb-3">Copy</button>
                </div>
                </form>
            </div>
        </div>
    </div>
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

  <script >
    function messageModal(){
        $('#forgot-password').modal('show');
    }
    
    function CallModal(){
        $('#call-Number').modal('show');
    }
  </script>

</body>

</html>
