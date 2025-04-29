<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecarga";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Simulate driver login: Assume driver ID is stored in session
if (!isset($_SESSION['driver_id'])) {
    $_SESSION['driver_id'] = 7; // Example: logged-in driver with ID 7
}

$driver_id = $_SESSION['driver_id'];

// Fetch driver data (JOIN drivers and driver_availability)
$sql = "SELECT d.name, d.image_url, da.availability 
        FROM drivers d 
        JOIN driver_availability da ON d.driver_id = da.driver_id 
        WHERE d.driver_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $driver_id);
$stmt->execute();
$stmt->bind_result($name, $avatar_image_url, $availability);
$stmt->fetch();
$stmt->close();

// Use default image if no image URL provided from the drivers table
if (empty($avatar_image_url)) {
    $avatar_image_url = 'images/default-avatar.png'; // Ensure this file exists
}

// Handle availability toggle
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toggle_availability'])) {
    $new_availability = ($availability === 'available') ? 'busy' : 'available';

    // Update availability in the database
    $update_sql = "UPDATE driver_availability SET availability = ? WHERE driver_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $new_availability, $driver_id);
    $update_stmt->execute();
    $update_stmt->close();

    // Re-fetch updated availability from the database
    $sql = "SELECT availability FROM driver_availability WHERE driver_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $driver_id);
    $stmt->execute();
    $stmt->bind_result($availability);
    $stmt->fetch();
    $stmt->close();
}

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
            <!-- Correctly use the avatar image URL -->
            <img src="<?php echo $avatar_image_url; ?>" alt="Avatar" class="avatar-img">
            <p>Welcome, <?php echo htmlspecialchars($name); ?>!</p>
        </div>

        <!-- Availability Toggle Button -->
        <form method="POST">
            <button type="submit" name="toggle_availability" class="availability-button">
                <?php echo ($availability === 'available') ? 'Set as Busy' : 'Set as Available'; ?>
            </button>
        </form>

        <p>Status: <strong><?php echo ucfirst($availability); ?></strong></p>
    </div>
</div>

</body>
</html>
