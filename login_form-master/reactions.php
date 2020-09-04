<?php

session_start();
require 'config.inc.php';
$username = $_SESSION['username'];

$upCount = $upCount + $_SESSION['upCount'];
$downCount = $downCount + $_SESSION['downCount'];
  $comment_id = mysqli_real_escape_string($connect, $_POST['comment_id']);
  $type = mysqli_real_escape_string($connect, $_POST['type']);
  $sql = mysqli_query($connect, "SELECT id FROM reactions WHERE comment_id = '$comment_id' && username = '$username'");
  if(mysqli_num_rows($sql) > 0){
    mysqli_query($connect, "UPDATE reactions SET type = '$type' WHERE comment_id = '$comment_id' && username = '$username'");
    $status = "updated";
  }else {
    mysqli_query($connect, "INSERT INTO reactions (username, comment_id, type) VALUES ('$username', '$comment_id', '$type')");
    $status = "inserted";
  }
  $up = "up";
  $down = "down";
  $resUp = mysqli_query($connect, "SELECT id FROM reactions WHERE comment_id = '$comment_id' && type = '$up'");
  $resDown = mysqli_query($connect, "SELECT id FROM reactions WHERE comment_id = '$comment_id' && type = '$down'");
  $upCount = mysqli_num_rows($resUp);
  $downCount = mysqli_num_rows($resDown);
  $_SESSION['upCount'] = $upCount;
  $_SESSION['downCount'] = $downCount;
  $data = array(
    'status' => $status,
    'upCount' => $upCount,
    'downCount' => $downCount
  );
  echo json_encode($data);


?>
