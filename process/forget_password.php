<?php
include('../include/config.php');

$email = $_POST['email'];
if(empty($email)){
	$response['success']= false;
	$response['message']="Please Enter Email Id";
	echo json_encode($response);
	exit;
}
$u_data = getSingleRecord($db, 'member', 'email', $email);

if($u_data<=0){

    $response['success']= false;
	$response['message']="Email address does not exist. Please Register";
	echo json_encode($response);
	exit;
}


$reset_password = getPassword();

$to = $email; 

sendPasswordResetEmail($to,$reset_password,$email);

$q = "UPDATE member SET
    `password` = '$reset_password'
    WHERE `email` = '$email'
";
if(mysqli_query($db, $q)) {
    $response['success'] = true;
    $response['message'] = 'To Reset your Password check your Email';
} else {
    $response['success'] = false;
    $response['message'] = 'Process Failed. Try After some Time... !';
}
echo json_encode($response);
?>