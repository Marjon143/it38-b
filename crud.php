<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecarga";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle add action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = $_POST['driverName'];
    $address = $_POST['address'];
    $vehicle_type = $_POST['vehicleType'];
    $plate_number = $_POST['plateNumber'];
    $years_experience = $_POST['yearsExperience'];
    $image_url = $_POST['driverImageURL'];

    $stmt = $conn->prepare("INSERT INTO drivers (name, address, vehicle_type, plate_number, years_experience, image_url) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $name, $address, $vehicle_type, $plate_number, $years_experience, $image_url);
    if ($stmt->execute()) {
        header("Location: crud.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Handle delete confirmation
if (isset($_GET['action']) && $_GET['action'] === 'confirm_delete' && isset($_GET['driver_id'])) {
    $driver_id = intval($_GET['driver_id']);
    $sql = "DELETE FROM drivers WHERE driver_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $driver_id);
        if ($stmt->execute()) {
            echo "<p>Driver deleted successfully at " . date('Y-m-d H:i:s') . ".</p>";
        } else {
            echo "Error deleting driver: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Fetch all drivers
$sql = "SELECT * FROM drivers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Driver CRUD Operations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2, h1 {
            text-align: center;
            color: #333;
        }
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }
        .form-container input, .form-container select {
            width: calc(33.33% - 15px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .action-buttons button, .action-buttons a {
            padding: 5px 10px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
            border: none;
            text-decoration: none;
            display: inline-block;
        }
        .view-btn {
            background-color: #2196F3;
            color: white;
        }
        .update-btn {
            background-color: #ff9800;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
        .image-preview {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        #deleteModal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }
        .modal-content button {
            padding: 10px 15px;
            border: none;
            background-color: #f44336;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        .modal-content button:hover {
            background-color: #e53935;
        }
    </style>
    <script>
        function confirmDelete(driverId) {
            document.getElementById('deleteModal').style.display = 'flex';
            document.getElementById('deleteButton').onclick = function () {
                window.location.href = "?action=confirm_delete&driver_id=" + driverId;
            };
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Driver CRUD Operations</h2>

    <!-- Add Driver Form -->
    <div class="form-container">
        <form action="crud.php" method="POST">
            <input type="text" name="driverName" placeholder="Driver Name" required>
            <input type="text" name="address" placeholder="Address" required>
            <select name="vehicleType" required>
                <option value="" disabled selected>Select Vehicle Type</option>
                <option value="Car">Car</option>
                <option value="Jeep">Truck</option>
                <option value="Motorcycle">Motorcycle</option>
            </select>
            <input type="text" name="plateNumber" placeholder="Plate Number" required>
            <input type="number" name="yearsExperience" placeholder="Years of Experience" required>
            <input type="url" name="driverImageURL" placeholder="Image URL" required>
            <input type="hidden" name="action" value="add">
            <button type="submit">Add Driver</button>
        </form>
    </div>

    <!-- Driver List Table -->
    <h1>Drivers List</h1>
    <table>
        <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Address</th>
            <th>Vehicle Type</th>
            <th>Plate Number</th>
            <th>Years of Experience</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($row['image_url']) ?>" class="image-preview" alt="Driver Image"></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td><?= htmlspecialchars($row['vehicle_type']) ?></td>
                    <td><?= htmlspecialchars($row['plate_number']) ?></td>
                    <td><?= htmlspecialchars($row['years_experience']) ?></td>
                    <td class="action-buttons">
                        <a href="view.php?id=<?= $row['driver_id'] ?>" class="view-btn">View</a>
                        <a href="edit.php?id=<?= $row['driver_id'] ?>" class="update-btn">Edit</a>
                        <button onclick="confirmDelete(<?= $row['driver_id'] ?>)" class="delete-btn">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="7">No drivers found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal">
    <div class="modal-content">
        <p>Are you sure you want to delete this driver?</p>
        <button id="deleteButton">Yes, Delete</button>
        <button onclick="document.getElementById('deleteModal').style.display='none'">Cancel</button>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
