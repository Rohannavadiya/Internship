<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['driver_id'])){?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }

$driver_id   = $_SESSION['driver_id'];
$driver_name = $_SESSION['driver_name'];
$sql = "select * from drivers where id=$driver_id";
$result = mysqli_query($link, $sql) or die(mysqli_errno($link));
$row = mysqli_fetch_assoc($result);
extract($row);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Driver Profile | CabRide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 25px 20px;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .brand {
            font-size: 22px;
            font-weight: 700;
            color: #facc15;
            margin-bottom: 25px;
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

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            text-decoration: none;
            color: #374151;
            font-weight: 500;
            margin-bottom: 10px;
            transition: 0.25s;
        }

        .menu a:hover {
            background: #facc15;
            color: #000;
        }

        .menu a.active {
            background: #facc15;
            color: #000;
        }

        /* Main */
        .main {
            flex: 1;
            padding: 30px;
        }

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

        /* Card */
        .card {
            max-width: 900px;
            background: #fff;
            padding: 22px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
        }

        .card h3 {
            margin-bottom: 6px;
            font-size: 20px;
            font-weight: 800;
        }

        .card p {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .update-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 18px;
        }

        /* Photo */
        .photo-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 18px;
            text-align: center;
        }

        .photo {
            width: 120px;
            height: 120px;
            border-radius: 22px;
            background: linear-gradient(135deg, #fde047, #facc15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            font-weight: 900;
            color: #000;
            margin: 0 auto 12px;
            overflow: hidden;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .upload-btn {
            display: block;
            width: 100%;
            margin-top: 12px;
            background: #000;
            color: #facc15;
            padding: 10px 14px;
            border-radius: 14px;
            font-weight: 900;
            cursor: pointer;
        }

        input[type="file"] {
            display: none;
        }

        .note {
            font-size: 12px;
            color: #6b7280;
            margin-top: 10px;
        }

        .validation-msg {
            margin-top: 10px;
            font-size: 13px;
            font-weight: 800;
        }

        .ok {
            color: #047857;
        }

        .bad {
            color: #b91c1c;
        }

        /* Form */
        .form-group {
            margin-bottom: 14px;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
        }

        input,
        select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            outline: none;
            font-size: 14px;
            background: #fff;
        }

        input:focus,
        select:focus {
            border: 1px solid #facc15;
            box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.25);
        }

        input[readonly] {
            background: #f3f4f6;
            cursor: not-allowed;
        }

        /* Buttons */
        .btn {
            width: 100%;
            padding: 12px;
            background: #000;
            color: #facc15;
            border: none;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 900;
            cursor: pointer;
            transition: 0.25s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .btn-outline {
            width: 100%;
            margin-top: 10px;
            padding: 12px;
            background: #fff;
            border: 2px solid #facc15;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 900;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            color: #000;
            display: inline-block;
        }

        .btn-outline:hover {
            background: #facc15;
        }

        @media(max-width:950px) {
            .update-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width:900px) {
            .sidebar {
                display: none;
            }

            .main {
                padding: 18px;
            }

            .card {
                max-width: 100%;
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
                <h3>Hello, <?= $driver_name; ?> 👋</h3>
                <p>Driver Dashboard</p>
            </div>

            <div class="menu">
                <a href="dashboard.php">🏠 Dashboard</a>
                <a href="ride_requests.php">📥 Ride Requests</a>
                <a href="my_rides.php">🚖 My Rides</a>
                <a href="earnings.php">💰 Earnings</a>
                <a class="active" href="profile.php">👤 Profile</a>
                <a href="logout.php">🚪 Logout</a>
            </div>
        </div>

        <!-- Main -->
        <div class="main">

            <div class="topbar">
                <h2>Update <span>Driver Profile</span></h2>
                <small style="color:#6b7280;">CabRide • Driver Panel</small>
            </div>

            <div class="card">
                <h3>✏️ Edit Your Details</h3>
                <p>Upload image (JPG/PNG max 2MB) then update profile.</p>

                <!-- ✅ Redirect to backend -->
                <form method="POST" action="submit\update_info.php" enctype="multipart/form-data">
                    <div class="update-grid">

                        <!-- Photo Upload -->
                        <div class="photo-box">
                            <div class="photo">
                                <img id="previewImg" src="../assets/images/<?= $img; ?>" alt="Profile">
                            </div>

                            <label for="profile_image" class="upload-btn">📷 Upload New Photo</label>
                            <input type="file" id="profile_image" name="profile_image" accept="image/*">

                            <div class="note">
                                Allowed: JPG, JPEG, PNG <br>
                                Max size: 2MB
                            </div>

                            <div id="imgMsg" class="validation-msg ok">
                                ✅ Default image loaded. You can update profile.
                            </div>
                        </div>

                        <!-- Driver Form -->
                        <div>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="full_name" value="<?= $full_name; ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Email (Readonly)</label>
                                <input type="email" value="<?= $email; ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" name="mobile" value="<?= $mobile; ?>" required>
                            </div>

                            <div class="form-group">
                                <label>License Number</label>
                                <input type="text" name="license_number" value="<?= $license_number; ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Vehicle Type</label>
                                <select name="vehicle_type" required>
                                    <option value="Mini" <?= ($vehicle_type == "Mini") ? "selected" : "" ?>>Mini</option>
                                    <option value="Sedan" <?= ($vehicle_type == "Sedan") ? "selected" : "" ?>>Sedan</option>
                                    <option value="SUV" <?= ($vehicle_type == "SUV") ? "selected" : "" ?>>SUV</option>
                                </select>
                            </div>

                            <button id="updateBtn" type="submit" class="btn">✅ Update Profile</button>
                            <a href="profile.php" class="btn-outline">⬅ Back to Profile</a>
                        </div>

                    </div>
                </form>

            </div>

        </div>
    </div>

    <script>
        const fileInput = document.getElementById("profile_image");
        const updateBtn = document.getElementById("updateBtn");
        const imgMsg = document.getElementById("imgMsg");
        const previewImg = document.getElementById("previewImg");

        const defaultImgSrc = previewImg.getAttribute("src");
        const allowedTypes = ["image/jpeg", "image/jpg", "image/png"];
        const maxSize = 2 * 1024 * 1024; // 2MB

        function setInvalid(text) {
            imgMsg.classList.remove("ok");
            imgMsg.classList.add("bad");
            imgMsg.innerText = "❌ " + text;
            previewImg.src = defaultImgSrc; // reset image
            fileInput.value = ""; // clear input
            updateBtn.disabled = true; // disable update
        }

        function setValid(text) {
            imgMsg.classList.remove("bad");
            imgMsg.classList.add("ok");
            imgMsg.innerText = "✅ " + text;
            updateBtn.disabled = false;
        }

        // ✅ button enabled by default
        updateBtn.disabled = false;

        fileInput.addEventListener("change", function() {
            const file = this.files[0];

            // if cancelled
            if (!file) {
                setValid("No new image selected. You can update profile.");
                return;
            }

            // validate type
            if (!allowedTypes.includes(file.type)) {
                setInvalid("Only JPG, JPEG, PNG allowed");
                return;
            }

            // validate size
            if (file.size > maxSize) {
                setInvalid("Image size must be less than 2MB");
                return;
            }

            // ✅ show preview only if valid
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                setValid("Valid image selected. You can update now.");
            }
            reader.readAsDataURL(file);
        });
    </script>

</body>

</html>