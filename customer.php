<?php
// Step 1: Database connection
$host = 'localhost';         // Change to your database host
$db = 'ecarga';  // Your database name
$user = 'root';     // Your database username
$pass = '';     // Your database password
$charset = 'utf8mb4';

// Set up the database connection
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Establish the PDO connection
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Step 2: Fetch user data from the database
$sql = "SELECT user_id, name, email, avatar_url FROM users";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            margin: 0;
            padding: 0;
        }

        /* Sidebar styles */
        #sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }

        #sidebar h2 {
            text-align: center;
        }

        #sidebar ul {
            list-style-type: none;
            padding-left: 0;
        }

        #sidebar ul li {
            padding: 10px;
            margin: 5px 0;
            background-color: #34495e;
            cursor: pointer;
        }

        #sidebar ul li:hover {
            background-color: #1abc9c;
        }

        /* Main content area */
        #main-content {
            margin-left: 270px;
            padding: 20px;
            width: 100%;
        }

        h1 {
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        td img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .action-btn {
            padding: 6px 12px;
            margin: 2px;
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
        }

        .action-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar">
        <h2>Customer Dashboard</h2>
        <ul>
            <li onclick="showCustomerInfo()">Customer Info</li>
            <li onclick="showTransactionHistory()">Logout</li>
        </ul>
    </div>

    <!-- Main content area -->
    <div id="main-content">
        <h1>Customer List</h1>
        
        <!-- Table to show customer info -->
        <table>
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="customerTable">
                <!-- Dynamic content will be inserted here from PHP -->
                <?php
                // Step 3: Loop through the user data and display it in the table
                foreach ($users as $user) {
                    echo "
                        <tr>
                            <td><img src='{$user['avatar_url']}' alt='{$user['name']} Avatar'></td>
                            <td>{$user['name']}</td>
                            <td>
                                <button class='action-btn' onclick='viewCustomerInfo({$user['user_id']})'>View Info</button>
                                <button class='action-btn' onclick='viewTransactionHistory({$user['user_id']})'>Transaction History</button>
                            </td>
                        </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // Placeholder for action functions
        function viewCustomerInfo(userId) {
            alert("Viewing info for user ID: " + userId);
            // You can add logic to navigate or show more details
        }

        function viewTransactionHistory(userId) {
            alert("Viewing transaction history for user ID: " + userId);
            // You can add logic to navigate to a transaction history page or show a modal
        }
    </script>

</body>
</html>
