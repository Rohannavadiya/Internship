<?php
include("config/db.php");

$avg_rating = 0;
$total_reviews = 0;

$result = mysqli_query($link, "
    SELECT 
    ROUND(AVG(rating),1) AS avg_rating, 
    COUNT(*) AS total_reviews
    FROM ratings WHERE is_visible = 1
");

if ($row = mysqli_fetch_assoc($result)) {
    $avg_rating = $row['avg_rating'] ?? 0;
    $total_reviews = $row['total_reviews'] ?? 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CabRide | Book Your Ride</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
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
            font-size: 25px;
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

        /* Hero */
        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 80px 40px;
        }

        .hero-text {
            max-width: 520px;
        }

        .hero-text h1 {
            font-size: 42px;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-text h1 span {
            color: #facc15;
        }

        .hero-text p {
            color: #6b7280;
            margin-bottom: 30px;
        }

        .hero-buttons a {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            margin-right: 15px;
        }

        .btn-yellow {
            background: #facc15;
            color: #000;
        }

        .btn-outline {
            border: 2px solid #facc15;
            color: #facc15;
        }

        /* Features */
        .features {
            background: #fff;
            padding: 60px 40px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
        }

        .feature {
            background: #f9fafb;
            padding: 25px;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .feature:hover {
            transform: translateY(-6px);
        }

        .feature i {
            font-size: 32px;
            color: #facc15;
            margin-bottom: 15px;
        }

        .feature h3 {
            margin-bottom: 10px;
        }

        .feature p {
            color: #6b7280;
            font-size: 14px;
        }

        /* Call To Action */
        .cta {
            background: linear-gradient(135deg, #fde047, #facc15);
            padding: 60px 40px;
            text-align: center;
        }

        .cta h2 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .cta p {
            margin-bottom: 25px;
        }

        .cta a {
            display: inline-block;
            padding: 12px 30px;
            background: #000;
            color: #facc15;
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

        .admin-link {
            font-size: 14px;
            color: #9ca3af;
            /* gray */
        }

        .admin-link:hover {
            color: #facc15;
            /* yellow on hover */
        }

        /* Responsive */
        @media(max-width:900px) {
            .hero {
                flex-direction: column;
                text-align: center;
            }

            .hero-buttons a {
                margin-bottom: 15px;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">CabRide</div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="auth/about.php">About</a>
            <a href="auth/services.php">Services</a>
            <a href="auth/login.php">Login</a>
            <a href="auth/admin_login.php" class="admin-link">Admin</a>
        </div>
    </div>


    <!-- Hero -->
    <section class="hero">
        <div class="hero-text">
            <h1>Your Ride, <span>Your Way</span></h1>
            <p>Fast, safe and affordable cab booking platform for your daily and long-distance travel.</p>
            <div class="hero-buttons">
                <a href="Auth/register.php?role=driver" class="btn-outline">Become a Driver</a>
                <a href="Auth/login.php" class="btn-yellow">Book a Ride</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="assets/images/car.png" width="380" alt="Cab">
        </div>
    </section>

    <!-- Features -->
    <section class="features">
        <div class="feature">
            <i class="fa fa-clock"></i>
            <h3>24/7 Availability</h3>
            <p>Book your ride anytime, anywhere.</p>
        </div>
        <div class="feature">
            <i class="fa fa-shield-alt"></i>
            <h3>Safe Travel</h3>
            <p>Verified drivers and secure rides.</p>
        </div>
        <div class="feature">
            <i class="fa fa-wallet"></i>
            <h3>Affordable Pricing</h3>
            <p>No hidden charges, transparent fares.</p>
        </div>
        <div class="feature">
            <i class="fa fa-map-marker-alt"></i>
            <h3>Live Tracking</h3>
            <p>Track your cab in real time.</p>
        </div>
        <div class="feature">
            <i class="fa fa-star"></i>

            <h3><?= $avg_rating ?>/5 Rating</h3>

            <p>
                Rated by <?= $total_reviews ?> happy riders
            </p>

            <div style="font-size:18px; color:#facc15; margin-top:6px;">
                <?php
                for ($i = 1; $i <= 5; $i++) {
                    echo $i <= round($avg_rating) ? "★" : "☆";
                }
                ?>
            </div>
        </div>

    </section>

    <!-- CTA -->
    <section class="cta">
        <h2>Ready to Ride?</h2>
        <p>Join thousands of happy users and drivers today</p>
        <a href="Auth/login.php">Get Started</a>
    </section>

    <!-- Footer -->
    <div class="footer">
        © 2026 Rohan Navadiya. All rights reserved.
    </div>
</body>

</html>