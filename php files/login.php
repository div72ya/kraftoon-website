<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" href="images/logo.jpeg" type="image/x-icon">
</head>
<body>
<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = $_POST['password'];

    // Query the database for the user
    $sql = "SELECT * FROM users WHERE name='$name'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Check if password matches the hashed password in the database
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['role'] = $row['role']; // Store the role in the session

            // Debugging: check the session
            echo "Role in session: " . $_SESSION['role'];

            // Redirect based on role
            if ($_SESSION['role'] === 'admin') {
                header("Location: admin_dashboard.php"); // Redirect to the admin dashboard
                exit();
            } else {
                header("Location: index.php"); // Redirect to the homepage for normal users
                exit();
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
?>



   <div class="outer-box">
    <div class="inner-box">
        <header class="login-header">
            <h1>
                Login
            </h1>
        </header>
        <main class="login-body">
        <form method="POST">
                <p>
                    <label for="name">Name</label>
                    <input type="text" name="name" placeholder="abc" required>
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="********" required><br>
                    <!-- <span>At least 8 characters long</span> -->
                </p>
                <p>
                    <input type="submit" id="submit" value="Log In">
                </p>
            </form>
        </main>
        <footer class="login-footer">
            <p>
                Don't have an Account?
                <a href="signin.php">Signup</a>
            </p>
        </footer>
    </div>
</div>
</body>
</html>