<?php
session_start();
include("../config/db.php");

/* ✅ Use after login
if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}
*/

$user_id = $_SESSION['user_id'] ?? 1; // demo user id
$msg = "";

/* ✅ Fetch User Data */
$user_sql = "SELECT * FROM users WHERE id = '$user_id' LIMIT 1";
$user_res = mysqli_query($link, $user_sql);

if(mysqli_num_rows($user_res) == 1){
    $user = mysqli_fetch_assoc($user_res);
}else{
    die("User not found!");
}

/* ✅ Update Profile */
if(isset($_POST['update_profile'])){
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $mobile    = mysqli_real_escape_string($conn, $_POST['mobile']);

    if($full_name == "" || $mobile == ""){
        $msg = "<div class='alert error'>❌ Please fill all fields!</div>";
    }else{
        $update_sql = "UPDATE users SET full_name='$full_name', mobile='$mobile' WHERE id='$user_id'";
        if(mysqli_query($conn, $update_sql)){
            $msg = "<div class='alert success'>✅ Profile Updated Successfully!</div>";

            // refresh updated data
            $user_res = mysqli_query($conn, $user_sql);
            $user = mysqli_fetch_assoc($user_res);
        }else{
            $msg = "<div class='alert error'>❌ Error: ".mysqli_error($conn)."</div>";
        }
    }
}

$user_name = $user['full_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Profile | CabRide</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}
body{
    background:#f9fafb;
    color:#111827;
}

/* Layout */
.wrapper{
    display:flex;
    min-height:100vh;
}

/* Sidebar */
.sidebar{
    width:260px;
    background:#fff;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    padding:25px 20px;
    position:sticky;
    top:0;
    height:100vh;
}
.brand{
    font-size:22px;
    font-weight:700;
    color:#facc15;
    margin-bottom:25px;
}
.profile-box{
    background:#f9fafb;
    border-radius:16px;
    padding:18px;
    margin-bottom:25px;
    border:1px solid #f1f5f9;
}
.profile-box h3{
    font-size:16px;
    margin-bottom:3px;
}
.profile-box p{
    font-size:13px;
    color:#6b7280;
}
.menu a{
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px 14px;
    border-radius:14px;
    text-decoration:none;
    color:#374151;
    font-weight:500;
    margin-bottom:10px;
    transition:0.25s;
}
.menu a:hover{
    background:#facc15;
    color:#000;
}
.menu a.active{
    background:#facc15;
    color:#000;
}

/* Main */
.main{
    flex:1;
    padding:30px;
}

/* Topbar */
.topbar{
    background:#fff;
    padding:18px 22px;
    border-radius:18px;
    box-shadow:0 10px 30px rgba(0,0,0,0.06);
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:25px;
}
.topbar h2{
    font-size:20px;
}
.topbar span{
    color:#facc15;
    font-weight:700;
}

/* Profile Card */
.card{
    background:#fff;
    padding:22px;
    border-radius:18px;
    box-shadow:0 10px 30px rgba(0,0,0,0.06);
    border:1px solid #f1f5f9;
    max-width:720px;
}
.card h3{
    margin-bottom:15px;
    font-size:20px;
}
.form-group{
    margin-bottom:14px;
}
label{
    font-size:14px;
    font-weight:600;
    display:block;
    margin-bottom:6px;
}
input{
    width:100%;
    padding:12px 14px;
    border-radius:14px;
    border:1px solid #e5e7eb;
    outline:none;
    font-size:14px;
}
input:focus{
    border:1px solid #facc15;
    box-shadow:0 0 0 3px rgba(250,204,21,0.25);
}
input[readonly]{
    background:#f3f4f6;
    cursor:not-allowed;
}
button{
    width:100%;
    padding:12px;
    background:#000;
    color:#facc15;
    border:none;
    border-radius:14px;
    font-size:15px;
    font-weight:700;
    cursor:pointer;
}
button:hover{
    opacity:0.9;
}

/* Alert */
.alert{
    padding:12px 14px;
    border-radius:14px;
    margin-bottom:15px;
    font-size:14px;
    font-weight:600;
}
.success{ background:#ecfdf5; color:#047857; }
.error{ background:#fef2f2; color:#b91c1c; }

/* Responsive */
@media(max-width:900px){
    .sidebar{
        display:none;
    }
    .main{
        padding:18px;
    }
    .card{
        max-width:100%;
    }
}
</style>
</head>

<body>
<div class="wrapper">

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">CabRide</div>

        <div class="profile-box">
            <h3>Hello, <?= htmlspecialchars($user_name); ?> 👋</h3>
            <p>User Dashboard</p>
        </div>

        <div class="menu">
            <a href="dashboard.php">🏠 Dashboard</a>
            <a href="book_ride.php">🚖 Book Ride</a>
            <a href="track_ride.php">📍 Track Ride</a>
            <a href="ride_history.php">📜 Ride History</a>
            <a class="active" href="profile.php">👤 Profile</a>
            <a href="../auth/logout.php">🚪 Logout</a>
        </div>
    </div>

    <!-- Main -->
    <div class="main">

        <!-- Topbar -->
        <div class="topbar">
            <h2>Profile, <span><?= htmlspecialchars($user_name); ?></span></h2>
            <small style="color:#6b7280;">CabRide • User Panel</small>
        </div>

        <?= $msg; ?>

        <div class="card">
            <h3>👤 My Profile</h3>

            <form method="POST">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="<?= htmlspecialchars($user['email']); ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" name="mobile" value="<?= htmlspecialchars($user['mobile']); ?>" required>
                </div>

                <button type="submit" name="update_profile">✅ Update Profile</button>
            </form>
        </div>

    </div>
</div>

</body>
</html>
