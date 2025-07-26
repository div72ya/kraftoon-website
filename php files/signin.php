<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="shortcut icon" href="images/logo.jpeg" type="image/x-icon">
</head>
<body>
<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values from the form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Validate the email (ensure it's not empty and is properly formatted)
    if (empty($email)) {
        echo "Email cannot be empty.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address.";
    } else {
        // Hash the password before inserting into the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the user already exists by checking the email
        $sql_check = "SELECT * FROM users WHERE email = '$email'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            // If user already exists
            echo "Email is already registered. Please log in.";
        } else {
            // Insert new user into the database
            $sql_insert = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', 'user')";
            
            if ($conn->query($sql_insert) === TRUE) {
                // Redirect to the login page
                header("Location: login.php");
                exit();
            } else {
                echo "Error: " . $sql_insert . "<br>" . $conn->error;
            }
        }
    }
}
?>

   <div class="outer-box">
    <div class="inner-box">
        <header class="signup-header">
            <h1>
                Signup
            </h1>
        </header>
        <main class="signup-body">
        <form action="signin.php" method="POST">
                <p>
                    <label for="name">Name</label>
                    <input type="text" name="name" placeholder="abc" required>
                </p>
                <p>
                    <label for="email">Your Email</label>
                    <input type="email" name="email" placeholder="abc@gmail.com" required>
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="********" required><br>
                </p>
                <p>
                    <input type="submit" id="submit" value="Create an Account">
                </p>
            </form>
        </main>
        <footer class="signup-footer">
            <p>
                Already have an Account?
                <a href="login.php">Login</a>
            </p>
        </footer>
    </div>
</div>
</body>
</html>