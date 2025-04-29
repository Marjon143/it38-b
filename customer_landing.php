<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Driver</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .booking-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="booking-container">
        <h1>Book Your Driver</h1>
        <form id="bookingForm">
            <input type="text" id="name" placeholder="Your Name" required>
            <input type="text" id="pickup" placeholder="Pickup Location" required>
            <input type="text" id="dropoff" placeholder="Drop-off Location" required>
            <input type="date" id="date" required>
            <input type="time" id="time" required>
            <button type="submit">Book Now</button>
        </form>
        <div id="confirmationMessage" style="display:none; margin-top: 20px; font-size: 18px; color: green;"></div>
    </div>

    <script>
        document.getElementById('bookingForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const name = document.getElementById('name').value;
            const pickup = document.getElementById('pickup').value;
            const dropoff = document.getElementById('dropoff').value;
            const date = document.getElementById('date').value;
            const time = document.getElementById('time').value;
            
            if(name && pickup && dropoff && date && time) {
                document.getElementById('confirmationMessage').style.display = 'block';
                document.getElementById('confirmationMessage').innerText = `Thank you, ${name}! Your driver has been booked from ${pickup} to ${dropoff} on ${date} at ${time}.`;
                
                // Reset the form after submission
                document.getElementById('bookingForm').reset();
            } else {
                alert('Please fill out all fields.');
            }
        });
    </script>

</body>
</html>
