<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/booking.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Booking Page</title>
</head>
<body>
    <section class="header">
        <!-- Your existing header section -->
    </section>

    <section class="main">
        <div class="sidebar">
            <ul class="sidebar--items">
                <!-- Your existing sidebar items -->
                <li>
                    <a href="dashboard.php">
                        <span class="icon icon-3"><i class="ri-bookmark-line"></i></span>
                        <span class="sidebar--item">Go Back</span>
                    </a>
                </li>
                <!-- Other sidebar items -->
            </ul>
        </div>

        <div class="main--content">
            <!-- Booking Card -->
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h2>Book a Rider</h2>
                    </div>
                    <div class="card-body">
                        <form action="#" method="post" class="booking-form">
                        <div class="form-group">
    <label for="rider">Select Rider</label>
    <select name="rider" id="rider" class="dropdown">
        <option value="rider1" data-status="available">Rider 1 - <span class="status available">Available</span></option>
        <option value="rider2" data-status="not-available">Rider 2 - <span class="status not-available">Not Available</span></option>
        <option value="rider3" data-status="available">Rider 3 - <span class="status available">Available</span></option>
    </select>
</div>


                            <div class="form-group">
                                <label for="vehicle">Select Vehicle Type</label>
                                <select name="vehicle" id="vehicle" class="dropdown">
                                    <option value="car">Car</option>
                                    <option value="bike">Bike</option>
                                    <option value="van">Van</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="date">Select Date</label>
                                <input type="date" id="date" name="date" class="input-field" required>
                            </div>

                            <div class="form-group">
                                <label for="time">Select Time</label>
                                <input type="time" id="time" name="time" class="input-field" required>
                            </div>

                            <div class="form-group">
                                <label for="route">Select Route</label>
                                <select name="route" id="route" class="dropdown">
                                    <option value="route1">Route 1</option>
                                    <option value="route2">Route 2</option>
                                    <option value="route3">Route 3</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="comments">Additional Comments</label>
                                <textarea name="comments" id="comments" rows="4" class="input-field" placeholder="Add any extra details or requests"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="submit-btn">Book Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/booking.js"></script>
</body>
</html>
