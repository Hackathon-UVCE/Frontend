<?php
session_start();
include("db.php"); // Make sure you have the correct database connection file

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['mail'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password) && !is_numeric($email)) {
        // Prepare and execute the SQL query
        $stmt = $conn->prepare("SELECT * FROM frontend WHERE mail = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            
            // Verify the password against the hashed password stored in the database
            if (password_verify($password, $user_data['password'])) {
                $_SESSION['user'] = $user_data['userName']; // Store the user's name in the session
                header("Location: index.php"); // Redirect to the welcome page
                exit();
            } else {
                $_SESSION['message'] = "Wrong username or password.";
            }
        } else {
            $_SESSION['message'] = "Wrong username or password.";
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "Please fill in all fields with valid information.";
    }

    // Redirect back to the sign-in page
    header("Location: signin.php");
    exit();
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

    <title>Document</title>
    <link rel="stylesheet" href="signin.css">

</head>
<body>
    <div class="Sign-in">
        <form method="post" action="signin.php">
            <h1>Sign in</h1>
            <p>Use your existing account</p>
            
            <input type="email" name="mail" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <a href="#">Forgot your Password?</a><br><br>
            <button type="submit">SIGN IN</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign Up here</a></p>
    </div>
</body>
</html>
