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

// Fetch user's profile based on uniqueid
$sql = "SELECT * FROM tbluserprofile WHERE userid = '$uniqueid'";
$result = mysqli_query($connection, $sql);

// Check if profile exists
if ($result && mysqli_num_rows($result) > 0) {
    $profile = mysqli_fetch_assoc($result);
} else {
    // Handle case where profile doesn't exist
    $profile_not_found = true;
}

// Fetch username based on uniqueid
$sql_username = "SELECT username FROM tbluseraccount WHERE userid = '$uniqueid'";
$result_username = mysqli_query($connection, $sql_username);

// Check if username exists
if ($result_username && mysqli_num_rows($result_username) > 0) {
    $username_row = mysqli_fetch_assoc($result_username);
    $username = $username_row['username'];
} else {
    // Set default username if not found
    $username = "Unknown";
}

// Handle form submission for updating profile
if(isset($_POST['saveProfile'])){
    // Retrieve updated values from form
    $username = escape($_POST['username']); // Updated username
    $firstname = escape($_POST['firstname']);
    $lastname = escape($_POST['lastname']);

    // Update the username in tbluseraccount
    $update_account_sql = "UPDATE tbluseraccount SET username='$username' WHERE userid='$uniqueid'";
    $update_account_result = mysqli_query($connection, $update_account_sql);

    // Update the user's profile in the database
    $update_profile_sql = "UPDATE tbluserprofile SET firstname='$firstname', lastname='$lastname', username= '$username' WHERE userid='$uniqueid'";
    $update_result = mysqli_query($connection, $update_profile_sql);

    if($update_result && $update_account_result){
        // Profile updated successfully
        $_SESSION['alert_message'] = 'Profile updated successfully!';
        $_SESSION['alert_type'] = 'success';
        // Update profile variable with new values
        $profile['firstname'] = $firstname;
        $profile['lastname'] = $lastname;
        $profile['username'] = $username;

    } else {
        // Failed to update profile
        $_SESSION['alert_message'] = 'Failed to update profile';
        $_SESSION['alert_type'] = 'error';
    }
}

// Handle form submission for deleting user account
if(isset($_POST['deleteAccount'])){
    // Delete user account from tbluseraccount
    $delete_account_sql = "DELETE FROM tbluseraccount WHERE userid='$uniqueid'";
    $delete_account_result = mysqli_query($connection, $delete_account_sql);

    // Delete user profile from tbluserprofile
    $delete_profile_sql = "DELETE FROM tbluserprofile WHERE userid='$uniqueid'";
    $delete_profile_result = mysqli_query($connection, $delete_profile_sql);

    if($delete_account_result && $delete_profile_result){
        // Account deleted successfully
        session_unset();
        session_destroy();
        // Set delete account success message
        $_SESSION['alert_message'] = 'Account deleted successfully!';
        $_SESSION['alert_type'] = 'success';
        // Redirect to login page
        header("Location: login.php");
        exit();
    } else {
        // Failed to delete account
        $_SESSION['alert_message'] = 'Failed to delete account';
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
</head>
<body>
    <div class="container">
        <?php if(isset($profile_not_found) && $profile_not_found): ?>
            <h2>Profile Not Found</h2>
            <p>The profile for this user does not exist.</p>
        <?php else: ?>
            <h2>User Profile</h2>
            <?php include 'alert.php'; ?> <!-- Include alert message -->
            <!-- Display user's profile information -->
            <form method="post" action="">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="editable" value="<?php echo escape($username); ?>" <?php echo isset($_POST['editProfile']) ? '' : 'readonly'; ?>>

                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" class="editable" value="<?php echo escape($profile['firstname']); ?>" <?php echo isset($_POST['editProfile']) ? '' : 'readonly'; ?>>

                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" class="editable" value="<?php echo escape($profile['lastname']); ?>" <?php echo isset($_POST['editProfile']) ? '' : 'readonly'; ?>>

                <!-- Edit and Save buttons -->
                <?php if(isset($_POST['editProfile'])): ?>
                    <button type="submit" name="saveProfile" id="saveBtn">Save Changes</button>
                <?php else: ?>
                    <button type="submit" name="editProfile">Edit Profile</button>
                <?php endif; ?>

                <!-- Delete button -->
                <button type="submit" name="deleteAccount" class="delete">Delete Account</button>
            </form>
        <?php endif; ?>
    </div>

    <script>
        // Function to initiate fade out effect for alert box
        setTimeout(function(){
            var alertBox = document.querySelector('.alert');
            if(alertBox){
                alertBox.classList.add('fade-out');
            }
        }, 2000); // Delay before fade out starts (2 seconds)
    </script>
</body>
</html>
