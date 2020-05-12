<?php 
session_start();
error_reporting(E_ERROR | E_PARSE); 

if(!isset($_SESSION['aid'])){
  header('Location:login.php');
  exit;
}

include('include/config.php'); 
$get_id = $_GET['id'];
  $name ='Add';
  if($get_id){
    $name="Edit";
    $query = getSpecificRecords($db, 'notice', 'id', $get_id);
      foreach($query as $d){
        $notice_id = $d['id'];
        $notice_title = $d['notice_title'];
        $date = $d['date'];
        $notice_description = $d['notice_description'];
        $status_type = $d['status'];
      }
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
  <style>
    table{
      text-align: center;   
    }
  </style>

</head>

  <body id="page-top">
  <!-- Page Wrapper -->
<div id="wrapper">
    <?php include('include/side_header.php'); ?>
  <div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Notice <?php echo $name; ?></h1>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Notice Form</h6>
      </div>
        <div class="card-body">
          <span class="message_success"></span>
          <form id="notice_add" method="POST">
            <div class="form-group">
              <div class="form-group">
                <label for="inputAddress">title</label>
                <input type="text" class="form-control" name="notice_title" value="<?php echo $notice_title; ?>" id="description">
              </div>
              <div class="form-group">
                  <label for="inputAddress2">Notice description</label>
                  <textarea name="notice_description" class="form-control" id="expense_out" ><?php echo $notice_description; ?></textarea>
              </div>
              <div class="form-group">
                  <label>Date</label>
                  <input type="date" name= "date" id="date" value="<?php echo $date; ?>" class="form-control datepicker">
                  <input type="hidden" name="notice_id" value="<?php echo $notice_id; ?>">
                  <input type="hidden" name="submit_type" value="<?php echo $name; ?>">
              </div>
            </div>
            <button type="submit" name="submit" value="submit" class="ml-1 btn btn-primary">Notice <?php echo $name; ?></button>
        </form>
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
