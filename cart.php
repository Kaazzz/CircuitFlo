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

        <div class="cart-items">
            <?php
            session_start();
            include 'connect.php';

            if (!isset($_SESSION['uniqueid'])) {
                header("Location: login.php");
                exit();
            }

            $userID = $_SESSION['uniqueid'];

            if(isset($_POST['remove'])) {
                $cart_id = $_POST['cart_id'];
                $delete_cart_query = "DELETE FROM tblcart WHERE CartID = $cart_id";
                mysqli_query($connection, $delete_cart_query);
                header("Location: cart.php");
                exit();
            }

            if(isset($_POST['cart_id']) && isset($_POST['quantity'])) {
                $cart_id = $_POST['cart_id'];
                $quantity = $_POST['quantity'];
                $update_cart_query = "UPDATE tblcart SET Quantity = $quantity WHERE CartID = $cart_id";
                mysqli_query($connection, $update_cart_query);
            }

            function getProductImage($productID, $connection) {
                $query = "SELECT ProductImage FROM tblproducts WHERE ProductID = $productID";
                $result = mysqli_query($connection, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    return $row['ProductImage'];
                } else {
                    return '';
                }
            }

            $totalPrice = 0;
            $cart_query = "SELECT c.CartID, p.ProductID, p.ProductName, p.ProductPrice, p.ProductDesc, c.Quantity 
                           FROM tblcart c 
                           INNER JOIN tblproducts p ON c.ProductID = p.ProductID 
                           WHERE c.UserID = '$userID'";
            $cart_result = mysqli_query($connection, $cart_query);

            if ($cart_result && mysqli_num_rows($cart_result) > 0) {
                while ($cart_row = mysqli_fetch_assoc($cart_result)) {
                    $itemTotal = $cart_row['ProductPrice'] * $cart_row['Quantity'];
                    $totalPrice += $itemTotal;
            ?>
                    <div class="cart-item">
                        <div class="product-thumbnail">
                            <img src="<?php echo getProductImage($cart_row['ProductID'], $connection); ?>" alt="Product Image">
                        </div>
                        <div class="product-details">
                            <h4 class="product-name"><?php echo $cart_row['ProductName']; ?></h4>
                            <p class="price">Price: ₱<?php echo $cart_row['ProductPrice']; ?></p>
                        </div>
                        <div class="quantity">
                            <form method="post">
                                <input type="hidden" name="cart_id" value="<?php echo $cart_row['CartID']; ?>">
                                <input type="number" name="quantity" value="<?php echo $cart_row['Quantity']; ?>" min="1" onchange="this.form.submit()">
                            </form>
                        </div>
                        <div class="total-price">₱<?php echo number_format($itemTotal, 2, '.', ''); ?></div>
                        <div class="remove">
                            <form method="post">
                                <input type="hidden" name="cart_id" value="<?php echo $cart_row['CartID']; ?>">
                                <button type="submit" name="remove">Remove</button>
                            </form>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>Your cart is empty.</p>";
            }
            ?>
        </div>

        <!-- Total price displayed at the bottom -->
        <div class="total-price-highlight">
            Total Price: ₱<?php echo number_format($totalPrice, 2, '.', ''); ?>
        </div>
    </div>
</body>
</html>
