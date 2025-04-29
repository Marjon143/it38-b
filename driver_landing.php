<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Your DB username
$password = ""; // Your DB password
$dbname = "ecarga"; // Your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Simulate driver login: Assume driver ID is stored in session (you should set this after driver authentication)
if (!isset($_SESSION['driver_id'])) {
    $_SESSION['driver_id'] = 1; // Example: logged-in driver with ID 1
}

// Fetch driver data from the database (including avatar image URL and availability)
$driver_id = $_SESSION['driver_id'];
$sql = "SELECT name, image_url, availability FROM driver_availability WHERE driver_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $driver_id);
$stmt->execute();
$stmt->bind_result($name, $avatar_image_url, $availability);
$stmt->fetch();

// If no avatar is found, use a default image
if (empty($avatar_image_url)) {
    $avatar_image_url = 'images/default-avatar.png'; // Default avatar
}

// Handle availability toggle
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toggle_availability'])) {
    $new_availability = ($availability == 'available') ? 'busy' : 'available';
    
    // Update availability in the database
    $update_sql = "UPDATE driver_availability SET availability = ? WHERE driver_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $new_availability, $driver_id);
    $update_stmt->execute();
    
    // Update the session variable and the availability status
    $availability = $new_availability;
    $update_stmt->close();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard</title>
    <link rel="stylesheet" href="assets/driver_landing.css">
</head>
<body>

<div class="container">
    <h1>Driver Dashboard - ECARGA</h1>

    <!-- Driver Card -->
    <div class="driver-card">
        <div class="avatar-container">
            <img src="<?php echo $image_url; ?>" alt="Avatar" class="avatar-img">
            <p>Welcome, <?php echo htmlspecialchars($name); ?>!</p>
        </div>
        
        <!-- Availability Toggle Button -->
        <form method="POST">
            <button type="submit" name="toggle_availability" class="availability-button">
                <?php echo ($availability == 'available') ? 'Set as Busy' : 'Set as Available'; ?>
            </button>
        </form>

        <p>Status: <strong><?php echo ucfirst($availability); ?></strong></p>
    </div>

</div>

</body>
</html>
