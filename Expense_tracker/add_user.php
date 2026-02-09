<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add user</title>
    <link rel="stylesheet" href="ins/Style.css">
</head>
<body>
    <div class="content-index">
        <div class="box-index">
            <h2>Add user</h2>
            <form action="submit/insert_user.php" method="POST">
                <div class="form-grid-index">
                    <div class="form-group-index">
                        <label>Name</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-group-index">
                        <label>Email</label>
                        <input type="mail" name="email" required>
                    </div>
                    <div class="form-group-index">
                        <label>Password</label>
                        <input type="password" name="pass" required>
                    </div>
                    <!-- <div class="form-group-index">
                        <label>Confiram Password</label>
                        <input type="password" name="cpass" required>
                    </div> -->
                    <div class="form-group-index">
                        <input type="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>