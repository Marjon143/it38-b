<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers - MedEx</title>
    <link rel="stylesheet" href="assets/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            color: #333;
        }

        .main {
            display: flex;
            min-height: 100vh;
        }

        .main--content {
            flex: 1;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .card {
            background-color: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .section--title {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .customer--list {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .customer--card {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 1.5rem;
            width: 240px;
            text-align: center;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .customer--card:hover {
            transform: translateY(-5px);
        }

        .customer--image {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            margin-bottom: 1rem;
            object-fit: cover;
            border: 3px solid #0077cc;
        }

        .customer--card h3 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: #0077cc;
        }

        .customer--actions button {
            background-color: #0077cc;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            margin: 0.3rem;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .customer--actions button:hover {
            background-color: #005fa3;
            transform: scale(1.05);
        }

        .customer--history h3 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        .customer--history ul {
            list-style: none;
            padding-left: 1rem;
        }

        .customer--history li {
            margin-bottom: 0.6rem;
            position: relative;
            padding-left: 1.2rem;
            line-height: 1.5;
        }

        .customer--history li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: #0077cc;
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .customer--list {
                flex-direction: column;
                align-items: center;
            }

            .customer--card {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <section class="header">
        <!-- Include header markup here -->
    </section>

    <section class="main">
        <div class="sidebar">
            <!-- Include sidebar markup here -->
        </div>

        <div class="main--content">
            <div class="container">
                <div class="title">
                    <h2 class="section--title">Customers</h2>
                </div>

                <div class="customer--list card">
                    <div class="customer--card">
                        <img src="https://via.placeholder.com/80" alt="John Doe" class="customer--image">
                        <h3>John Doe</h3>
                        <div class="customer--actions">
                            <button>Customer Info</button>
                            <button>History</button>
                        </div>
                    </div>

                    <div class="customer--card">
                        <img src="https://via.placeholder.com/80" alt="Jane Smith" class="customer--image">
                        <h3>Jane Smith</h3>
                        <div class="customer--actions">
                            <button>Customer Info</button>
                            <button>History</button>
                        </div>
                    </div>

                    <div class="customer--card">
                        <img src="https://via.placeholder.com/80" alt="David Park" class="customer--image">
                        <h3>David Park</h3>
                        <div class="customer--actions">
                            <button>Customer Info</button>
                            <button>History</button>
                        </div>
                    </div>
                </div>

                <div class="customer--history card">
                    <h3>Recent Customer History</h3>
                    <ul>
                        <li>John Doe requested a ride on 2025-04-22 at 4:30 PM</li>
                        <li>Jane Smith cancelled a booking on 2025-04-20</li>
                        <li>David Park gave a rating of 5 stars on 2025-04-19</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/dashboard.js"></script>
</body>
</html>
