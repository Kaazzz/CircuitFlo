<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['uniqueid'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['uniqueid'];

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($connection, $_GET['search']);
    $sql = "SELECT * FROM tblproducts WHERE ProductName LIKE '%$search%' OR ProductDesc LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM tblproducts";
}

$result = mysqli_query($connection, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arduino Products</title>
    <link rel="stylesheet" type="text/css" href="products.css">
</head>
<body>
    <div class="container">
        <h2>Arduino Products</h2>
 
        <!-- Search form -->
        <form action="" method="GET">
            <input type="text" name="search" placeholder="Search products">
            <button type="submit">Search</button>
        </form>
 
        <?php include 'alert.php'; ?> <!-- Include the alert notification -->
 
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['ProductID']."</td>";
                        echo "<td>".$row['ProductName']."</td>";
                        echo "<td>$".$row['ProductPrice']."</td>";
                        echo "<td>".$row['ProductDesc']."</td>";
                        echo "<td>";
                        echo "<form method='post'>";
                        echo "<input type='hidden' name='product_id' value='".$row['ProductID']."'>";
                        echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
 
                    if (isset($_POST['add_to_cart'])) {
                        $product_id = $_POST['product_id'];
                        
                        // Insert the product into the user's cart, ignoring if there's already a duplicate entry
                        $insert_cart_query = "INSERT IGNORE INTO tblcart (CartID, UserID, ProductID, Quantity) 
                                              VALUES (NULL, '$userID', $product_id, 1)";
                        $insert_result = mysqli_query($connection, $insert_cart_query);
                        
                        // Check for errors
                        if (!$insert_result) {
                            // Error occurred
                            $alert_message = "Error: " . mysqli_error($connection);
                            $alert_type = "danger";
                        } else {
                            // Check if any rows were affected by the insert query
                            if (mysqli_affected_rows($connection) > 0) {
                                $alert_message = "Product added to cart successfully";
                                $alert_type = "success";
                            } else {
                                $alert_message = "Product already exists in your cart";
                                $alert_type = "warning";
                            }
                        }
                        
                        include 'alert.php'; // Include custom alert message
                    }
                    
                    
 
                    mysqli_close($connection);
                ?>
            </tbody>
        </table>
    
    </div>
</body>
</html>
