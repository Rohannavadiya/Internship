<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | CabRide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f9fafb;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Box */
        .login-box {
            width: 100%;
            max-width: 420px;
            background: #fff;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        }

        .login-box h2 {
            text-align: center;
            color: #facc15;
        }

        .login-box p {
            text-align: center;
            color: #6b7280;
            margin-bottom: 25px;
            font-size: 14px;
        }

        /* Role switch */
        .role-switch {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .role-btn {
            width: 48%;
            padding: 10px;
            border: 2px solid #facc15;
            background: #fff;
            color: #facc15;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
        }

        .role-btn.active {
            background: #facc15;
            color: #000;
        }

        /* Inputs */
        label {
            font-size: 14px;
            color: #374151;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            margin-bottom: 18px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        input:focus {
            outline: none;
            border-color: #facc15;
            box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.3);
        }

        /* Password */
        .password-box {
            position: relative;
        }

        .password-box input {
            padding-right: 45px;
        }

        .password-box i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #facc15;
            display: none;
        }

        /* Button */
        .btn {
            width: 100%;
            padding: 12px;
            background: #facc15;
            border: none;
            color: #000;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn:hover {
            background: #eab308;
        }
    </style>
</head>

<body>

    <div class="login-box">
        <h2>Login</h2>
        <p>Select role and login</p>

        <!-- ROLE SWITCH -->
        <div class="role-switch">
            <button type="button" class="role-btn active" onclick="setRole('user')">
                <i class="fa fa-user"></i> User
            </button>
            <button type="button" class="role-btn" onclick="setRole('driver')">
                <i class="fa fa-id-card"></i> Driver
            </button>
        </div>
        <form action="login_verify.php" method="POST">
            
            <input type="hidden" name="role" id="role" value="user">

            <label>Email</label>
            <input type="email" name="mail" placeholder="Enter email" required>

            <label>Password</label>
            <div class="password-box">
                <input type="password" name="pass" id="password" placeholder="Enter password" required>
                <i class="fa fa-eye" id="eye"></i>
            </div>

            <button class="btn">Login</button>
        </form>
        <div class="register"> Don’t have an account? <a href="register.php">Register</a> </div>
    </div>
    </div>

    <script>
        /* Role switch */
        function setRole(role) {
            document.getElementById("role").value = role;
            document.querySelectorAll(".role-btn").forEach(btn => {
                btn.classList.remove("active");
            });
            event.target.classList.add("active");
        }

        /* Eye icon logic */
        const password = document.getElementById("password");
        const eye = document.getElementById("eye");

        password.addEventListener("input", () => {
            eye.style.display = password.value ? "block" : "none";
        });

        eye.addEventListener("click", () => {
            if (password.type === "password") {
                password.type = "text";
                eye.className = "fa fa-eye-slash";
            } else {
                password.type = "password";
                eye.className = "fa fa-eye";
            }
        });
    </script>

</body>

</html>