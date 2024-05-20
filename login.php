<?php
session_start(); // Start the session
include 'connect.php';

if (isset($_POST['btnLogin'])) {
    // Retrieve data from form
    $uname = $_POST['txtusername'];
    $pword = $_POST['txtpassword'];

    // Check if both username and password are filled
    if (!empty($uname) && !empty($pword)) {
        // Sanitize inputs to prevent SQL injection
        $uname = mysqli_real_escape_string($connection, $uname);

        // Prepare SQL statement to check if username exists
        $sql = "SELECT * FROM tbluseraccount WHERE username=?";
        $stmt = mysqli_prepare($connection, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $uname);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                // Check if the account is marked as deleted
                if ($row['isDeleted'] == 1) {
                    // Account is deleted
                    $_SESSION['alert_message'] = 'Invalid username or password';
                    $_SESSION['alert_type'] = 'error'; // Set the alert type to 'error'
                } else {
                    // Compare the entered password with the one stored in the database
                    if ($pword === $row['password']) {
                        // Login successful
                        $_SESSION['uniqueid'] = $row['userid']; // Set uniqueid in session
                        $_SESSION['username'] = $uname; // Set username in session
                        // Redirect to dashboard
                        header("Location: dashboard.php");
                        exit();
                    } else {
                        // Password does not match
                        $_SESSION['alert_message'] = 'Invalid username or password';
                        $_SESSION['alert_type'] = 'error'; // Set the alert type to 'error'
                    }
                }
            } else {
                // Username not found
                $_SESSION['alert_message'] = 'Invalid username or password';
                $_SESSION['alert_type'] = 'error'; // Set the alert type to 'error'
            }

            mysqli_stmt_close($stmt);
        } else {
            // Failed to prepare statement
            $_SESSION['alert_message'] = 'Failed to prepare the statement';
            $_SESSION['alert_type'] = 'error'; // Set the alert type to 'error'
        }
    } else {
        // Username or password not filled
        $_SESSION['alert_message'] = 'Please fill out both username and password fields';
        $_SESSION['alert_type'] = 'error'; // Set the alert type to 'error'
    }
}

include 'alert.php'; // Include custom alert message
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
<header class="l-header">
    <?php include 'navbar.php'; ?>
</header>

<a href="dashboard.php" class="back-btn">Back to Dashboard</a>

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
</body>
</html>
