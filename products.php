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
                    include 'connect.php';
 
                    // Check if search query is set
                    if (isset($_GET['search'])) {
                        // Get search term and sanitize it
                        $search = mysqli_real_escape_string($connection, $_GET['search']);
                        // Construct SQL query with search condition
                        $sql = "SELECT * FROM tblproducts WHERE ProductName LIKE '%$search%' OR ProductDesc LIKE '%$search%'";
                    } else {
                        // Default SQL query to fetch all products
                        $sql = "SELECT * FROM tblproducts";
                    }
 
                    // Execute the query
                    $result = mysqli_query($connection, $sql);
 
                    // Display results
                    while($row = mysqli_fetch_assoc($result)) {
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
 
                    // Handle adding products to the cart
                    if(isset($_POST['add_to_cart'])) {
                        $product_id = $_POST['product_id'];
                        // Check if the product already exists in the cart
                        $cart_query = "SELECT * FROM tblcart WHERE ProductID = $product_id";
                        $cart_result = mysqli_query($connection, $cart_query);
                        if(mysqli_num_rows($cart_result) > 0) {
                            // If the product exists, increase its quantity
                            $update_query = "UPDATE tblcart SET Quantity = Quantity + 1 WHERE ProductID = $product_id";
                            $update_result = mysqli_query($connection, $update_query);
                            if($update_result) {
                                $alert_message = "Product quantity updated in cart";
                                $alert_type = "success";
                                include 'alert.php'; // Include custom alert message
                            } else {
                                $alert_message = "Failed to update product quantity in cart";
                                $alert_type = "error";
                                include 'alert.php'; // Include custom alert message
                            }
                        } else {
                            // If the product doesn't exist, insert it into the cart with quantity 1
                            $insert_query = "INSERT INTO tblcart (ProductID, Quantity) VALUES ($product_id, 1)";
                            $insert_result = mysqli_query($connection, $insert_query);
                            if($insert_result) {
                                $alert_message = "Product added to cart successfully";
                                $alert_type = "success";
                                include 'alert.php'; // Include custom alert message
                            } else {
                                $alert_message = "Failed to add product to cart";
                                $alert_type = "error";
                                include 'alert.php'; // Include custom alert message
                            }
                        }
                    }
 
                    mysqli_close($connection);
                ?>
            </tbody>
        </table>
    
    </div>
</body>
</html>
