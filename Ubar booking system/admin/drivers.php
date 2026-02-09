<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['admin_id'])) { ?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }

$admin_name = $_SESSION['admin_name'];
$admin_id = $_SESSION['admin_id'];
// approve / block driver
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action == 'approve') {
        mysqli_query($link, "UPDATE drivers SET status='approved' WHERE id=$id");
    }
    if ($action == 'block') {
        mysqli_query($link, "UPDATE drivers SET status='blocked' WHERE id=$id");
    }
    if ($action == 'unblock') {
        mysqli_query($link, "UPDATE drivers SET status='approved' WHERE id=$id");
    }

    header("Location: drivers.php");
    exit();
}

$sql = "
SELECT 
    d.id,
    d.full_name,
    d.email,
    d.mobile,
    d.license_number,
    d.vehicle_type,
    d.availability,
    d.status,
    d.created_at,
    ROUND(AVG(r.rating),1) AS avg_rating,
    COUNT(r.id) AS total_reviews
FROM drivers d
LEFT JOIN ratings r ON r.driver_id = d.id
GROUP BY d.id
ORDER BY d.created_at DESC
";
$result = mysqli_query($link, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drivers | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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

        .btn-toggle {
            background: #000;
            color: #facc15;
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
            min-width: 1100px;
        }

        th,
        td {
            padding: 12px;
            font-size: 14px;
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

        .pending {
            background: #fff7ed;
            color: #c2410c
        }

        .approved {
            background: #ecfdf5;
            color: #047857
        }

        .blocked {
            background: #fef2f2;
            color: #b91c1c
        }

        .online {
            color: #047857;
            font-weight: 700
        }

        .offline {
            color: #6b7280
        }

        .btn {
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            margin-right: 6px;
        }

        .btn-approve {
            background: #000;
            color: #facc15
        }

        .btn-block {
            background: #b91c1c;
            color: #fff
        }

        .btn-unblock {
            background: #047857;
            color: #fff
        }

        .action-btn {
            padding: 8px 10px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: 0.2s;
        }

        .btn-approve {
            background: #047857;
            color: #fff;
        }

        .btn-block {
            background: #b91c1c;
            color: #fff;
        }

        .btn-unblock {
            background: #1d4ed8;
            color: #fff;
        }

        .btn-edit {
            background: #000;
            color: #facc15;
        }

        .btn-delete {
            background: #374151;
            color: #fff;
        }

        .action-btn:hover {
            opacity: 0.85;
            transform: translateY(-1px);
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
                <h3>Hello, <?= $admin_name; ?> 👋</h3>
                <p>Admin Dashboard</p>
            </div>
            <div class="menu">
                <a href="dashboard.php">📊 Dashboard</a>
                <a href="users.php">👤 Users</a>
                <a class="active" href="drivers.php">🚖 Drivers</a>
                <a href="admins.php">👑 Admins</a>
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
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
                    <h2>Manage <span style="color:#facc15">Drivers</span></h2>
                    <a href="add_drivers.php" class="btn btn-toggle">➕ Add users</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>License</th>
                            <!-- <th>Vehicle</th> -->
                            <th>Availability</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Rating</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            extract($row);
                        ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $full_name; ?></td>
                                <td><?= $email; ?></td>
                                <td><?= $mobile; ?></td>
                                <td><?= $license_number; ?></td>
                                <!-- <td><?= $vehicle_type; ?></td> -->
                                <td class="<?= $availability; ?>">
                                    <?= $availability; ?>
                                </td>
                                <td>
                                    <span class="badge <?= $status; ?>">
                                        <?= $status; ?>
                                    </span>
                                </td>
                                <td><?= date("d M Y", strtotime($created_at)); ?></td>

                                <td>
                                    <?php if ($avg_rating) { ?>
                                        <span style="color:#facc15; font-weight:700;">
                                            <?= str_repeat("★", floor($avg_rating)); ?>
                                            <?= $avg_rating; ?>/5
                                        </span>
                                        <br>
                                        <small style="color:#6b7280;">
                                            (<?= $total_reviews; ?> reviews)
                                        </small>
                                    <?php } else { ?>
                                        <span style="color:#9ca3af;">No ratings</span>
                                    <?php } ?>
                                </td>


                                <td>
                                    <?php if ($status == 'approved') { ?>
                                        <a class="action-btn btn-block"
                                            href="submit/approved_blocked_drivers.php?action=blocked&driver_id=<?= $id; ?>"
                                            onclick="return confirm('Block this driver?')">
                                            <i class="fa fa-ban"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a class="action-btn btn-approve"
                                            href="submit/approved_blocked_drivers.php?action=approved&driver_id=<?= $id; ?>"
                                            onclick="return confirm('Approve this driver?')">
                                            <i class="fa fa-check"></i>
                                        </a>
                                    <?php } ?>

                                    <a class="action-btn btn-edit"
                                        href="edit_drivers.php?driver_id=<?= $id; ?>">
                                        <i class="fa fa-pen-to-square"></i>
                                    </a>

                                    <a class="action-btn btn-delete"
                                        href="submit/delete_drivers.php?drivers_id=<?= $id; ?>"
                                        onclick="return confirm('Delete this driver permanently?')">
                                        <i class="fa fa-trash"></i>
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