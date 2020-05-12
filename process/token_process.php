<?php
include '../include/config.php';
$token = $_POST['token'];
    if(empty($token)){
        $response['success']=false;
        $response['error']="<span class='text-danger'>The request is not done</span>";
        echo json_encode($response);
        exit;
    }

    $qur = "SELECT * FROM `member` WHERE `token` = '$token' ";
    $quer = mysqli_query($db, $qur);
    $number = mysqli_num_rows($quer);
    if($number > 0){
    $data = mysqli_fetch_assoc($quer);
    ob_start(); ?>
        <div class="table-responsive">  
           <table class="table table-bordered"> 
                <tr>  
                     <td width="30%"><label>Name</label></td>  
                     <td width="70%"><img style="height:140px;" src='./member_images/<?php echo $data["member_image"]; ?>' alt='usere_img' /></td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Address</label></td>  
                     <td width="70%"><?php echo $data["email"]; ?></td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Gender</label></td>  
                     <td width="70%"><?php echo $data["name"]; ?></td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Designation</label></td>  
                     <td width="70%"><?php echo $data["name"]; ?></td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Age</label></td>  
                     <td width="70%"><?php echo $data["name"]; ?></td>  
                </tr>  
            </table></div>
            <?php
        $response['html'] = ob_get_clean();
        $response['success']=true;
        $response['message']="<span class='text-success'>Token is Found</span>.";
        echo json_encode($response);
        exit;
    }else{
        $response['success']=false;
        $response['message']="<span class='text-danger'>Token is Not Found</span>";
        echo json_encode($response);
        exit;
    }
echo json_encode($response);    
?>