<?php
include '../include/config.php';
foreach($_POST as $var=>$valu){$$var = $valu;}
    if(empty($description) || empty($money)){
        $response['success']=false;
        $response['error']="<span class='text-danger'>The request is not done</span>";
        echo json_encode($response);
        exit;
    }
$submit_type = $_POST['submit_type'];
$money_id = $_POST['money_id'];

if($submit_type == 'Add'){
    $qur = "INSERT INTO `money` SET 
        `description` = '$description',
        `money_type` = '$money_type',
        `moneys` = '$money',
        `category_id` = '$inputState',
        `date` = '$date'
        ";
    $quer = mysqli_query($db, $qur);
}else {
    $qur = "UPDATE `money` SET 
        `description` = '$description',
        `money_type` = '$money_type',
        `moneys` = '$money',
        `category_id` = '$inputState',
        `date` = '$date'
        WHERE `id` = '$money_id'
        ";
    $quer = mysqli_query($db, $qur);
}
if($quer == true){
    $response['success']=true;
    $response['message']="<span class='text-success'>The request is done</span>.";
    echo json_encode($response);
    exit;
}else{
    $response['success']=false;
    $response['error']="<span class='text-danger'>The request is not done</span>";
    echo json_encode($response);
    exit;
}
echo json_encode($response);    
?>