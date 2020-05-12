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
    $query = getSpecificRecords($db, 'money', 'id', $get_id);
    foreach($query as $d){
      $money_id = $d['id'];
      $types = $d['money_type'];
      $description = $d['description'];
      $money = $d['moneys'];
      $category_id = $d['category_id'];
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
    .text-giant { font-size:30px; }
  </style>

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php include('include/side_header.php'); ?>
    <div class="container-fluid">
      <h1 class="h3 mb-2 text-gray-800">Money Record <?php echo $name; ?></h1>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Money Form</h6>
        </div>
        <div class="card-body">
          <span class="message_success"></span>
          <form id="expenses_add" method="POST">
            <div class="row form-group">
              <div class="col-md-4 col-sm-3">
                <select class="form-control" name="money_type" value="<?php echo $types; ?>" >
                  <option value="income">Income</option>
                  <option value="expenses">Expenses</option>
                </select>
               </div> 
            </div>  
            <div class="form-group">
              <label for="inputAddress">Description</label>
              <textarea class="form-control" name="description"  id="description"><?php echo $description; ?></textarea>
              <input type="hidden" name="submit_type" value="<?php echo $name; ?>">
              <input type="hidden" name="money_id" value="<?php echo $money_id; ?>">
            </div>
            <div class="form-group">
              <label for="inputAddress2">Money</label>
              <input type="text" autocomplete="off" value="<?php echo $money; ?>" class="form-control" id="expense_out" >
            </div>
            <div class="text-right text-giant total"></div>
            <input type="hidden" name="money" id="total2" />
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputCity">Category</label>
                <select id="inputState" name="inputState" class="form-control">
                  <?php
                    $result = "SELECT * FROM `expenses_category` WHERE 1";
                    $qur = mysqli_query($db,$result);
                    while($data = mysqli_fetch_assoc($qur)){
                      $row = $data['category_name'];
                      $category_id = $data['id'];
                  ?>
                  <option value="<?php echo $category_id; ?>">
                      <?php  echo $row;  ?>
                  </option>
                  <?php 
                    }
                  ?>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label>Date</label>
                <input type="date" name="date" value="<?php echo $date; ?>" id="date" class="form-control datepicker">
              </div>
            </div>
            <button type="submit" class="ml-1 btn btn-primary"><?php echo $name; ?> Expenses</button>
          </form>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script>
    //grab every thing we need
    
    const money = document.querySelector('#expense_out');
    const totalShow = document.querySelector('.total');
    const totalsend = document.querySelector('#total2'); 
    //create function we will need
    
    function findPlus(){
      var total= 0; 
      s = money.value;
      var s= s.match(/[+\-]*(\.\d+|\d+(\.\d+)?)/g) || [];
        while(s.length){
            total+= parseFloat(s.shift());
        }
        
        totalShow.innerText = total;
        totalsend.value = total;
        // return total;  
      }
      findPlus();
      money.addEventListener('input', findPlus);
      // function calculatePriceCost(){
      // const priceInput = [];
      
      // priceInput.push(priceInputValue);
      // const str = priceInput.toString();
      // const arraySplit = str.split('');

      // const x = findPlus(priceInputValue);
      // console.log(x);
      // const y = arraySplit.indexOf(x);
      // console.log(arraySplit);
      // total.innerText = '$' + priceInput.toFixed(2);
      // }
      //on first run
      // calculatePriceCost();
      //add our event listeners
    
  </script>
</body>
</html>
