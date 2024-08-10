<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['mail'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password) && !is_numeric($email)) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM frontend WHERE mail = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            
            // Verify password (assuming password is hashed)
            if (password_verify($password, $user_data['password'])) {
                header("Location: index.php");
                exit();
            } else {
                echo "<script type='text/javascript'> alert('Wrong username or password');</script>";
            }
        } else {
            echo "<script type='text/javascript'> alert('Wrong username or password');</script>";
        }

        $stmt->close();
    } else {
        echo "<script type='text/javascript'> alert('Please fill in all fields with valid information');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>
<body>
    <div class="Sign-in">
        <form method="post">
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
