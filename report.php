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
    <div class="container">
        <h2>Reports</h2>

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
</body>
</html>

<?php
    mysqli_close($connection);
?>
