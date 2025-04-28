<!-- customers.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers - MedEx</title>
    <link rel="stylesheet" href="assets/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
    <section class="header">
        <!-- Same header code from dashboard -->
    </section>

    <section class="main">
        <div class="sidebar">
            <!-- Same sidebar from dashboard (copy-paste) -->
        </div>

        <div class="main--content">
            <div class="title">
                <h2 class="section--title">Customers</h2>
            </div>

            <div class="customer--info">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>Last Ride</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>Male</td>
                            <td>34</td>
                            <td>+123456789</td>
                            <td>2025-04-22</td>
                            <td>Active</td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>Female</td>
                            <td>29</td>
                            <td>+987654321</td>
                            <td>2025-04-20</td>
                            <td>Inactive</td>
                        </tr>
                        <!-- Add more rows dynamically later -->
                    </tbody>
                </table>
            </div>

            <div class="customer--history">
                <h3>Recent Customer History</h3>
                <ul>
                    <li>John Doe requested a ride on 2025-04-22 at 4:30 PM</li>
                    <li>Jane Smith cancelled a booking on 2025-04-20</li>
                    <li>David Park gave a rating of 5 stars on 2025-04-19</li>
                </ul>
            </div>
        </div>
    </section>

    <script src="assets/dashboard.js"></script>
</body>
</html>
