<?php
session_start();
include("connection.php");
include("functions.php");

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    if (!empty($mail) && !empty($password)) {
        $query = "SELECT * FROM frontend WHERE mail = '$mail' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['password'] === $password) {
                    $_SESSION['mail'] = $user_data['mail'];
                    header("Location: index.html");  // Redirect to index.php on successful login
                    die;
                } else {
                    $error_message = "Incorrect password!";
                }
            } else {
                $error_message = "No user found with that email!";
            }
        } else {
            $error_message = "Query failed!";
        }
    } else {
        $error_message = "Please enter some valid information!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="signin.css">
    <style>
        .error-message {
            position: absolute;
            top: 0;
            left: 0;
            margin: 10px;
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <?php if (!empty($error_message)): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
    
    <div class="Sign-in">
        <form method="post" action="signin.php">
            <h1>Sign in</h1>
            <p> Use your existing account</p>
            
            <input type="email" name="mail" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <a href="#">Forgot your Password?</a><br><br>
            <button type="submit" value="Signin">SIGN IN</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign Up here</a></p>
    </div> 
</body>
</html>
