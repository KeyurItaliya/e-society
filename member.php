<?php 
// error_reporting(E_ERROR | E_PARSE);
session_start(); 
include('include/config.php'); 
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
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
      <h1 class="h3 mb-2 text-gray-800">Member</h1>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Member Form</h6>
      </div>
      <div class="card-body">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Address</th>
                <th>Operation</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $data_get = getAllRecords($db, 'member');
              foreach($data_get as $data){
              ?>
              <tr>
                <td><?php echo $data['user_name']; ?></td>
                <td><?php echo $data['email']; ?></td>
                <td><?php echo $data['user_phone_no']; ?></td>
                <td><?php echo $data['user_address']; ?></td>
                <td>  
                  <a href="member_add.php?id=<?php echo $data['id'];?>" class="product_update_id" > <i class="fas fa-pen-alt"></i></a>         
                  <a href="process/money_delete.php?identication=member&id=<?php echo $data['id']; ?>"><i class="far fa-trash-alt"></i></a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          
          <div class="col-xs-8 center-block" style="text-align:center;">
            <button type="button" class="btn ">
              <a href="member_add.php" class="btn btn-success btn-icon-split">
                  <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                  </span>
                  <span class="text">Add Member</span>
              </a>
            </button>
          </div>
      </div>
    </div>  
  </div>
  </div>
</div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
