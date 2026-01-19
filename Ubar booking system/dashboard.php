<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard | Cab Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f9fafb;
            color: #111827;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #fff;
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px;
            border-right: 1px solid #e5e7eb;
        }

        .sidebar h2 {
            text-align: center;
            color: #facc15;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px;
            color: #374151;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .sidebar a i {
            margin-right: 10px;
            color: #facc15;
        }

        .sidebar a:hover {
            background: #facc15;
            color: #000;
        }

        /* Main */
        .main {
            margin-left: 220px;
            padding: 25px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            padding: 15px 20px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .header h3 {
            color: #111827;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #facc15;
        }

        /* Cards */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card i {
            font-size: 28px;
            color: #facc15;
        }

        .card h4 {
            margin-top: 10px;
        }

        .card p {
            color: #6b7280;
        }

        /* Actions */
        .actions {
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .action-box {
            background: linear-gradient(135deg, #fde047, #facc15);
            color: #000;
            padding: 25px;
            border-radius: 20px;
        }

        .action-box a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 22px;
            background: #000;
            color: #facc15;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
        }

        /* Responsive */
        @media(max-width:768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2>CabRide</h2>
        <a href="#"><i class="fa fa-home"></i>Dashboard</a>
        <a href="#"><i class="fa fa-car"></i>Book Ride</a>
        <a href="#"><i class="fa fa-list"></i>Ride History</a>
        <a href="#"><i class="fa fa-wallet"></i>Payments</a>
        <a href="#"><i class="fa fa-user"></i>Profile</a>
        <a href="#"><i class="fa fa-sign-out-alt"></i>Logout</a>
    </div>

    <div class="main">

        <div class="header">
            <h3>Welcome, User / Driver</h3>
            <div class="profile">
                <span>Online</span>
                <img src="https://i.pravatar.cc/100">
            </div>
        </div>

        <div class="cards">
            <div class="card">
                <i class="fa fa-route"></i>
                <h4>Total Rides</h4>
                <p>120</p>
            </div>
            <div class="card">
                <i class="fa fa-star"></i>
                <h4>Rating</h4>
                <p>4.8</p>
            </div>
            <div class="card">
                <i class="fa fa-wallet"></i>
                <h4>Earnings</h4>
                <p>₹15,000</p>
            </div>
            <div class="card">
                <i class="fa fa-signal"></i>
                <h4>Status</h4>
                <p>Active</p>
            </div>
        </div>

        <div class="actions">
            <div class="action-box">
                <h3>Book a Ride</h3>
                <p>Quick and reliable booking</p>
                <a href="#">Book Now</a>
            </div>
            <div class="action-box">
                <h3>Ride Requests</h3>
                <p>Accept nearby rides</p>
                <a href="#">View</a>
            </div>
        </div>

    </div>

</body>

</html>