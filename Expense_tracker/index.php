<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="ins/Style.css">
</head>

<body>
    <div class="content-index">
        <div class="box-index">
            <h2>Login</h2>
            <form action="check.php" method="POST">
                <div class="form-grid-index">
                    <div class="form-group-index">
                        <label>Email</label>
                        <input type="mail" name="email" required>
                    </div>
                    <div class="form-group-index">
                        <label>Password</label>
                        <input type="password" name="pass" required>
                    </div>
                    <div class="form-group-index">
                        <input type="submit" value="Login">
                    </div>
                    <div class="user">
                        <a href="add_user.php">Create a new account</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>