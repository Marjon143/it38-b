<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Dashboard - Availability</title>
</head>
<body>
    <section class="header">
        <div class="logo">
            <i class="ri-menu-line icon icon-0 menu"></i>
            <h2>Med<span>Ex</span></h2>
        </div>
        <div class="search--notification--profile">
            <div class="search">
                <input type="text" placeholder="Search Rider Availability..">
                <button><i class="ri-search-2-line"></i></button>
            </div>
            <div class="notification--profile">
                <div class="picon lock">
                    <i class="ri-lock-line"></i>
                </div>
                <div class="picon bell">
                    <i class="ri-notification-2-line"></i>
                </div>
                <div class="picon chat">
                    <i class="ri-wechat-2-line"></i>
                </div>
                <div class="picon profile">
                    <img src="assets/images/profile.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="main">
        <div class="sidebar">
            <ul class="sidebar--items">
                <li>
                    <a href="#" id="active--link">
                        <span class="icon icon-1"><i class="ri-layout-grid-line"></i></span>
                        <span class="sidebar--item">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="customer.php">
                        <span class="icon icon-2"><i class="ri-calendar-2-line"></i></span>
                        <span class="sidebar--item">Customers</span>
                    </a>
                </li>
                <li>
                    <a href="booking.php">
                        <span class="icon icon-3"><i class="ri-user-2-line"></i></span>
                        <span class="sidebar--item" style="white-space: nowrap;">Bookings</span>
                    </a>
                </li>
                <li>
                    <a href="availability.php">
                        <span class="icon icon-4"><i class="ri-user-line"></i></span>
                        <span class="sidebar--item">Availability</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon icon-5"><i class="ri-line-chart-line"></i></span>
                        <span class="sidebar--item">Routes</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon icon-6"><i class="ri-customer-service-line"></i></span>
                        <span class="sidebar--item">Reporting</span>
                    </a>
                </li>
            </ul>
            <ul class="sidebar--bottom-items">
                <li>
                    <a href="#">
                        <span class="icon icon-7"><i class="ri-settings-3-line"></i></span>
                        <span class="sidebar--item">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon icon-8"><i class="ri-logout-box-r-line"></i></span>
                        <span class="sidebar--item">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main--content">
            <div class="availability">
                <div class="title">
                    <h2 class="section--title">Available Riders</h2>
                </div>
                <div class="riders--cards">
                    <div class="rider-card">
                        <div class="rider-image">
                            <img src="assets/images/doctor1.jpg" alt="Rider 1">
                        </div>
                        <div class="rider-info">
                            <h3 class="rider-name">John Doe</h3>
                            <p class="rider-vehicle">Vehicle: Bike - Yamaha MT-15</p>
                            <p class="rider-availability">Status: Available</p>
                        </div>
                        <div class="rider-personal-info">
                            <h4>Personal Info</h4>
                            <ul>
                                <li>Name: John Doe</li>
                                <li>Years as Rider: 3 Years</li>
                                <li>Address: 123, Main St, City</li>
                                <li>Tagline: "Ready to ride anytime!"</li>
                            </ul>
                        </div>
                    </div>
                    <div class="rider-card">
                        <div class="rider-image">
                            <img src="assets/images/doctor2.jpg" alt="Rider 2">
                        </div>
                        <div class="rider-info">
                            <h3 class="rider-name">Alice Smith</h3>
                            <p class="rider-vehicle">Vehicle: Car - Honda Civic</p>
                            <p class="rider-availability">Status: Available</p>
                        </div>
                        <div class="rider-personal-info">
                            <h4>Personal Info</h4>
                            <ul>
                                <li>Name: Alice Smith</li>
                                <li>Years as Rider: 5 Years</li>
                                <li>Address: 456, Park Ave, City</li>
                                <li>Tagline: "Driven by passion!"</li>
                            </ul>
                        </div>
                    </div>
                    <div class="rider-card">
                        <div class="rider-image">
                            <img src="assets/images/doctor3.jpg" alt="Rider 3">
                        </div>
                        <div class="rider-info">
                            <h3 class="rider-name">Mark Lee</h3>
                            <p class="rider-vehicle">Vehicle: Bike - KTM Duke</p>
                            <p class="rider-availability">Status: Available</p>
                        </div>
                        <div class="rider-personal-info">
                            <h4>Personal Info</h4>
                            <ul>
                                <li>Name: Mark Lee</li>
                                <li>Years as Rider: 2 Years</li>
                                <li>Address: 789, Elm St, City</li>
                                <li>Tagline: "Always on the move!"</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/dashboard.js"></script>
</body>
</html>
