<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/availability.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Availability</title>
</head>
<body>
    <section class="header">
        <!-- Header code remains the same -->
    </section>
    
    <section class="main">
        <div class="sidebar">
            <!-- Sidebar code remains the same -->
        </div>
        
        <div class="main--content">
            <div class="availability">
                <div class="title">
                    <h2 class="section--title">Riders Availability</h2>
                    <select name="date" id="date" class="dropdown">
                        <option value="today">Today</option>
                        <option value="tomorrow">Last Week</option>
                        <option value="custom">Last Month</option>
                       
                    </select>
                </div>
                <div class="table-wrapper">
                    <table class="availability-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Vehicle Type</th>
                                <th>Status</th>
                                <th>View Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Row 1 -->
                            <tr>
                                <td>John Doe</td>
                                <td>Car</td>
                                <td><span class="status available">Available</span></td>
                                <td><button class="view-info">View Info</button></td>
                            </tr>
                            <!-- Row 2 -->
                            <tr>
                                <td>Jane Smith</td>
                                <td>Bike</td>
                                <td><span class="status not-available">Not Available</span></td>
                                <td><button class="view-info">View Info</button></td>
                            </tr>
                            <!-- Row 3 -->
                            <tr>
                                <td>Michael Johnson</td>
                                <td>Van</td>
                                <td><span class="status available">Available</span></td>
                                <td><button class="view-info">View Info</button></td>
                            </tr>
                            <!-- Row 4 -->
                            <tr>
                                <td>Emma White</td>
                                <td>Truck</td>
                                <td><span class="status not-available">Not Available</span></td>
                                <td><button class="view-info">View Info</button></td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
    <script src="assets/availability.js"></script>
</body>
</html>
