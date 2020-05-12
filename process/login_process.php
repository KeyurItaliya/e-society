<?php
include '../include/config.php';
$type_user = $_POST['type_user'];
$user_name = $_POST['user_name'];
$password = $_POST['password'];

if($type_user == 'admin'){
    $query = "SELECT * FROM `admin` WHERE `admin_name` = '$user_name' AND `admin_password` = '$password' "; 
    $run = mysqli_query($db, $query);
    $row = mysqli_num_rows($run);
    if($row > 0){
        $data = mysqli_fetch_assoc($run);
        session_start();
        if(!empty($_POST['remember'])){
            setcookie("user_name_cookie", $data["admin_name"], time() + (86400 * 30), "/");
            setcookie("password_cookie", $data["admin_password"], time() + (86400 * 30), "/");
        }
        $_SESSION['aid'] = $data['id'];
        $_SESSION['admin_name'] = $data['admin_name'];
        $response['success']=true;
        $response['message']="<span class='text-success'>The success is done</span>.";
        echo json_encode($response);
        exit;
    }else{
        $response['success']=false;
        $response['message']="<span class='text-danger'>You are not login</span>.";
        echo json_encode($response);
        exit;
    }
}else if($type_user == 'user'){
    $query = "SELECT * FROM `member` WHERE `email` = '$user_name' AND `password` = '$password' "; 
    $run = mysqli_query($db, $query);
    $row = mysqli_num_rows($run);
    if($row > 0){
        $data = mysqli_fetch_assoc($run);
        session_start();
        if(!empty($_POST['remember'])){
            setcookie("user_name_cookie", $data["email"], time() + (86400 * 30), "/");
            setcookie("password_cookie", $data["password"], time() + (86400 * 30), "/");
        }
        $_SESSION['uid'] = $data['id'];
        $_SESSION['user_email'] = $data['email'];
        $_SESSION['user_name'] = $data['user_name'];
        $response['success']=true;
        $response['message']="<span class='text-success'>The success is done</span>.";
        echo json_encode($response);
        exit;
    }else{
        $response['success']=false;
        $response['message']="<span class='text-danger'>You are not login</span>.";
        echo json_encode($response);
        exit;
    }
}else if($type_user == 'security_guard'){
    $query = "SELECT * FROM `security_guard` WHERE `email` = '$user_name' AND `password` = '$password' "; 
    $run = mysqli_query($db, $query);
    $row = mysqli_num_rows($run);
    if($row > 0){
        $data = mysqli_fetch_assoc($run);
        session_start();
        $_SESSION['sid'] = $data['id'];
        $_SESSION['guard_name'] = $data['name'];
        $_SESSION['guard_email'] = $data['email'];
        $response['success']=true;
        $response['message']="<span class='text-success'>The success is done</span>.";
        echo json_encode($response);
        exit;
    }else{
        $response['success']=false;
        $response['message']="<span class='text-danger'>You are not login</span>.";
        echo json_encode($response);
        exit;
    }
}
?>