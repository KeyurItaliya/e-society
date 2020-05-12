<?php
include '../include/config.php';
foreach($_POST as $var=>$valu){$$var = $valu;}
if(empty($notice_title) || empty($notice_description) || empty($date)){
    $response['success']=false;
    $response['message']="<span class='text-danger'>The request is not done</span>";
    echo json_encode($response);
    exit;
}
$submit_type = $_POST['submit_type'];
$notice_id = $_POST['notice_id'];
if($submit_type == 'Add'){
    $qur = "INSERT INTO `notice` SET 
        `notice_title` = '$notice_title',
        `notice_description` = '$notice_description',
        `date` = '$date'
        ";
    $quer = mysqli_query($db, $qur);
}else {
    $qur = "UPDATE `notice` SET 
        `notice_title` = '$notice_title',
        `notice_description` = '$notice_description',
        `date` = '$date'
        WHERE `id` = '$notice_id'
        ";
    $quer = mysqli_query($db, $qur);
}
if($quer == true){
    $emailId = getAllRecords($db, 'member');
    foreach($emailId as $key => $val){
        $send_message_email = sendNoticeEmail($emailId[$key]['email'],$notice_title,$notice_description);
    }
    $response['success']=true;
    $response['message']="<span class='text-success'>The Notice is done</span>.";
    echo json_encode($response);
    exit;
}else{
    $response['success']=false;
    $response['message']="<span class='text-danger'>The Notice is not done</span>";
    echo json_encode($response);
    exit;
}
echo json_encode($response);    
?>