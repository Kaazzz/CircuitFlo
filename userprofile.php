<?php
session_start();
include 'connect.php';
include 'alert.php';

// Function to escape HTML characters
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Retrieve uniqueid from session
$uniqueid = $_SESSION['uniqueid'] ?? "";

// Handle form submission for updating password
if(isset($_POST['confirmSavePassword'])){
    // Retrieve and escape the new password
    $password = escape($_POST['password']);
    $confirm_password = escape($_POST['confirm_password']);

    if ($password === $confirm_password) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $update_password_sql = "UPDATE tbluseraccount SET password=? WHERE userid=?";
        $update_password_stmt = mysqli_prepare($connection, $update_password_sql);
        mysqli_stmt_bind_param($update_password_stmt, "ss", $hashed_password, $uniqueid);
        $update_password_result = mysqli_stmt_execute($update_password_stmt);

        if($update_password_result){
            // Password updated successfully
            $_SESSION['alert_message'] = 'Password updated successfully!';
            $_SESSION['alert_type'] = 'success';
        } else {
            // Failed to update password
            $_SESSION['alert_message'] = 'Failed to update password';
            $_SESSION['alert_type'] = 'error';
        }
    } else {
        // Passwords do not match
        $_SESSION['alert_message'] = 'Passwords do not match';
        $_SESSION['alert_type'] = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Include userprofile.css -->
    <link rel="stylesheet" href="userprofile.css">
    <style>
        /* Style for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<header class="l-header">
    <?php include 'navbar.php'; ?>
</header>
<a href="dashboard.php" class="back-btn">Back to Dashboard</a>
    <div class="container">
        <h2>User Profile</h2>
        <?php include 'alert.php'; ?> <!-- Include alert message -->
        <!-- Form for changing password -->
        <form method="post" action="" id="passwordForm">
            <label for="password">New Password:<br><br></label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password"><br><br>Confirm New Password:<br><br></label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <!-- Save button for password -->
            <br><br>
            <button type="button" onclick="showConfirmModal()">Save Password</button>

            <!-- Delete button -->
            <button type="submit" name="deleteAccount" class="delete">Delete Account</button>
        </form>
    </div>

    <!-- The Modal -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeConfirmModal()">&times;</span>
            <p>Are you sure all the information is correct?</p>
            <form method="post" action="">
                <input type="hidden" id="modal_password" name="password">
                <input type="hidden" id="modal_confirm_password" name="confirm_password">
                <button type="submit" name="confirmSavePassword">Yes</button>
                <button type="button" onclick="closeConfirmModal()">No</button>
            </form>
        </div>
    </div>

    <script>
        // Function to initiate fade out effect for alert box
        setTimeout(function(){
            var alertBox = document.querySelector('.alert');
            if(alertBox){
                alertBox.classList.add('fade-out');
            }
        }, 2000); // Delay before fade out starts (2 seconds)

        // Function to show the confirmation modal
        function showConfirmModal() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                return false;
            }

            document.getElementById('modal_password').value = password;
            document.getElementById('modal_confirm_password').value = confirmPassword;

            var modal = document.getElementById('confirmModal');
            modal.style.display = "block";
        }

        // Function to close the confirmation modal
        function closeConfirmModal() {
            var modal = document.getElementById('confirmModal');
            modal.style.display = "none";
        }

        // Close the modal when the user clicks outside of it
        window.onclick = function(event) {
            var modal = document.getElementById('confirmModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
