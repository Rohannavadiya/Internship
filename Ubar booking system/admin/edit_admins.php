<?php
session_start();
include("../config/db.php");

/* protect page after login
if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}
*/
$admin_name = $_SESSION['admin_name'];
$logged_admin_id = $_SESSION['admin_id'];

// get admin id from URL
if (!isset($_GET['admin_id'])) {
    header("Location: admins.php");
    exit();
}

$admin_id = intval($_GET['admin_id']);

// fetch admin data
$result = mysqli_query($link, "SELECT * FROM admins WHERE id=$admin_id");
if (mysqli_num_rows($result) != 1) {
    die("Admin not found");
}
$admin = mysqli_fetch_assoc($result);

// update admin
if (isset($_POST['update_admin'])) {
    $name  = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);

    // status can be changed ONLY if not self
    if ($logged_admin_id != $admin_id) {
        $status = $_POST['status'];
        $sql = "UPDATE admins SET name='$name', email='$email', status='$status' WHERE id=$admin_id";
    } else {
        $sql = "UPDATE admins SET name='$name', email='$email' WHERE id=$admin_id";
    }

    mysqli_query($link, $sql);
    header("Location: admins.php?updated=1");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Admin | CabRide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif
        }

        body {
            background: #f9fafb;
            color: #111827
        }

        .wrapper {
            display: flex;
            min-height: 100vh
        }

        .profile-box {
            background: #f9fafb;
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 25px;
            border: 1px solid #f1f5f9;
        }

        .profile-box h3 {
            font-size: 16px;
            margin-bottom: 3px;
        }

        .profile-box p {
            font-size: 13px;
            color: #6b7280;
        }


        /* sidebar */
        .sidebar {
            width: 260px;
            background: #fff;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08)
        }

        .brand {
            font-size: 22px;
            font-weight: 800;
            color: #facc15;
            margin-bottom: 25px
        }

        .menu a {
            display: block;
            padding: 12px 16px;
            border-radius: 14px;
            margin-bottom: 10px;
            text-decoration: none;
            color: #374151;
            font-weight: 600
        }

        .menu a.active,
        .menu a:hover {
            background: #facc15;
            color: #000
        }

        /* main */
        .main {
            flex: 1;
            padding: 30px
        }

        .topbar {
            background: #fff;
            padding: 18px 22px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
            margin-bottom: 25px
        }

        .card {
            max-width: 700px;
            background: #fff;
            padding: 22px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .06)
        }

        .form-group {
            margin-bottom: 15px
        }

        label {
            font-weight: 600;
            font-size: 14px;
            display: block;
            margin-bottom: 6px
        }

        input,
        select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid #e5e7eb
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #facc15;
            box-shadow: 0 0 0 3px rgba(250, 204, 21, .25)
        }

        .btn {
            padding: 12px 20px;
            border-radius: 14px;
            background: #000;
            color: #facc15;
            font-weight: 700;
            border: none;
            cursor: pointer
        }

        .btn-outline {
            margin-left: 10px;
            background: #fff;
            border: 2px solid #facc15;
            color: #000;
            text-decoration: none
        }

        .btn:hover {
            opacity: .9
        }

        @media(max-width:900px) {
            .sidebar {
                display: none
            }

            .main {
                padding: 18px
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="brand">CabRide Admin</div>
            <div class="profile-box">
                <h3>Hello, <?= htmlspecialchars($admin_name); ?> 👋</h3>
                <p>Admin Dashboard</p>
            </div>
            <div class="menu">
                <a href="dashboard.php">📊 Dashboard</a>
                <a href="users.php">👤 Users</a>
                <a href="drivers.php">🚖 Drivers</a>
                <a class="active" href="admins.php">👑 Admins</a>
                <a href="rides.php">📍 Rides</a>
                <a href="payments.php">💰 Payments</a>
                <a href="ratings.php">⭐ Ratings</a>
                <a href="logout.php">🚪 Logout</a>
            </div>
        </div>

        <!-- Main -->
        <div class="main">

            <div class="topbar">
                <h2>Edit <span style="color:#facc15">Admin</span></h2>
            </div>

            <div class="card">
                <form method="POST">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($admin['name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($admin['email']); ?>" required>
                    </div>

                    <?php if ($logged_admin_id != $admin_id) { ?>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status">
                                <option value="active" <?= $admin['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?= $admin['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                    <?php } else { ?>
                        <p style="color:#b91c1c;font-weight:600">
                            ⚠️ You cannot change your own status
                        </p>
                    <?php } ?>

                    <button type="submit" name="update_admin" class="btn">💾 Update Admin</button>
                    <a href="admins.php" class="btn btn-outline">⬅ Back</a>

                </form>
            </div>

        </div>
    </div>
</body>

</html>