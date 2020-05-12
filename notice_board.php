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

  <title>Notice Admin</title>

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
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Notice Board</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
      </div>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Title</th>
                  <th>Description</th>
                  <?php if(isset($_SESSION['aid'])){ ?><th>Operation</th> <?php } ?>
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
                  <?php if(isset($_SESSION['aid'])){ ?>
                  <td>  
                    <a href="notice_add.php?id=<?php echo $data['id'];?>" class="product_update_id" > <i class="fas fa-pen-alt"></i></a>         
                    <a href="process/money_delete.php?identication=notice_board&id=<?php echo $data['id']; ?>"><i class="far fa-trash-alt"></i></a>
                  </td>
                </tr>
                  
                <?php } } ?>
              </tbody>
            </table>
            <?php if(isset($_SESSION['aid'])){ ?>
            <div class="col-xs-8 center-block" style="text-align:center;">
              <button type="button" class="btn ">
                <a href="notice_add.php" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add Notice</span>
                </a>
              </button>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>  
    </div>
  </div>
  
  <div class="mr-5">
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-end">
        <li class="page-item "><a class="page-link" href="#" tabindex><</a> </li>
        <?php echo $pagLink.'</ul>' ;  ?>
        <li class="page-item"><a class="page-link" href="#" tabindex>></a></li>
      </ul>
    </nav>
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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>
</body>
</html>
