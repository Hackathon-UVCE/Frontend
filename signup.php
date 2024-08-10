<?php
session_start();
include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $userName = $_POST['userName'];
    $mail = $_POST['mail'];
    $pnumber = $_POST['pnumber'];
    $password = $_POST['password'];
    if(!empty($mail)&&!empty($password))
    {

        $query = "insert into frontend (userName,mail,pnumber,password) values('$userName','$mail','$pnumber','$password')";
        mysqli_query($con, $query);

        header("Location: signin.php");
        die;
    }else{
        echo "Please enter some valid information!";
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-page</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
<div class="container" id="main">
  <div class="sign-up">
    <form method="POST" action= "signup.php">
        <h1>Create Account</h1>
        <p> use your Email for registration</p>
        <input type="text" name="userName" placeholder="UserName"><br><br>
        <input type="email" name="mail" placeholder="Email"><br><br>
        <input type="number" name="pnumber" placeholder="ContactNumber">
        <input type="password" name="password" placeholder="Password"><br><br>
        <button type="submit" value="Sign Up">SIGN UP</button>
    </form>
    <p>By clicking sign up button you will be accepting our<br>
    <a href="#"> Terms and Condition</a> and <a href="#">Policy Privacy</a>
    </p>
    <p>Already have an account? <a href = "signin.php">Login Here</a></p>

  </div> 
</div>
</body>
</html>