<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About Us | CabRide</title>
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

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #fde047, #facc15);
            padding: 70px 40px;
            text-align: center;
        }

        .page-header h1 {
            font-size: 36px;
        }

        .page-header p {
            margin-top: 10px;
        }

        /* Content */
        .content {
            padding: 60px 40px;
            max-width: 1000px;
            margin: auto;
        }

        .content h2 {
            margin-bottom: 15px;
        }

        .content p {
            color: #6b7280;
            margin-bottom: 20px;
            line-height: 1.7;
        }

        /* Cards */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-top: 40px;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12);
        }


        .card i {
            font-size: 32px;
            color: #facc15;
            margin-bottom: 15px;
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
        <h1>About CabRide</h1>
        <p>Your trusted cab booking partner</p>
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Who We Are</h2>
        <p>
            CabRide is a modern cab booking platform designed to make travel easy,
            safe and affordable. We connect passengers with verified drivers through
            a simple and reliable system.
        </p>

        <h2>Our Mission</h2>
        <p>
            Our mission is to provide comfortable rides at transparent prices while
            creating earning opportunities for drivers.
        </p>

        <div class="cards">
            <div class="card">
                <i class="fa fa-users"></i>
                <h3>Trusted Users</h3>
                <p>Thousands of happy customers</p>
            </div>
            <div class="card">
                <i class="fa fa-car"></i>
                <h3>Verified Drivers</h3>
                <p>Safe & professional rides</p>
            </div>
            <div class="card">
                <i class="fa fa-map-marked-alt"></i>
                <h3>Wide Coverage</h3>
                <p>Available across multiple cities</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        © 2026 Rohan Navadiya. All rights reserved.
    </div>

</body>

</html>