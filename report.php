<?php
    // Include database connection
    include 'connect.php';

    // First Table: Users with birthdays in May
    $sql_may_birthdays = "SELECT UserID, UserName FROM tbluserprofile WHERE MONTH(Birthday) = 5";
    $result_may_birthdays = mysqli_query($connection, $sql_may_birthdays);

    // Second Table: Male Users
    $sql_male_users = "SELECT UserID, UserName FROM tbluserprofile WHERE Gender = 'Male'";
    $result_male_users = mysqli_query($connection, $sql_male_users);

    // Third Table: Users and their Wishlist Items
    $sql_wishlist_items = "SELECT WishlistID, UserID, ProductName FROM tblwishlist";
    $result_wishlist_items = mysqli_query($connection, $sql_wishlist_items);
?>
<!-- adsad -->
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
                    <th>User ID</th>
                    <th>User Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_assoc($result_may_birthdays)) {
                        echo "<tr>";
                        echo "<td>".$row['UserID']."</td>";
                        echo "<td>".$row['UserName']."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>

        <h3>Male Users</h3>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_assoc($result_male_users)) {
                        echo "<tr>";
                        echo "<td>".$row['UserID']."</td>";
                        echo "<td>".$row['UserName']."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>

        <h3>User Wishlist Items</h3>
        <table>
            <thead>
                <tr>
                    <th>Wishlist ID</th>
                    <th>User ID</th>
                    <th>Product Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_assoc($result_wishlist_items)) {
                        echo "<tr>";
                        echo "<td>".$row['WishlistID']."</td>";
                        echo "<td>".$row['UserID']."</td>";
                        echo "<td>".$row['ProductName']."</td>";
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
