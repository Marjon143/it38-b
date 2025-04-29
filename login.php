<?php
session_start(); // Start session to store user data

// Database connection settings
$host = "localhost"; // your DB host
$dbname = "ecarga"; // your DB name
$username = "root"; // your DB username
$password = ""; // your DB password

// Handle registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    try {
        // Connect to the database
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Collect form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if the passwords match
        if ($password !== $confirm_password) {
            echo "<p>Passwords do not match. Please try again.</p>";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $address = $_POST['address'];

            // Handle avatar image upload
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['avatar']['tmp_name'];
                $fileName = $_FILES['avatar']['name'];
                $uploadPath = 'uploads/' . basename($fileName);

                // Ensure the "uploads" folder exists and is writable
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                // Move the uploaded file to the server
                if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                    // Insert user data into the database
                    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, address, avatar_url) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$name, $email, $hashed_password, $address, $uploadPath]);

                    echo "<p>User registered successfully!</p>";
                } else {
                    echo "<p>Error uploading file.</p>";
                }
            } else {
                echo "<p>No avatar image uploaded.</p>";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    try {
        // Connect to the database
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Collect login form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the email exists
        $stmt = $pdo->prepare("SELECT user_id, name, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        // If email exists, verify the password
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                // Store user info in session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['name'];

                // Redirect to dashboard after successful login
                header("Location: dashboard.php");
                exit(); // Ensure no further code is executed
            } else {
                echo "<p>Incorrect password. Please try again.</p>";
            }
        } else {
            echo "<p>Email not found. Please register first.</p>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/2efc16a506.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/login.css">
    <title>Login Form | pbc-webdev</title>
</head>

<body>
    <div class="container" id="container">
        <!-- Registration Form -->
        <div class="form-container sign-up">
            <form action="" method="POST" enctype="multipart/form-data">
                <hr>
                <h1>or</h1>
                <hr>
                <span>Fill the information field.</span>
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                
                <!-- Address Input -->
                <input type="text" name="address" placeholder="Address" required>

                <!-- Avatar Image Upload -->
                <input type="file" name="avatar" accept="image/*" placeholder="Avatar" required>
                
                <button type="submit" name="register">Sign Up</button>
            </form>
        </div>

        <!-- Login Form -->
        <div class="form-container sign-in">
            <form action="" method="POST">
                <h1>Login With</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <hr>
                <h1>or</h1>
                <hr>
                <span>Login With Your Email & Password</span>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </div>

        <!-- Toggle Forms -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Already have an account?</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello</h1>
                    <p>Don't have an account?</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include your JS for form toggle (optional) -->
    <script src="assets/login.js"></script>
</body>

</html>
