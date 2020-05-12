<?php
include '../include/config.php';
foreach($_POST as $var=>$valu){$$var = $valu;}

$category_image = $_FILES['category_image']['name'];

if(empty($category_name) || empty($category_image) || empty($date)){
    $response['success']=false;
    $response['error']="<span class='text-danger'>The request is not done</span>";
    echo json_encode($response);
    exit;
}
if(!empty($category_image)){
    $newfile = round(microtime(true)) . '_' .$category_image;
    if(!move_uploaded_file($_FILES['category_image']['tmp_name'], '../images/'.$newfile)){
        $response['success']=false;
        $response['message']="<span class='text-danger'>File Uploads faild</span>";
        echo json_encode($response);
        exit;
    }
    $path = '../images/'.$category_hiddne_image;
    unlink($path);
}else{
    $newfile = $category_hiddne_image; 
}
if($submit_type == 'Add'){
        $qur = "INSERT INTO `expenses_category` SET 
            `category_name` = '$category_name',
            `category_image` = '$newfile',
            `date` = '$date'
            ";
    $quer = mysqli_query($db, $qur);
}else {
    $qur = "UPDATE `expenses_category` SET 
        `category_name` = '$category_name',
        `category_image` = '$newfile',
        `date` = '$date'
        WHERE `id` = '$category_id'
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