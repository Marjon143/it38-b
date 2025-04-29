<?php
session_start();

// Handle login submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // DB credentials
    $host = "localhost";
    $db = "ecarga";
    $user = "root";
    $pass = "";

    // Connect to DB
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get submitted email and password
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if driver exists
    $stmt = $conn->prepare("SELECT driver_id, email, password FROM drivers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verify
    if ($result->num_rows === 1) {
        $driver = $result->fetch_assoc();
        if (password_verify($password, $driver['password'])) {
            $_SESSION['driver_id'] = $driver['id'];
            $_SESSION['driver_email'] = $driver['email'];
            header("Location: driver_landing.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Driver not found.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Driver Login</title>
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
      display: flex;
      height: 100vh;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      background-color: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 400px;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 24px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    .form-group input:focus {
      border-color: #007BFF;
      outline: none;
    }

    .login-btn {
      width: 100%;
      padding: 12px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    .login-btn:hover {
      background-color: #0056b3;
    }

    .error {
      color: red;
      text-align: center;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Driver Login</h2>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST" action="">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />
      </div>

      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />
      </div>

      <button type="submit" class="login-btn">Login</button>
    </form>
  </div>

</body>
</html>
