<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection settings
    $host = "localhost"; // your DB host
    $dbname = "ecarga"; // your DB name
    $username = "root"; // your DB username
    $password = ""; // your DB password

    try {
        // Connect to the database
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Collect form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
        $address = $_POST['address'];

        // Collect avatar URL
        $avatar_url = $_POST['avatar_url'];

        // Insert user data into the database
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, address, avatar_url) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $address, $avatar_url]);

        echo "<p>User registered successfully!</p>";
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
    <title>Registration Form | pbc-webdev</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="" method="POST">
                <span>Fill in the information fields.</span>
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>

                <!-- Address Input -->
                <input type="text" name="address" placeholder="Address" required>

                <!-- Avatar Image URL Input -->
                <input type="text" name="avatar_url" placeholder="Avatar URL" required>

                <button type="submit">Sign Up</button>
            </form>
        </div>

        <!-- Sign-in Form -->
        <div class="form-container sign-in">
            <form>
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
                <input type="email" placeholder="Email" required>
                <input type="password" placeholder="Password" required>
                <button>Login</button>
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
