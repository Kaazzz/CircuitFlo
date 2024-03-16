<?php
    include 'connect.php';

    if(isset($_POST['btnLogin'])){
        // retrieve data from form
        $uname = $_POST['txtusername'];
        $pword = $_POST['txtpassword'];

        // check if both username and password are filled
        if(!empty($uname) && !empty($pword)){
            // check if username and password match
            $sql = "SELECT * FROM tbluseraccount WHERE username='".$uname."' AND password='".$pword."'";
            $result = mysqli_query($connection, $sql);
            $row = mysqli_num_rows($result);
            if($row > 0){
                // login successful
                $alert_message = 'Login successful!';
                $alert_type = 'success'; // Set the alert type to 'success'
                include 'alert.php'; // Include custom alert message
                echo "<script>window.location.href = 'dashboard.php';</script>"; // redirect to dashboard
            } else {
                // login failed
                $alert_message = 'Invalid username or password';
                $alert_type = 'error'; // Set the alert type to 'error'
                include 'alert.php'; // Include custom alert message
            }
        } else {
            // username or password not filled
            $alert_message = 'Please fill out both username and password fields';
            $alert_type = 'error'; // Set the alert type to 'error'
            include 'alert.php'; // Include custom alert message
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
<title>Login Page</title>
</head>
<body>
    <div class="container">
        <form class="registration-form" method="post" action="">
            <h2>Login</h2>

            <!-- Keep only username and password fields -->
            <label for="username">Username:</label>
            <input type="text" id="username" name="txtusername" required>

            <label for="txtpassword">Password:</label>
            <input type="password" id="txtpassword" name="txtpassword" required>

            <button type="submit" name="btnLogin">Login</button>

            <p class="login-link">Don't have an account? <a href="register.php">Register</a></p>
        </form>
    </div>

    <footer>
        <p>Francis Wedemeyer N. Dayagro<br> BSCS - 2</p>
    </footer>
</body>
</html>
