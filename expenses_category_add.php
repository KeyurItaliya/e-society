<?php 
session_start();
error_reporting(E_ERROR | E_PARSE); 
include('include/config.php'); 
if(!isset($_SESSION['aid'])){
  header('Location:login.php');
  exit;
}
$get_id = $_GET['id'];
  $name ='Add';
  if($get_id){
    $name="Edit";
    $query = getSpecificRecords($db, 'expenses_category', 'id', $get_id);
      foreach($query as $d){
        $category_id = $d['id'];
        $category_name = $d['category_name'];
        $category_image = $d['category_image'];
        $date = $d['date'];
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
        <h1 class="h3 mb-2 text-gray-800">Money Category <?php echo $name; ?></h1>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Category Form</h6>
        </div>
        <div class="card-body">
          <form id="expenses_category_add" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="inputAddress">title</label>
              <input type="text" name="category_name" value="<?php echo $category_name; ?>" class="form-control" id="category_name">
            </div>
            <div class="form-group">
              <label for="inputAddress2">Category Image</label>
              <div>
              <input type="file" name="category_image" value="<?php echo $category_image ?>" id="category_image" onchange="showImage1.call(this)">
               
              </div>
              <script>
              function showImage1(){
                if(this.files && this.files[0]){
                  var obj = new FileReader();
                  obj.onload = function(data){
                  var image = document.getElementById("image1");
                  image.src = data.target.result;
                  image.style.display = "block";
                  }
                obj.readAsDataURL(this.files[0]);
                }
              }
            </script>
            <div class="mb-3 mt-2">
              <img style="width:100px;" alt="Display Image" src="images/<?php  echo $category_image; ?>" id="image2">
            </div>
            </div>
            <div class="form-group">
              <label>Date</label>
              <input type="date" name="date" value="<?php echo $date; ?>" class="form-control" id="date">
              <input type="hidden" name="category_hiddne_image" value="<?php echo $category_image ?>" >
              <input type="hidden" name="submit_type" value="<?php echo $name ?>" >
              <input type="hidden" name="category_id" value="<?php echo $category_id ?>" >
                
            </div>
            </div>
            <div class="row">
              <button type="submit" class="ml-4 mb-2 btn btn-primary">Category <?php echo $name; ?></button>
            </div>
          </form>
        </div>
      </div>  
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <script src="js/script.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
