<?php
include '../include/config.php';
foreach($_POST as $var=>$valu){$$var = $valu;}

$member_image = $_FILES['member_image']['name'];

if( empty($user_name) || empty($email) || empty($mobile_no)){
    $response['success']=false;
    $response['message']="<span class='text-danger'>The request is not done</span>";
    echo json_encode($response);
    exit;
}
if(!empty($member_image)){
    $newfile = rand(1, 1000). '_' .$member_image;
    if(!move_uploaded_file($_FILES['member_image']['tmp_name'], '../member_images/'.$newfile)){
        $response['success']=false;
        $response['message']="<span class='text-danger'>File Uploads faild</span>";
        echo json_encode($response);
        exit;
    }
    if(!empty($member_hiddne_image)){
    unlink('../member_images/'.$member_hiddne_image);
    }
}else{
    $newfile = $member_hiddne_image; 
}

$submit_type = $_POST['submit_type'];

$email_get = getNumberOfValue($db, 'member', 'email', $email);

$get_password = getPassword();

$user_id = $_POST['user_id'];
if($submit_type == 'Add'){
    if($email_get >= 1){
        $response['success']=false;
        $response['message']="<span class='text-danger'>The request email allrady exit</span>";
        echo json_encode($response);
        exit;
    }
    $qur = "INSERT INTO `member` SET 
        `user_name` = '$user_name',
        `email` = '$email',
        `member_image` = '$newfile',
        `password` = '$get_password',
        `user_address` = '$user_address',
        `old_user_address` = '$old_user_address',
        `adhar_no` = '$adhar_no',
        `user_phone_no` = '$mobile_no',
        `gender` = '$gender'
        ";
    $quer = mysqli_query($db, $qur);
}else {
    $qur = "UPDATE `member` SET 
        `user_name` = '$user_name',
        `email` = '$email',
        `member_image` = '$newfile',
        `user_address` = '$user_address',
        `old_user_address` = '$old_user_address',
        `adhar_no` = '$adhar_no',
        `user_phone_no` = '$mobile_no',
        `gender` = '$gender'
        WHERE `id` = '$user_id'
        ";
    $quers = mysqli_query($db, $qur);
    if($quers == true){
        $response['success']=true;
        $response['message']="<span class='text-success'>The request is done</span>.";
        echo json_encode($response);
        exit;
    }else{
        $response['success']=false;
        $response['message']="<span class='text-danger'>The Mail request is not done</span>";
        echo json_encode($response);
        exit;
    }
}
if($quer == true){
    $varification_link = "http://localhost/e-society/login.php";
    $emailsend = sendAccVerificationEmail($email,$varification_link,$get_password);
    if($emailsend){
    $response['success']=true;
    $response['message']="<span class='text-success'>The request is done</span>.";
    echo json_encode($response);
    exit;
    }else{
        $response['success']=false;
        $response['message']="<span class='text-danger'>The Mail request is not done</span>";
        echo json_encode($response);
        exit;
    }
}else{
    $response['success']=false;
    $response['message']="<span class='text-danger'>The request is not done</span>";
    echo json_encode($response);
    exit;
}
echo json_encode($response);    
?>