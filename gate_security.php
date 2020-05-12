<?php 
// error_reporting(E_ERROR | E_PARSE);
session_start(); 
include('include/config.php'); 
if(!isset($_SESSION['sid'])){
    header("Location: index.php");

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

  <title>Tour Admin</title>

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheets">


</head>

<body id="page-top">
  <div id="wrapper">
    <?php include('include/side_header.php'); ?>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Security Guard</h1>
      <div class="row">
        <div class="col-md-6">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Guest Form</h6>
            </div>
            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                  <label for="inputEmail4">Entrance Name</label>
                  <input type="text" class="form-control" id="houseaddress" placeholder="FirstName/LastName">
                </div>
                <div class="form-group">
                  <label for="inputEmail4">Entrance Img</label>
                  <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <div class="form-group">
                  <label for="inputEmail4">House Address</label>
                  <input type="text" class="form-control" id="houseaddress" placeholder="1, abc">
                </div>
                <div class="form-group">
                  <label for="inputEmail4">Email To</label>
                  <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                </div>
                
              <button type="submit" class="btn btn-primary">Send Mail</button>
            </form> 
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Member Form</h6>
          </div>
          <div class="card-body">
            <form id="find_tokan" method="POST">
              <span class="message_success"></span>
              <div class="form-group">
                <label for="inputEmail4">Token</label>
                <input type="text" class="form-control" name="token" id="token" placeholder="xxxx xxxx">
              </div>
              <button type="submit" name="submit" class="center-block btn btn-primary">Find</button>
            </form> 
          <div>
        </div>
      <div>
    </div>
  </div>

  <div id="member_info" tabindex="-1" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content program-details row pl-3 pr-3">
                <div class="pt-0">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="col-12 sec-title mb-0">
                    <h2>User Details</h2>
                    <div class="separator"></div>
                </div>
                <div class="modal-body text-center">				
                  <div id="useer_data">
                  </div>
                </div>
            </div>
        </div>
    </div>


  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
