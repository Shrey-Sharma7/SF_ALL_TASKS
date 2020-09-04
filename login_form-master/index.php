<?php require 'login.inc.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
</head>
<body>

<style>

  body{
    font-size: 13px;
    line-height: 1.8;
    color: #222;
    background: #f8f8f8;
    font-weight: 400;
    font-family: Poppins;
    overflow: hidden;
  }

  section{
    display: block;
  }

  figure{
    margin: 0;
    margin-bottom: 50px;
    text-align: center;
  }

  img{
    max-width: 100%;
    height: auto;
  }

  h2{
    line-height: 1.66;
    margin: 0;
    padding: 0;
    font-weight: bold;
    color: #222;
    font-family: Poppins;
    font-size: 36px;
  }

  label {
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    color: #222;
  }

  input {
    width: 100%;
    display: block;
    border: none;
    border-bottom: 1px solid #999;
    padding: 6px 30px;
    font-family: Poppins;
    box-sizing: border-box;
    outline: none;
  }



  /* ----------------- SIGN IN FORM -------------------*/



  .container{
    width: 900px;
    background: #fff;
    margin: 0 auto;
    box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
    border-radius: 20px;
    margin-top: 80px;
  }

  .signin-content{
    display: flex;
    padding-top: 67px;
    padding-bottom: 87px;
  }

  .signin-image{
    margin-left: 110px;
    margin-right: 20px;
    margin-top: 10px;
    width: 50%;
    overflow: hidden;
  }

  .signup-image-link {
    font-size: 14px;
    color: #222;
    display: block;
    text-align: center;
  }

  .signin-form{
    margin-right: 90px;
    margin-left: 80px;
    width: 50%;
    overflow: hidden;

  }

  .form-title{
    margin-bottom: 33px;
  }

  .register-form {
    width: 100%;
  }

  .form-group {
    position: relative;
    margin-bottom: 25px;
    overflow: hidden;
  }

  .label-agree-term {
    position: relative;
    top: 0%;
    transform: translateY(0);
  }

  .form-group:last-child {
    margin-bottom: 0px;
  }

  .form-group {
    position: relative;
    margin-bottom: 25px;
    overflow: hidden;
  }

  #signin {
    margin-top: 16px;
  }

  .form-submit {
    display: inline-block;
    background: #6dabe4;
    color: #fff;
    border-bottom: none;
    width: auto;
    padding: 15px 39px;
    border-radius: 5px;
    margin-top: 25px;
    cursor: pointer;
  }

  .form-submit:hover{
    filter: brightness(1.1);
  }

  .account{
    width: 10%;
    display: inline;
  }






  /* Media Files */

  @media screen and (min-width: 1024px){
  .container {
    max-width: 1200px;
   }
  }

</style>

    <div class="main">

        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="register.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign In</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">                            
                                <input type="text" name="username" id="username" placeholder="Username"/>
                            </div>
                            <div class="form-group">                           
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">           
                              <input type="radio" name="account" class="account" value = "master"> Master
                              <input type="radio" name="account" class="account" value = "client"> Client
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

    </div>

</body>
</html>