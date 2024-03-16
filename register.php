<?php
    include 'connect.php';

    if(isset($_POST['btnRegister'])){        
        // retrieve data from form and save the value to a variable
        // for tbluserprofile
        $fname=$_POST['txtfirstname'];      
        $lname=$_POST['txtlastname'];
        $gender=$_POST['txtgender'];
        
        // for tbluseraccount
        $email=$_POST['txtemail'];     
        $uname=$_POST['txtusername'];
        $pword=$_POST['txtpassword'];
        
        // Check if the username already exists
        $sql_check_username = "SELECT * FROM tbluseraccount WHERE username='".$uname."'";
        $result_check_username = mysqli_query($connection, $sql_check_username);
        $row_check_username = mysqli_num_rows($result_check_username);

        if($row_check_username > 0){
            // Username already exists, show an alert
            $alert_message = 'Username already exists. Please choose a different one.';
            $alert_type = 'error'; // Set the alert type to 'error'
            include 'alert.php'; // Include custom alert message
        } else {
            // Username is unique, proceed with registration
            // Save data to tbluserprofile            
            $sql_insert_profile ="INSERT INTO tbluserprofile(firstname, lastname, gender) VALUES('".$fname."','".$lname."','".$gender."')";
            mysqli_query($connection, $sql_insert_profile);
            
            // Insert the user account data
            $sql_insert_account ="INSERT INTO tbluseraccount(emailadd, username, password) VALUES('".$email."','".$uname."','".$pword."')";
            mysqli_query($connection, $sql_insert_account);

            $alert_message = 'Registration successful!';
            $alert_type = 'success'; // Set the alert type to 'success'
            include 'alert.php'; // Include custom alert message

            //echo "<script>window.location.href = 'login.php';</script>"; // Redirect to login page after successful registration
        }
    }
?>




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css?v=<?php echo time(); ?>">
<title>Registration Page</title>
</head>

<body>
    <div class="container">
        <form class="registration-form" method="post" action="">
            <h2>Register</h2>

            <!-- Add first name, last name, and gender fields -->
            <label for="txtfirstname">First Name:</label>
            <input type="text" id="txtfirstname" name="txtfirstname" required>

            <label for="txtlastname">Last Name:</label>
            <input type="text" id="txtlastname" name="txtlastname" required>

            <label for="txtgender">Gender:</label>
            <input type="text" id="txtgender" name="txtgender" required>

            <!-- Keep the existing fields -->
            <label for="username">Username:</label>
            <input type="text" id="username" name="txtusername" required>

            <label for="txtemail">Email:</label>
            <input type="email" id="txtemail" name="txtemail" required>

            <label for="txtpassword">Password:</label>
            <input type="password" id="txtpassword" name="txtpassword" required>

            <label for="txtconfirm-password">Confirm Password:</label>
            <input type="password" id="txtconfirm-password" name="txtconfirm-password" required>

            <button type="submit" name="btnRegister" onclick="showRegistrationPopup()">Register</button>

            <div class="social-buttons">
                <button type="button" class="google-button">Google</button>
                <button type="button" class="facebook-button">Facebook</button>
            </div>

            <p class="login-link">Have an account? <a href="login.php">Login</a></p>
        </form>
    </div>

    <footer>
        <p>Francis Wedemeyer N. Dayagro<br> BSCS - 2</p>
    </footer>

   
</body>
