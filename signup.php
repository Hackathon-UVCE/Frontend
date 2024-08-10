<?php
session_start();
include("db.php"); // Make sure you have the correct database connection file

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $UserName = $_POST['userName'];
    $email = $_POST['mail'];
    $ContactNumber = $_POST['pnumber'];
    $password = $_POST['password'];

    // Validate form data
    if (!empty($UserName) && !empty($email) && !empty($ContactNumber) && !empty($password) && !is_numeric($email)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare and execute the SQL query
        $stmt = $conn->prepare("INSERT INTO frontend (userName, mail, pnumber, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $UserName, $email, $ContactNumber, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Successfully Registered";
        } else {
            $_SESSION['message'] = "Registration Failed";
        }

        $stmt->close();

        // Redirect after form submission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $_SESSION['message'] = "Please Enter Valid Information";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Display any session messages as alerts
if (isset($_SESSION['message'])) {
    echo "<script type='text/javascript'>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']); 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container" id="main">
  <div class="sign-up">
    <form method="POST">
        <h1>Create Account</h1>
        <p>Use your Email for registration</p>
        <input type="text" name="userName" placeholder="UserName" required><br><br>
        <input type="email" name="mail" placeholder="Email" required><br><br>
        <input type="number" name="pnumber" placeholder="ContactNumber" required>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">SIGN UP</button>
    </form>
    <p>By clicking the sign-up button you will be accepting our<br>
    <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>
    </p>
    <p>Already have an account? <a href="signin.php">Login Here</a></p>
  </div> 
</div>
</body>
</html>
