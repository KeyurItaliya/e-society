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
</head>

<body id="page-top">
  <div id="wrapper">
  <?php include('include/side_header.php'); ?>
    <div class="container-fluid">

          <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Complain Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
      </div>

          <!-- Content Row -->
        <?php if(isset($_SESSION['uid']) || isset($_SESSION['sid'])){ ?>
        <div class="card-body shadow mx-auto" style="width: 450px">
            <form metho="POST">
                <h4><b>Complain</b></h4>
                <div class="form-group">
                    <label for="inputEmail4">Name</label>
                    <input type="email" class="form-control" id="inputEmail4" value="<?php if(isset($_SESSION['uid'])){ echo $_SESSION['user_name']; }else { echo $_SESSION['guard_name']; } ?>" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="inputAddress">Email Id</label>
                    <input type="email" class="form-control" id="inputAddress" value="<?php if(isset($_SESSION['uid'])){ echo $_SESSION['user_email']; }else { echo $_SESSION['guard_email']; } ?>" placeholder="1234 Main St">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">complain</label>
                    <textarea class="form-control" placeholder="Write here ......"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mx-auto">Complaint send</button>
            </form>
        </div>
        <?php } else{?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $limit =6;
                        $result_db = mysqli_query($db, "SELECT COUNT(*) FROM notice"); 
                        $row_db = mysqli_fetch_array($result_db)[0];  
                        $total_pages = ceil($row_db / $limit); 
                        $pagLink = "<ul class='pagination'>";  
                            for ($i=1; $i<=$total_pages; $i++) {
                            $pagLink .= "<li class='page-item'><a class='page-link' href='notice_board.php?id=".$i."'>".$i."</a></li>";	
                            }
                            
                            if (isset($_GET['id'])) {
                                $pageno = $_GET['id'];
                            } else {
                                $pageno = 1;
                            }
                        $offset = ($pageno-1) * $limit;
                        $sql = "SELECT * FROM `notice`ORDER BY id ASC LIMIT $offset, $limit";
                        $qur = mysqli_query($db, $sql);
                        while($data = mysqli_fetch_assoc($qur)){

                        // $data_get = getAllRecords($db, 'notice');
                        // foreach($data_get as $data){
                        ?>
                        <tr>
                        <td><?php echo $data['date']; ?></td>
                        <td><?php echo $data['notice_title']; ?></td>
                        <td><?php echo $data['notice_description']; ?></td>
                        
                        </tr>
                        
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
     </div>     
</div>
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
