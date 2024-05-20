<?php
    // Include database connection
    include 'connect.php';

    // First Table: Users with birthdays in May
    $sql_may_birthdays = "SELECT u.UserName, up.FirstName, up.LastName, up.Birthday 
                          FROM tbluserprofile up 
                          INNER JOIN tbluseraccount u ON up.UserID = u.UserID 
                          WHERE MONTH(up.Birthday) = 5";
    $result_may_birthdays = mysqli_query($connection, $sql_may_birthdays);

    // Second Table: Male Users
    $sql_male_users = "SELECT u.UserName, up.FirstName, up.LastName 
                       FROM tbluserprofile up 
                       INNER JOIN tbluseraccount u ON up.UserID = u.UserID 
                       WHERE up.Gender = 'Male'";
    $result_male_users = mysqli_query($connection, $sql_male_users);

    // Third Table: Users and their Wishlist Items
    $sql_wishlist_items = "SELECT w.ProductName, u.UserName, up.FirstName, up.LastName 
                           FROM tblwishlist w 
                           INNER JOIN tbluseraccount u ON w.UserID = u.UserID 
                           INNER JOIN tbluserprofile up ON u.UserID = up.UserID";
    $result_wishlist_items = mysqli_query($connection, $sql_wishlist_items);

    // Statistics
    $sql_total_users = "SELECT COUNT(*) AS total_users FROM tbluseraccount";
    $result_total_users = mysqli_query($connection, $sql_total_users);
    $total_users = mysqli_fetch_assoc($result_total_users)['total_users'];

    $sql_total_items_bought = "SELECT COUNT(*) AS total_items_bought FROM tblcart"; // Assuming tblcart tracks items added to the cart
    $result_total_items_bought = mysqli_query($connection, $sql_total_items_bought);
    $total_items_bought = mysqli_fetch_assoc($result_total_items_bought)['total_items_bought'];

    $sql_total_products = "SELECT COUNT(*) AS total_products FROM tblproducts";
    $result_total_products = mysqli_query($connection, $sql_total_products);
    $total_products = mysqli_fetch_assoc($result_total_products)['total_products'];

    $sql_total_sensors = "SELECT COUNT(*) AS total_sensors FROM tblproducts WHERE isSensor = 1";
    $result_total_sensors = mysqli_query($connection, $sql_total_sensors);
    $total_sensors = mysqli_fetch_assoc($result_total_sensors)['total_sensors'];

    $sql_active_users_week = "SELECT COUNT(*) AS active_users_week FROM tbluseraccount"; // Assuming tbluseraccount tracks active users
    $result_active_users_week = mysqli_query($connection, $sql_active_users_week);
    $active_users_week = mysqli_fetch_assoc($result_active_users_week)['active_users_week'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Reports</title>
    <link rel="stylesheet" href="report.css">
</head>
<body>
<header class="l-header">
    <?php include 'navbar.php'; ?>
</header>


    <div class="container">
        
        <div class="side-panel">
            
            <h3>Report Choices</h3>
            <ul>
                <li><a href="#" onclick="showReport('may-birthdays', this)">Users with Birthdays in May</a></li>
                <li><a href="#" onclick="showReport('male-users', this)">Male Users</a></li>
                <li><a href="#" onclick="showReport('wishlist-items', this)">User Wishlist Items</a></li>
                <li><a href="#" onclick="showReport('image-report', this)">Static Chart</a></li>
            </ul>
        </div>

        <div class="report-content" id="report-content">
            <!-- Statistics Section -->
            <div class="statistics-panel" id="statistics-panel">
                <h3>Statistics</h3>
                <div class="statistics">
                    <div class="statistic">
                        <h4>Total Users</h4>
                        <p><?php echo $total_users; ?></p>
                    </div>
                    <div class="statistic">
                        <h4>Total Items Bought</h4>
                        <p><?php echo $total_items_bought; ?></p>
                    </div>
                    <div class="statistic">
                        <h4>Total Products</h4>
                        <p><?php echo $total_products; ?></p>
                    </div>
                    <div class="statistic">
                        <h4>Total Sensors</h4>
                        <p><?php echo $total_sensors; ?></p>
                    </div>
                    <div class="statistic">
                        <h4>Active Users This Week</h4>
                        <p><?php echo $active_users_week; ?></p>
                    </div>
                </div>
            </div>

            <!-- Report sections will be dynamically added here -->
            <div class="report-section" id="may-birthdays" style="display: none;">
                <h3>Users with Birthdays in May</h3>
                <table>
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Birthday</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row = mysqli_fetch_assoc($result_may_birthdays)) {
                                echo "<tr>";
                                echo "<td>".$row['UserName']."</td>";
                                echo "<td>".$row['FirstName']."</td>";
                                echo "<td>".$row['LastName']."</td>";
                                echo "<td>".$row['Birthday']."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="report-section" id="male-users" style="display: none;">
                <h3>Male Users</h3>
                <table>
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row = mysqli_fetch_assoc($result_male_users)) {
                                echo "<tr>";
                                echo "<td>".$row['UserName']."</td>";
                                echo "<td>".$row['FirstName']."</td>";
                                echo "<td>".$row['LastName']."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="report-section" id="wishlist-items" style="display: none;">
                <h3>User Wishlist Items</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>User Name</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row = mysqli_fetch_assoc($result_wishlist_items)) {
                                echo "<tr>";
                                echo "<td>".$row['ProductName']."</td>";
                                echo "<td>".$row['UserName']."</td>";
                                echo "<td>".$row['FirstName']."</td>";
                                echo "<td>".$row['LastName']."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="report-section" id="image-report" style="display: none;">
                <h3></h3>
                <img src="/CircuitFlo/images/chart.png" alt="Chart Image" style="max-width: 100%;">
            </div>
        </div>
        
    </div>

    <footer>
    <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
    </footer>

    

    <script>
        function showReport(reportId, element) {
            var reportSections = document.querySelectorAll('.report-section');
            var links = document.querySelectorAll('.side-panel a');
            
            // Hide all reports and remove active class from all links
            reportSections.forEach(function(section) {
                section.style.display = 'none';
            });
            links.forEach(function(link) {
                link.classList.remove('active');
            });

            // Show the selected report and highlight the active link
            document.getElementById(reportId).style.display = 'block';
            element.classList.add('active');
        }
    </script>
</body>
</html>
<?php
    mysqli_close($connection);
?>
