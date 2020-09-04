<?php

require 'config.inc.php';

if(isset($_POST['signin'])){
    session_start();
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $account = $_POST['account'];

    if(empty($username)|| empty($password)) {
        header("Location:index.php?error=Fill-all-fields");
        exit();
    }



    $query = "SELECT * FROM useraccounts WHERE username = '$username' AND password = '$password' AND account = '$account'";
    $results = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($results);

    if($row['username'] == $username && $row['password'] == $password && $row['account'] == $account){
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        $_SESSION['account'] = $account;
        header("Location: home.php");
    }

    else {
        header("Location:index.php?error=wrong_user_info");
        exit();
    }
}