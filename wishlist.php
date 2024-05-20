<?php
session_start();
include 'connect.php';

// Retrieve unique id from session
$userID = $_SESSION['uniqueid'] ?? "";

// Fetch wishlist items for the specific user
$sql = "SELECT WishlistID, ProductName FROM tblwishlist WHERE UserID = '$userID'";
$result = mysqli_query($connection, $sql);

// Check for query execution errors
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

// Add wishlist item if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["product_name"];

    // Insert the new wishlist item into the database
    $insertSql = "INSERT INTO tblwishlist (UserID, ProductName) VALUES ('$userID', '$productName')";
    $insertResult = mysqli_query($connection, $insertSql);

    // Check for insertion errors
    if (!$insertResult) {
        die("Insertion failed: " . mysqli_error($connection));
    }

    // Redirect to refresh the page after adding the item
    header("Location: wishlist.php");
    exit;
}
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
<header class="l-header">
    <?php include 'navbar.php'; ?>
</header>

<a href="dashboard.php" class="back-btn">Back to Dashboard</a>
    <div class="container">
        <h2>User Wishlist</h2>
        <form method="post">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
            <button type="submit">Add Wishlist</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Wishlist ID</th>
                    <th>Product Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Display each wishlist item as a table row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['WishlistID']."</td>";
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
