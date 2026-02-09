<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Services | CabRide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 40px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #facc15;
        }

        .nav-links a {
            margin-left: 25px;
            text-decoration: none;
            color: #374151;
            font-weight: 500;
        }

        .nav-links a:hover {
            color: #facc15;
        }

        /* Header */
        .page-header {
            background: linear-gradient(135deg, #fde047, #facc15);
            padding: 70px 40px;
            text-align: center;
        }

        /* Services */
        .services {
            padding: 60px 40px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 30px;
        }

        .service {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .service:hover {
            transform: translateY(-8px);
        }

        .service i {
            font-size: 36px;
            color: #facc15;
            margin-bottom: 15px;
        }

        .service p {
            color: #6b7280;
            font-size: 14px;
        }

        /* CTA */
        .cta {
            background: #fff;
            padding: 50px;
            text-align: center;
        }

        .cta a {
            display: inline-block;
            padding: 12px 30px;
            background: #facc15;
            color: #000;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            background: #fff;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">CabRide</div>
        <div class="nav-links">
            <a href="../index.php">Home</a>
            <a href="about.php">About</a>
            <a href="services.php">Services</a>
            <a href="login.php">Login</a>
            <a href="admin_login.php" class="admin-link">Admin</a>
        </div>
    </div>

    <!-- Header -->
    <div class="page-header">
        <h1>Our Services</h1>
        <p>Reliable rides for every need</p>
    </div>

    <!-- Services -->
    <div class="services">
        <div class="service">
            <i class="fa fa-taxi"></i>
            <h3>City Rides</h3>
            <p>Affordable daily rides within the city.</p>
        </div>
        <div class="service">
            <i class="fa fa-road"></i>
            <h3>Outstation</h3>
            <p>Comfortable long-distance travel.</p>
        </div>
        <div class="service">
            <i class="fa fa-clock"></i>
            <h3>24/7 Booking</h3>
            <p>Book rides anytime, anywhere.</p>
        </div>
        <div class="service">
            <i class="fa fa-user-shield"></i>
            <h3>Safe Travel</h3>
            <p>Verified drivers and secure rides.</p>
        </div>
    </div>

    <!-- CTA -->
    <div class="cta">
        <h2>Need a Ride?</h2>
        <p>Book your cab in just a few clicks</p>
        <a href="login.php">Book Now</a>
    </div>

    <!-- Footer -->
    <div class="footer">
        © 2026 Rohan Navadiya. All rights reserved.
    </div>

</body>

</html>