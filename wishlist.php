<?php
    // Include database connection
    include 'connect.php';

    // Fetch wishlist items with user IDs from the database
    $sql = "SELECT w.*, u.UserID
            FROM tblwishlist w 
            INNER JOIN tbluseraccount u ON w.UserName = u.username";
    $result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Wishlist</title>
    <link rel="stylesheet" href="wishlist.css">
</head>
<body>
    <div class="container">
        <h2>User Wishlist</h2>
        <table>
            <thead>
                <tr>
                    <th>Wishlist ID</th>
                    <th>User Name</th>
                    <th>User ID</th>
                    <th>Product Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Display each wishlist item as a table row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['WishlistID']."</td>";
                        echo "<td>".$row['UserName']."</td>";
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
    // Close database connection
    mysqli_close($connection);
?>
