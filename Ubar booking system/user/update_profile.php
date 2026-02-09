<?php
session_start();
require_once('../config/db.php');

if (!isset($_SESSION['user_id'])) { ?>
    <script>
        alert("Login required!");
        window.location.href = "../auth/login.php";
    </script>
<?php }

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

$sql = "select * from users where id=$user_id";
$result = mysqli_query($link, $sql) or die(mysqli_errno($link));
$row = mysqli_fetch_assoc($result);
extract($row);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Profile | CabRide</title>
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
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border: 1px solid #facc15;
            box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.25);
        }

        input[readonly] {
            background: #f3f4f6;
            cursor: not-allowed;
        }

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
            display: inline-block;
            text-align: center;
            text-decoration: none;
            color: #000;
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
                <h3>Hello, <?= $user_name; ?> 👋</h3>
                <p>User Dashboard</p>
            </div>

            <div class="menu">
                <a href="dashboard.php">🏠 Dashboard</a>
                <a href="book_ride.php">🚖 Book Ride</a>
                <a href="track_ride.php">📍 Track Ride</a>
                <a href="ride_history.php">📜 Ride History</a>
                <a class="active" href="profile.php">👤 Profile</a>
                <a href="logout.php">🚪 Logout</a>
            </div>
        </div>

        <!-- Main -->
        <div class="main">

            <div class="topbar">
                <h2>Update <span>Profile</span></h2>
                <small style="color:#6b7280;">CabRide • User Panel</small>
            </div>

            <div class="card">
                <h3>✏️ Edit Your Details</h3>
                <p>Upload image (JPG/PNG max 2MB) then update profile.</p>

                <!-- ✅ Redirect to backend update page -->
                <form id="updateForm" method="POST" action="submit\update_info.php" enctype="multipart/form-data">
                    <div class="update-grid">

                        <!-- Image Upload -->
                        <div class="photo-box">
                            <div class="photo">
                                <img id="previewImg" src="../assets/images/<?= $img; ?>" alt="Profile">
                            </div>

                            <!-- ✅ Upload Click Button -->
                            <label for="profile_image" class="upload-btn">📷 Upload New Photo</label>
                            <input type="file" id="profile_image" name="profile_image" accept="image/*">

                            <div class="note">
                                Allowed: JPG, JPEG, PNG <br> Max size: 2MB
                            </div>

                            <div id="imgMsg" class="validation-msg bad">
                                ⚠️ Please upload a valid image
                            </div>
                        </div>

                        <!-- Form -->
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
                                <label>Mobile Number</label>
                                <input type="text" name="mobile" value="<?= $mobile; ?>" required>
                            </div>

                            <!-- ✅ Only ONE Update Button -->
                            <button id="updateBtn" type="submit" class="btn" disabled>
                                ✅ Update Profile
                            </button>

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

        const allowedTypes = ["image/jpeg", "image/jpg", "image/png"];
        const maxSize = 2 * 1024 * 1024; // 2MB

        // ✅ Button enabled by default (because default image exists)
        updateBtn.disabled = false;
        imgMsg.classList.remove("bad");
        imgMsg.classList.add("ok");
        imgMsg.innerText = "✅ Default image loaded. You can update profile.";

        function setInvalid(text) {
            imgMsg.classList.remove("ok");
            imgMsg.classList.add("bad");
            imgMsg.innerText = "❌ " + text;
            updateBtn.disabled = true;
        }

        function setValid(text) {
            imgMsg.classList.remove("bad");
            imgMsg.classList.add("ok");
            imgMsg.innerText = "✅ " + text;
            updateBtn.disabled = false;
        }

        fileInput.addEventListener("change", function() {
            const file = this.files[0];

            // ✅ If user cancels selection, keep update enabled
            if (!file) {
                setValid("No new image selected. You can update profile.");
                return;
            }

            // ✅ Type validation
            if (!allowedTypes.includes(file.type)) {
                this.value = "";
                setInvalid("Only JPG, JPEG, PNG allowed");
                return;
            }

            // ✅ Size validation
            if (file.size > maxSize) {
                this.value = "";
                setInvalid("Image size must be less than 2MB");
                return;
            }

            // ✅ Preview image
            const reader = new FileReader();
            reader.onload = (e) => previewImg.src = e.target.result;
            reader.readAsDataURL(file);

            setValid("Image is valid. You can update now ✅");
        });
    </script>

</body>

</html>