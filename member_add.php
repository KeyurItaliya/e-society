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
    $query = getSpecificRecords($db, 'member', 'id', $get_id);
      foreach($query as $d){
        $user_id = $d['id'];
        $user_name = $d['user_name'];
        $email = $d['email'];
        $mobile_no = $d['user_phone_no'];
        $user_address = $d['user_address'];
        $member_image = $d['member_image'];
        $old_user_address = $d['old_user_address'];
        $adhar_no = $d['adhar_no'];
        $start_date = $d['start_date'];
        $gender_type = $d['gender'];
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
        <h1 class="h3 mb-2 text-gray-800">Member <?php echo $name; ?></h1>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Add Member Form</h6>
        </div>
        <div class="card-body">
          <span class="message_success"></span>
          <form id="member_add" method="POST" enctype="multipart/form-data">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputEmail4">Your Name</label>
                <input type="text" name="user_name" value="<?php echo $user_name; ?>" class="form-control" id="user_name">
              </div>
              <div class="form-group col-md-4">
                <label for="inputPassword4">Emial Address</label>
                <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="xyz@gmail.com" id="email" >
              </div>
              <div class="form-group col-md-4">
                <label for="inputPassword4">Mobile Number</label>
                <input type="mobile_no" name="mobile_no" value="<?php echo $mobile_no; ?>" class="form-control" id="mobile_no" >
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputAddress">Address</label>
                <textarea name="user_address" class="form-control" id="user_address" placeholder="1234 Main St"><?php echo $user_address; ?></textarea>
              </div>
              <div class="form-group col-md-6">
                <label for="inputAddress">Old Address</label>
                <textarea name="old_user_address" class="form-control" id="old_user_address" placeholder="1123 Main st"><?php echo $old_user_address; ?> </textarea>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputAddress2">Member Image</label>
                  <input type="file" name="member_image" value="<?php echo $member_image ?>" id="memeber_image" onchange="showImage1.call(this)">
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
              </div>
              <div class="form-group col-md-4">
                  <label for="inputAddress">Adhar No</label>
                  <input type="text" name="adhar_no" value="<?php echo $adhar_no; ?>" class="form-control" id="adhar_no" placeholder="xxxx xxxx xxxx">    
                  <input type="hidden" name="member_hiddne_image" value="<?php echo $member_image ?>" >
                  <input type="hidden" name="submit_type" value="<?php echo $name; ?>">
                  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
              </div>
              <div class="form-group col-md-4">
                <label for="inputZip">Gender</label><br>
                  <input type="radio" name="gender" value="male"  <?php if ($gender_type == 'male') echo 'checked="checked"'; ?> >male
                  <input type="radio" name="gender" value="female"  <?php if ($gender_type == 'female') echo 'checked="checked"'; ?> >female
              </div>
            <div>
            <button type="submit" name="submit" class="mt-1 btn btn-primary">Member <?php echo $name; ?></button>
          </form>
        </div>
      </div>  
    </div>
  </div>
<!-- Modal -->
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
