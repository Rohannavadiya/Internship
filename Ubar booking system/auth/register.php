<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register | CabRide</title>
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
    min-height:100vh;
    background:#f9fafb;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* Box */
.register-box{
    width:100%;
    max-width:460px;
    background:#fff;
    padding:35px;
    border-radius:22px;
    box-shadow:0 20px 50px rgba(0,0,0,0.1);
}

.register-box h2{
    text-align:center;
    color:#facc15;
}
.register-box p{
    text-align:center;
    color:#6b7280;
    margin-bottom:20px;
    font-size:14px;
}

/* Role switch */
.role-switch{
    display:flex;
    justify-content:space-between;
    margin-bottom:25px;
}
.role-btn{
    width:48%;
    padding:10px;
    border:2px solid #facc15;
    background:#fff;
    color:#facc15;
    border-radius:12px;
    cursor:pointer;
    font-weight:600;
}
.role-btn.active{
    background:#facc15;
    color:#000;
}

/* Inputs */
label{
    font-size:14px;
    color:#374151;
}
input, select{
    width:100%;
    padding:12px;
    margin-top:6px;
    margin-bottom:18px;
    border-radius:10px;
    border:1px solid #e5e7eb;
}
input:focus, select:focus{
    outline:none;
    border-color:#facc15;
    box-shadow:0 0 0 3px rgba(250,204,21,0.3);
}

/* Password */
.password-box{
    position:relative;
}
.password-box input{
    padding-right:45px;
}
.password-box i{
    position:absolute;
    right:15px;
    top:50%;
    transform:translateY(-50%);
    cursor:pointer;
    color:#facc15;
    display:none;
}

/* Errors */
.error{
    color:red;
    font-size:13px;
    margin-top:-12px;
    margin-bottom:12px;
}

/* Button */
.btn{
    width:100%;
    padding:12px;
    background:#facc15;
    border:none;
    color:#000;
    border-radius:14px;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
}
.btn:disabled{
    background:#fde68a;
    cursor:not-allowed;
}
</style>
</head>

<body>

<div class="register-box">
    <h2 id="formTitle">Create Account</h2>
    <p id="formSub">Join CabRide and start your journey</p>

    <!-- ROLE SWITCH -->
    <div class="role-switch">
        <button type="button" class="role-btn active" id="userBtn">User</button>
        <button type="button" class="role-btn" id="driverBtn">Driver</button>
    </div>

    <form id="registerForm" method="POST" action="register_verify.php">

        <input type="hidden" name="role" id="role" value="user">

        <label>Full Name</label>
        <input type="text" name="fname" placeholder="Enter your full name" required>

        <label>Email Address</label>
        <input type="email" name="mail" placeholder="Enter your email address" required>

        <label>Mobile Number</label>
        <input type="tel" name="mobile" placeholder="Enter your mobile number" required>

        <!-- DRIVER ONLY -->
        <div id="driverFields" style="display:none;">
            <label>License Number</label>
            <input type="text" name="license" placeholder="Enter license number">

            <label>Vehicle Type</label>
            <select name="vehicle_type" id="vehicle_type">
                <option value="">-- Select vehicle type --</option>
                <option>Mini</option>
                <option>Sedan</option>
                <option>SUV</option>
            </select>
        </div>

        <label>Password</label>
        <div class="password-box">
            <input type="password" name="pass" id="password" placeholder="Create password" required>
            <i class="fa fa-eye" id="eyePassword"></i>
        </div>

        <label>Confirm Password</label>
        <div class="password-box">
            <input type="password" name="cpass" id="confirm_password" placeholder="Re-enter password" required>
            <i class="fa fa-eye" id="eyeConfirm"></i>
        </div>

        <div class="error" id="confirmError"></div>

        <button type="submit" class="btn" id="registerBtn" disabled>Register</button>
    </form>
</div>

<script>
/* ================= ELEMENTS ================= */
const roleInput = document.getElementById("role");
const driverFields = document.getElementById("driverFields");
const userBtn = document.getElementById("userBtn");
const driverBtn = document.getElementById("driverBtn");

const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirm_password");
const eyePassword = document.getElementById("eyePassword");
const eyeConfirm = document.getElementById("eyeConfirm");
const confirmError = document.getElementById("confirmError");
const registerBtn = document.getElementById("registerBtn");

/* ================= ROLE SWITCH ================= */
function setRole(role){
    roleInput.value = role;

    userBtn.classList.remove("active");
    driverBtn.classList.remove("active");

    const license = document.getElementById("license");
    const vehicle = document.getElementById("vehicle_type");

    if(role === "user"){
        userBtn.classList.add("active");
        driverFields.style.display = "none";

        // ❌ Remove required
        license.removeAttribute("required");
        vehicle.removeAttribute("required");

        document.getElementById("formTitle").innerText = "Create User Account";
    }
    else{
        driverBtn.classList.add("active");
        driverFields.style.display = "block";

        // ✅ Add required
        license.setAttribute("required", "required");
        vehicle.setAttribute("required", "required");

        document.getElementById("formTitle").innerText = "Register as Driver";
    }

    // Reset password validation
    confirmError.innerText = "";
    registerBtn.disabled = true;
}


/* Button clicks */
userBtn.onclick = () => setRole("user");
driverBtn.onclick = () => setRole("driver");

/* ================= AUTO DRIVER MODE FROM URL ================= */
const params = new URLSearchParams(window.location.search);
if(params.get("role") === "driver"){
    setRole("driver");
}

/* ================= EYE ICON LOGIC ================= */
password.addEventListener("input", () => {
    eyePassword.style.display = password.value ? "block" : "none";
    checkPasswordMatch();
});

confirmPassword.addEventListener("input", () => {
    eyeConfirm.style.display = confirmPassword.value ? "block" : "none";
    checkPasswordMatch();
});

eyePassword.onclick = () => {
    if(password.type === "password"){
        password.type = "text";
        eyePassword.className = "fa fa-eye-slash";
    }else{
        password.type = "password";
        eyePassword.className = "fa fa-eye";
    }
};

eyeConfirm.onclick = () => {
    if(confirmPassword.type === "password"){
        confirmPassword.type = "text";
        eyeConfirm.className = "fa fa-eye-slash";
    }else{
        confirmPassword.type = "password";
        eyeConfirm.className = "fa fa-eye";
    }
};

/* ================= PASSWORD MATCH CHECK ================= */
function checkPasswordMatch(){

    // If confirm password is empty
    if(confirmPassword.value === ""){
        confirmError.innerText = "";
        registerBtn.disabled = true;
        return;
    }

    // If passwords match
    if(password.value === confirmPassword.value){
        confirmError.innerText = "Passwords matched";
        confirmError.style.color = "green";
        registerBtn.disabled = false;
    }
    // If passwords do NOT match
    else{
        confirmError.innerText = "Passwords do not match";
        confirmError.style.color = "red";
        registerBtn.disabled = true;
    }
}

/* ================= FINAL SUBMIT SAFETY ================= */
document.getElementById("registerForm").addEventListener("submit", function(e){
    if(password.value !== confirmPassword.value){
        confirmError.innerText = "Passwords do not match";
        confirmError.style.color = "red";
        registerBtn.disabled = true;
        e.preventDefault();
    }
});
</script>


</body>
</html>
