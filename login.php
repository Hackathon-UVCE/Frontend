<?php
session_start();

include("db.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  $UserName = $_POST['userName'];
  $email = $_POST['mail'];
  $ContactNumber = $_POST['pnumber'];
  $password = $_POST['password'];


  if(!empty($email)&& !empty($password) && !is_numeric($email))
  {
    $query = "insert into frontend (userName, mail, pnumber, password ) values('$UserName', '$email', '$ContactNumber', '$password')";

    mysqli_query($conn, $query);

    echo "<script type='text/javascript'> alert('Successfully Registered');</script>";
    header("Location: " . $_SERVER['PHP_SELF']); 
    exit();


  }
  else{
    echo "<script type='text/javascript'> alert('Please Enter some Valid Information');</script>";

  }

}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-page</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container" id="main">

  <div class="sign-up">
    <form method="POST">
        <h1>Create Account</h1>
        <p> use your Email for registration</p>
        <input type="text" name="userName" placeholder="UserName"><br><br>
        <input type="email" name="mail" placeholder="Email"><br><br>
        <input type="number" name="pnumber" placeholder="ContactNumber">
        <input type="password" name="password" placeholder="Password"><br><br>
        <button>SIGN UP</button>
    </form>
  </div> 
  <div class="Sign-in">
    <form>
        <h1>Sign in</h1>
        <p> use your account</p>
        
        <input type="email" name="email" placeholder="Email"><br><br>
        <input type="password" name="pass" placeholder="Password"><br><br>
        <a  href="#">Forget your Password?</a><br><br>
        <button>SIGN In</button>
    </form>
  </div> 
  <div class="overlay-conatiner">
    <div class="overlay">
        <div class="overlay-left">
            <h1>Welcome Back!</h1>
            <p>To keep connected with us please login with your personal info</p>
            <button id="signIN">Sign In</button>
        </div>
        <div class="overlay-right">
            <h1>Hello,user</h1>
            <p>Enter your personal details to connect with us</p>
            <button id="signUp">sign Up</button>
        </div>

    </div>
  </div>


</div>
    
</body>
</html>