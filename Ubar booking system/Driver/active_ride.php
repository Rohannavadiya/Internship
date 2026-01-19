<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Active Ride | Driver</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}
body{
    background:#f9fafb;
}

/* Sidebar */
.sidebar{
    width:220px;
    height:100vh;
    position:fixed;
    background:#fff;
    border-right:1px solid #e5e7eb;
    padding:20px;
}
.sidebar h2{
    color:#facc15;
    text-align:center;
    margin-bottom:30px;
}
.sidebar a{
    display:block;
    padding:12px;
    border-radius:8px;
    color:#374151;
    text-decoration:none;
    margin-bottom:10px;
}
.sidebar a i{
    margin-right:10px;
    color:#facc15;
}
.sidebar a:hover{
    background:#facc15;
    color:#000;
}
.sidebar a:hover i{
    color:#000;
}

/* Main */
.main{
    margin-left:220px;
    padding:25px;
}

/* Header */
.header{
    background:#fff;
    padding:15px 20px;
    border-radius:15px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

/* Ride Card */
.active-ride{
    margin-top:30px;
    max-width:700px;
    background:#fff;
    padding:25px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}
.active-ride h3{
    margin-bottom:15px;
    color:#111827;
}
.ride-info{
    font-size:15px;
    color:#374151;
    margin-bottom:8px;
}
.ride-info i{
    color:#facc15;
    margin-right:8px;
}

/* Status */
.status{
    margin:15px 0;
    font-weight:600;
    color:#22c55e;
}

/* Buttons */
.actions{
    display:flex;
    gap:15px;
    margin-top:20px;
}
.btn{
    flex:1;
    padding:12px;
    border:none;
    border-radius:14px;
    font-weight:600;
    cursor:pointer;
}
.btn-start{
    background:#facc15;
    color:#000;
}
.btn-complete{
    background:#22c55e;
    color:#fff;
}
.btn-cancel{
    background:#ef4444;
    color:#fff;
}

/* Empty state */
.empty{
    text-align:center;
    margin-top:80px;
    color:#6b7280;
}
.empty i{
    font-size:40px;
    color:#facc15;
    margin-bottom:10px;
}

/* Responsive */
@media(max-width:768px){
    .sidebar{
        width:100%;
        height:auto;
        position:relative;
    }
    .main{
        margin-left:0;
    }
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Driver</h2>
    <a href="dashboard.php"><i class="fa fa-home"></i>Dashboard</a>
    <a href="ride_requests.php"><i class="fa fa-car"></i>Ride Requests</a>
    <a href="active_ride.php"><i class="fa fa-route"></i>Active Ride</a>
    <a href="ride_history.php"><i class="fa fa-clock"></i>Ride History</a>
    <a href="earnings.php"><i class="fa fa-wallet"></i>Earnings</a>
    <a href="../auth/logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
</div>

<!-- MAIN -->
<div class="main">

    <div class="header">
        <h3>Active Ride</h3>
        <span>Status: <strong style="color:#22c55e;">On Trip</strong></span>
    </div>

    <!-- ACTIVE RIDE CARD -->
    <div class="active-ride">

        <h3>Ride in Progress</h3>

        <div class="ride-info">
            <i class="fa fa-user"></i> Passenger: Rahul Sharma
        </div>
        <div class="ride-info">
            <i class="fa fa-location-dot"></i> Pickup: City Mall
        </div>
        <div class="ride-info">
            <i class="fa fa-flag-checkered"></i> Drop: Airport
        </div>
        <div class="ride-info">
            <i class="fa fa-road"></i> Distance: 12 km
        </div>
        <div class="ride-info">
            <i class="fa fa-rupee-sign"></i> Fare: ₹450
        </div>

        <div class="status">
            <i class="fa fa-circle"></i> Ride Started
        </div>

        <div class="actions">
            <button class="btn btn-start">Navigate</button>
            <button class="btn btn-complete">Complete Ride</button>
            <button class="btn btn-cancel">Cancel Ride</button>
        </div>

    </div>

    <!-- EMPTY STATE (USE WHEN NO ACTIVE RIDE) -->
    <!--
    <div class="empty">
        <i class="fa fa-route"></i>
        <p>No active ride at the moment</p>
    </div>
    -->

</div>

</body>
</html>
