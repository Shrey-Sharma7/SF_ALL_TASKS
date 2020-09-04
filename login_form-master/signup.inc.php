<?php 

require 'config.inc.php';



if(isset($_POST['signup'])) {
    session_start();

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $confirmpassword = $_POST['re_pass'];
    $account = $_POST['account'];


    if(empty($name) || empty($username) || empty($email) || empty($password) || empty($confirmpassword) || empty($account)) {
        header("Location: register.php?error=Fill-all-fields");
        exit();
    }



    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if($password != $confirmpassword) {
        header("Location: register.php?error=incorrect_password");
        exit();
    }

    $user_check = "SELECT * FROM useraccounts WHERE username = '$username'";
    $results = mysqli_query($connect, $user_check);
    $user = mysqli_fetch_assoc($results);

    if($user) {
        if($user['username'] === $username) {
            header("Location: register.php?error=user_exists");
            exit();
        }
        if($user['email'] === $email) {
            header("Location: register.php?error=email_taken");   
            exit();
        }

    }

    
    $query = "INSERT INTO useraccounts (name, username, email, password, account) VALUES ('$name', '$username', '$email', '$password', '$account')";
    mysqli_query($connect, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    $_SESSION['account'] = $account;
    header("Location: home.php");
    
}