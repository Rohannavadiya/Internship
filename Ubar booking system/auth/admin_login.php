<?php
session_start();
include("../config/db.php");

// If already logged in
// if (isset($_SESSION['admin_id'])) {
//     header("Location: dashboard.php");
//     exit();
// }

$msg = "";

if (isset($_POST['login'])) {
    $email    = mysqli_real_escape_string($link, $_POST['email']);
    $password = $_POST['password'];

    if ($email == "" || $password == "") {
        $msg = "❌ Please fill all fields";
    } else {
        $sql = "SELECT * FROM admins WHERE email='$email' LIMIT 1";
        $res = mysqli_query($link, $sql);

        if (mysqli_num_rows($res) == 1) {
            $admin = mysqli_fetch_assoc($res);

            if (password_verify($password, $admin['password'])) {
                $_SESSION['admin_id']   = $admin['id'];
                $_SESSION['admin_name'] = $admin['name'];

                header("Location: dashboard.php");
                exit();
            } else {
                $msg = "❌ Invalid password";
            }
        } else {
            $msg = "❌ Admin not found";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login | CabRide</title>
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
            min-height: 100vh;
            background: linear-gradient(135deg, #fde047, #facc15);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            padding: 28px;
            border-radius: 22px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .15);
        }

        .brand {
            text-align: center;
            font-size: 26px;
            font-weight: 900;
            color: #facc15;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            font-size: 14px;
            outline: none;
        }

        input:focus {
            border-color: #facc15;
            box-shadow: 0 0 0 3px rgba(250, 204, 21, .25);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #000;
            color: #facc15;
            border: none;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
        }

        button:hover {
            opacity: .9
        }

        .alert {
            background: #fef2f2;
            color: #b91c1c;
            padding: 10px 14px;
            border-radius: 12px;
            margin-bottom: 14px;
            font-size: 14px;
            font-weight: 700;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="brand">CabRide</div>
        <div class="subtitle">Admin Panel Login</div>

        <?php if ($msg != "") { ?>
            <div class="alert"><?= $msg; ?></div>
        <?php } ?>

        <form method="POST" action="admin_login_verify.php">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="mail" placeholder="admin@example.com">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="pass" placeholder="••••••••">
            </div>

            <button type="submit" name="login">🔐 Login</button>
        </form>
    </div>
</body>

</html>