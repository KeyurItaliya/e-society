<?php 
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

  <title>Cozastore Admin</title>

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
  <div id="wrapper">
    <?php include('include/side_header.php'); ?>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Admin</h1>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Admin DataTables</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-data2">
            <thead>
              <tr>
                <th>Admin Id</th>
                <th>Admin Name</th>
                <th>Admin password</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $tour_facility = getAllRecords($db, 'admin');
                if($tour_facility){
                foreach($tour_facility as $data){
                ?>
                  <tr class="tr-shadow">
                    <td> <span><?php echo $data['id']; ?></span></td>
                    <td> <span><?php echo $data['admin_name']; ?></span></td>
                    <td> <span class="block-email"><?php echo $data['admin_password']; ?></span></td>
                  </tr>
                <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
    
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
