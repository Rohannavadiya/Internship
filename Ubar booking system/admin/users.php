<?php
session_start();
include("../config/db.php");

/* after admin login
if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}
*/
$admin_name=$_SESSION['admin_name'];
$admin_id=$_SESSION['admin_id'];
// handle status toggle
if (isset($_GET['toggle'])) {
    $id = intval($_GET['toggle']);

    mysqli_query($link, "
        UPDATE users 
        SET status = IF(status='active','inactive','active')
        WHERE id = $id
    ");

    header("Location: users.php");
    exit();
}

// fetch users
$result = mysqli_query($link, "
    SELECT id, full_name, email, mobile, status, created_at
    FROM users
    ORDER BY created_at DESC
");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Users | Admin Panel</title>
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

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
            padding: 25px;
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
            font-weight: 600;
        }

        .menu a.active,
        .menu a:hover {
            background: #facc15;
            color: #000;
        }

        /* Main */
        .main {
            flex: 1;
            padding: 30px
        }

         /* Topbar */
        .topbar {
            background: #fff;
            padding: 18px 22px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .topbar h2 {
            font-size: 20px;
        }

        .topbar span {
            color: #facc15;
            font-weight: 700;
        }


        /* Table */
        .card {
            background: #fff;
            padding: 18px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            font-size: 14px;
            text-align: left;
        }

        th {
            background: #f9fafb;
            color: #6b7280;
        }

        tr:not(:last-child) td {
            border-bottom: 1px solid #f1f5f9;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .active {
            background: #ecfdf5;
            color: #047857
        }

        .inactive {
            background: #fef2f2;
            color: #b91c1c
        }

        .btn {
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
        }

        .btn-toggle {
            background: #000;
            color: #facc15;
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
                <a class="active" href="users.php">👤 Users</a>
                <a href="drivers.php">🚖 Drivers</a>
                <a href="rides.php">📍 Rides</a>
                <a href="payments.php">💰 Payments</a>
                <a href="ratings.php">⭐ Ratings</a>
                <a href="logout.php">🚪 Logout</a>
            </div>
        </div>

        <!-- Main -->
        <div class="main">

            <div class="topbar">
                 <h2>Welcome, <span>Admin</span></h2>
                <small style="color:#6b7280;">CabRide • Admin Panel</small>
            </div>

            <div class="card">
                <h2>Manage <span>Users</span></h2>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= htmlspecialchars($row['full_name']); ?></td>
                                <td><?= htmlspecialchars($row['email']); ?></td>
                                <td><?= htmlspecialchars($row['mobile']); ?></td>
                                <td>
                                    <span class="badge <?= $row['status']; ?>">
                                        <?= ucfirst($row['status']); ?>
                                    </span>
                                </td>
                                <td><?= date("d M Y", strtotime($row['created_at'])); ?></td>
                                <td>
                                    <a class="btn btn-toggle"
                                        href="users.php?toggle=<?= $row['id']; ?>"
                                        onclick="return confirm('Change user status?')">
                                        <?= $row['status'] == 'active' ? 'Deactivate' : 'Activate'; ?>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

</html>