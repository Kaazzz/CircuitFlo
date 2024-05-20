<?php
session_start();
include 'connect.php';

if(isset($_POST['btnRegister'])){        
    // retrieve data from form and save the value to a variable
    // for tbluserprofile
    $fname=$_POST['txtfirstname'];      
    $lname=$_POST['txtlastname'];
    $gender=$_POST['txtgender'];
    $birthday=$_POST['txtbirthday'];
    $uname=$_POST['txtusername']; // Get username
    
    // for tbluseraccount
    $email=$_POST['txtemail'];     
    $pword=$_POST['txtpassword'];
    
    // Check if the username already exists
    $sql_check_username = "SELECT * FROM tbluseraccount WHERE username='".$uname."'";
    $result_check_username = mysqli_query($connection, $sql_check_username);
    $row_check_username = mysqli_num_rows($result_check_username);

    if($row_check_username > 0){
        // Username already exists, show an alert
        $_SESSION['alert_message'] = 'Username already exists. Please choose a different one.';
        $_SESSION['alert_type'] = 'error'; // Set the alert type to 'error'
    } else {
        // Username is unique, proceed with registration
        // Save data to tbluserprofile            
        $sql_insert_profile ="INSERT INTO tbluserprofile(firstname, lastname, gender, birthday, username) VALUES('".$fname."','".$lname."','".$gender."', '".$birthday."','".$uname."')";
        mysqli_query($connection, $sql_insert_profile);
        
        // Insert the user account data
        $sql_insert_account ="INSERT INTO tbluseraccount(emailadd, username, password) VALUES('".$email."','".$uname."','".$pword."')";
        mysqli_query($connection, $sql_insert_account);

        $_SESSION['alert_message'] = 'Registration successful!';
        $_SESSION['alert_type'] = 'success'; // Set the alert type to 'success'
    }
    header("Location: register.php"); // Redirect back to the registration page
    exit();
}

include 'alert.php'; // Include custom alert message
?>

<!-- Rest of your HTML code -->


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css?v=<?php echo time(); ?>">
<title>Registration Page</title>
</head>

<body>
<header class="l-header">
    <?php include 'navbar.php'; ?>
</header>

<a href="dashboard.php" class="back-btn">Back to Dashboard</a>
    <div class="container">
        <form class="registration-form" method="post" action="">
            <h2>Register</h2>

            <!-- Add first name, last name, and gender fields -->
            <label for="txtfirstname">First Name:</label>
            <input type="text" id="txtfirstname" name="txtfirstname" required>

            <label for="txtlastname">Last Name:</label>
            <input type="text" id="txtlastname" name="txtlastname" required>

            <label for="txtgender">Gender:</label>
            <select id="txtgender" name="txtgender" required>
                <option value="" selected disabled>Please select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label for="txtbirthday">Birthday:</label>
            <input type="date" id="txtbirthday" name="txtbirthday" required>


            <!-- Keep the existing fields -->
            <label for="username">Username:</label>
            <input type="text" id="username" name="txtusername" required>

            <label for="txtemail">Email:</label>
            <input type="email" id="txtemail" name="txtemail" required>

            <label for="txtpassword">Password:</label>
            <input type="password" id="txtpassword" name="txtpassword" required>

            <!-- <label for="txtconfirm-password">Confirm Password:</label>
            <input type="password" id="txtconfirm-password" name="txtconfirm-password" required> -->

            <button type="submit" name="btnRegister" onclick="showRegistrationPopup()">Register</button>

            <div class="social-buttons">
                <button type="button" class="google-button">Google</button>
                <button type="button" class="facebook-button">Facebook</button>
            </div>

            <p class="login-link">Have an account? <a href="login.php">Login</a></p>
        </form>
    </div>

    

   
</body>
