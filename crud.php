<?php
// Database connection
$servername = "localhost";  // Database server
$username = "root";         // Database username
$password = "";             // Database password
$dbname = "driver_management"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['driverImage'])) {
    $name = $_POST['driverName'];
    $address = $_POST['address'];
    $vehicleType = $_POST['vehicleType'];
    $plateNumber = $_POST['plateNumber'];
    $yearsExperience = $_POST['yearsExperience'];
    $image = $_FILES['driverImage']['tmp_name'];  // Path to uploaded file

    // Read the image file into a binary string
    $imageData = file_get_contents($image);

    // SQL query to insert driver details into the database
    $sql = "INSERT INTO drivers (name, address, vehicle_type, plate_number, years_experience, image) 
            VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssbs", $name, $address, $vehicleType, $plateNumber, $yearsExperience, $imageData);

        if ($stmt->execute()) {
            echo "New driver added successfully.<br>";
        } else {
            echo "Error: " . $stmt->error . "<br>";
        }
        $stmt->close();
    }
}

// Fetch all drivers from the database
$sql = "SELECT * FROM drivers";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver CRUD Operations</title>
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
        h2 {
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
        .action-buttons button {
            padding: 5px 10px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
            border: none;
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
    </style>
</head>
<body>

  <div class="container">
    <h2>Driver CRUD Operations</h2>

    <!-- Form for adding a new driver -->
    <div class="form-container">
      <form action="index.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="driverName" placeholder="Driver Name" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="text" name="vehicleType" placeholder="Vehicle Type" required>
        <input type="text" name="plateNumber" placeholder="Plate Number" required>
        <input type="number" name="yearsExperience" placeholder="Years of Experience" required>
        <input type="file" name="driverImage" accept="image/*" required>
        <button type="submit">Add Driver</button>
      </form>
    </div>

    <!-- Table to display drivers -->
    <table>
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Address</th>
          <th>Vehicle Type</th>
          <th>Plate Number</th>
          <th>Years of Experience</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" class="image-preview" />
              </td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['address']; ?></td>
              <td><?php echo $row['vehicle_type']; ?></td>
              <td><?php echo $row['plate_number']; ?></td>
              <td><?php echo $row['years_experience']; ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="6">No drivers found</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>
