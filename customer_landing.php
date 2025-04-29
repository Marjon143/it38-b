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

// Simulate user login: Assume user ID is stored in session (you should set this after user authentication)
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1; // Example: logged-in user with ID 1
}

// Fetch user data from the database (including avatar image URL)
$user_id = $_SESSION['user_id'];
$sql = "SELECT name, avatar_url FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($user_name, $avatar_image_url);
$stmt->fetch();

// If no avatar is found, use a default image
if (empty($avatar_image_url)) {
    $avatar_image_url = 'images/default-avatar.png'; // Default avatar
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Information</title>
    <link rel="stylesheet" href="assets/customer_landing.css">
</head>
<body>

<div class="container">
    <h1>ECARGA: SAFE RIDE MADE POSSIBLE</h1>

    <!-- Header with Avatar and Search Field -->
    <div class="header">
        <!-- Avatar with dropdown -->
        <div class="avatar-container">
            <div class="avatar">
                <!-- Display the avatar dynamically using PHP -->
                <img src="<?php echo $avatar_image_url; ?>" alt="Avatar" class="avatar-img">
            </div>
            <!-- Display the user's name beside the avatar -->
            <div class="user-name">
                <p>Hello, <?php echo htmlspecialchars($user_name); ?>!</p>
            </div>
            <div class="avatar-dropdown">
                <a href="#">Logout</a>
            </div>
        </div>

        <!-- Search Field -->
        <input type="text" class="search-field" placeholder="Search Drivers...">
    </div>

    <!-- Available Drivers Section -->
    <div class="section driver-status">
        <h2>Available Drivers</h2>
        <table>
            <thead>
                <tr>
                    <th>Driver Name</th>
                    <th>Vehicle Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="available">
                    <td>John Doe</td>
                    <td>Sedan</td>
                    <td class="action-buttons">
                        <button onclick="alert('Booking John Doe');">Book Now</button>
                        <button class="view" onclick="alert('Viewing profile of John Doe');">View Driver</button>
                        <button class="contact" onclick="alert('Contacting John Doe');">Contact Driver</button>
                    </td>
                </tr>
                <tr class="available">
                    <td>Jane Smith</td>
                    <td>SUV</td>
                    <td class="action-buttons">
                        <button onclick="alert('Booking Jane Smith');">Book Now</button>
                        <button class="view" onclick="alert('Viewing profile of Jane Smith');">View Driver</button>
                        <button class="contact" onclick="alert('Contacting Jane Smith');">Contact Driver</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Busy Drivers Section -->
    <div class="section driver-status">
        <h2>Busy Drivers</h2>
        <table>
            <thead>
                <tr>
                    <th>Driver Name</th>
                    <th>Vehicle Type</th>
                </tr>
            </thead>
            <tbody>
                <tr class="busy">
                    <td>Emily White</td>
                    <td>Sedan</td>
                </tr>
                <tr class="busy">
                    <td>Michael Johnson</td>
                    <td>SUV</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Vehicles Section -->
    <div class="section vehicle-list">
        <h2>Available Vehicles</h2>
        <table>
            <thead>
                <tr>
                    <th>Vehicle Type</th>
                    <th>Capacity</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sedan</td>
                    <td>Up to 4 passengers</td>
                    <td>Comfortable and compact for city driving</td>
                </tr>
                <tr>
                    <td>SUV</td>
                    <td>Up to 6 passengers</td>
                    <td>Great for families or small groups</td>
                </tr>
                <tr>
                    <td>Minivan</td>
                    <td>Up to 8 passengers</td>
                    <td>Spacious for larger groups or luggage</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
