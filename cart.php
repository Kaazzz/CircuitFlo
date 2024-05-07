<?php
session_start(); // Start the session
include 'connect.php';

// Check if the user is logged in
if (!isset($_SESSION['uniqueid'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['uniqueid']; // Retrieve user ID from session

// Check if the remove button is clicked
if(isset($_POST['remove'])) {
    $cart_id = $_POST['cart_id'];

    // Remove the item from the database cart
    $delete_cart_query = "DELETE FROM tblcart WHERE CartID = $cart_id";
    mysqli_query($connection, $delete_cart_query);

    // Redirect back to the cart page to reflect the changes
    header("Location: cart.php");
    exit();
}

// Check if the quantity is updated
if(isset($_POST['cart_id']) && isset($_POST['quantity'])) {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];

    // Update the quantity in the database cart
    $update_cart_query = "UPDATE tblcart SET Quantity = $quantity WHERE CartID = $cart_id";
    mysqli_query($connection, $update_cart_query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" type="text/css" href="cart.css">
</head>
<body>
    <div class="container">
        <h2>Shopping Cart</h2>

        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price per Unit (PHP)</th>
                    <th>Description</th>
                    <th style="width: 80px;">Quantity</th> <!-- Narrowed down the width -->
                    <th>Total Price (PHP)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Initialize total price
                    $totalPrice = 0;

                    // Fetch cart items for the current user
                    $cart_query = "SELECT c.CartID, p.ProductName, p.ProductPrice, p.ProductDesc, c.Quantity 
                                   FROM tblcart c 
                                   INNER JOIN tblproducts p ON c.ProductID = p.ProductID 
                                   WHERE c.UserID = '$userID'";
                    $cart_result = mysqli_query($connection, $cart_query);

                    if ($cart_result && mysqli_num_rows($cart_result) > 0) {
                        // Loop through cart items
                        while ($cart_row = mysqli_fetch_assoc($cart_result)) {
                            // Calculate item total price
                            $itemTotal = $cart_row['ProductPrice'] * $cart_row['Quantity'];
                            $totalPrice += $itemTotal;

                            // Display cart item
                            echo "<tr>";
                            echo "<td>".$cart_row['ProductName']."</td>";
                            echo "<td>₱".$cart_row['ProductPrice']."</td>"; // Display price with ₱ symbol
                            echo "<td>".$cart_row['ProductDesc']."</td>";
                            echo "<td>";
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='cart_id' value='".$cart_row['CartID']."'>";
                            echo "<input type='number' name='quantity' value='".$cart_row['Quantity']."' min='1' onchange='this.form.submit()'>"; // Quantity input field with onchange event
                            echo "</form>";
                            echo "</td>";
                            echo "<td>₱".number_format($itemTotal, 2, '.', '')."</td>"; // Display item total price with ₱ symbol
                            echo "<td>";
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='cart_id' value='".$cart_row['CartID']."'>";
                            echo "<button type='submit' name='remove'>Remove</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
        
        <!-- Display total price -->
        <p>Total Price: ₱<?php echo number_format($totalPrice, 2, '.', ''); ?></p>
    </div>
</body>
</html>
