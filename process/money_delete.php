<?php 
include('../include/config.php');
$delete_id = $_GET['id'];
$identification = $_GET['identication'];
if($identification == "money"){
$que = "DELETE FROM `money` WHERE `id` = '$delete_id'";
$run = mysqli_query($db, $que);
    if($run == true){
        header('location:../expenses.php?id=1');
    }
}else if($identification == "notice_board"){
    $que = "DELETE FROM `notice` WHERE `id` = '$delete_id'";
    $run = mysqli_query($db, $que);
    if($run == true){
        header('location:../notice_board.php?id=1');
    }
}else if($identification == "member"){
    $que = "DELETE FROM `member` WHERE `id` = '$delete_id'";
    $run = mysqli_query($db, $que);
    if($run == true){
        header('location:../member.php?id=1');
    }
}

?>