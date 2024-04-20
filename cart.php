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
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price per Unit (PHP)</th>
                    <th>Product Description</th>
                    <th style="width: 80px;">Quantity</th> <!-- Narrowed down the width -->
                    <th>Total Price (PHP)</th>
                    <!-- Remove the header title for action column -->
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'connect.php';

                    // Check if "Add to Cart" button is clicked
                    if(isset($_POST['add_to_cart'])) {
                        $product_id = $_POST['product_id'];

                        // Retrieve product details from tblproducts
                        $product_query = "SELECT * FROM tblproducts WHERE ProductID = $product_id";
                        $product_result = mysqli_query($connection, $product_query);

                        if(mysqli_num_rows($product_result) > 0) {
                            $product_data = mysqli_fetch_assoc($product_result);

                            // Insert product into tblcart
                            $insert_query = "INSERT INTO tblcart (ProductID, Quantity) VALUES ($product_id, 1)";
                            $insert_result = mysqli_query($connection, $insert_query);

                            if($insert_result) {
                                echo "<script>alert('Product added to cart successfully');</script>";
                            } else {
                                echo "<script>alert('Failed to add product to cart');</script>";
                            }
                        } else {
                            echo "<script>alert('Product not found');</script>";
                        }
                    }

                    // Check if remove button is clicked
                    if(isset($_POST['remove'])) {
                        $product_id = $_POST['product_id'];

                        // Perform remove operation (delete from database)
                        $delete_query = "DELETE FROM tblcart WHERE ProductID = $product_id";
                        $delete_result = mysqli_query($connection, $delete_query);

                        // Check if the deletion was successful
                        if($delete_result) {
                            echo "<script>alert('Item removed successfully');</script>";
                            // Redirect to refresh the page and reflect the changes
                            header("Location: ".$_SERVER['PHP_SELF']);
                            exit();
                        } else {
                            echo "<script>alert('Failed to remove item');</script>";
                        }
                    }

                    // Fetch cart items from the database along with product details
                    $sql = "SELECT ci.*, p.ProductName, p.ProductPrice, p.ProductDesc
                            FROM tblcart ci
                            INNER JOIN tblproducts p ON ci.ProductID = p.ProductID";
                    $result = mysqli_query($connection, $sql);

                    $totalPrice = 0; // Initialize total price

                    // Display cart items
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['ProductID']."</td>";
                        echo "<td>".$row['ProductName']."</td>";
                        echo "<td>₱".$row['ProductPrice']."</td>"; // Display price with ₱ symbol
                        echo "<td>".$row['ProductDesc']."</td>";
                        echo "<td>";
                        echo "<form method='post'>";
                        echo "<input type='hidden' name='product_id' value='".$row['ProductID']."'>";
                        echo "<input type='number' name='quantity' value='".$row['Quantity']."' min='1' onchange='updateQuantity(this.form, ".$row['ProductPrice'].", ".$row['ProductID'].")'>"; // Quantity input field with onchange event
                        echo "</form>";
                        echo "</td>";

                        // Calculate total price for the current item
                        $itemTotal = $row['ProductPrice'] * $row['Quantity']; // Corrected column name
                        echo "<td><span class='itemTotal'>₱".number_format($itemTotal, 2, '.', '')."</span></td>"; // Display item total price with ₱ symbol
                        
                        // Remove button with form to submit the ProductID to remove
                        echo "<td><form method='post'><input type='hidden' name='product_id' value='".$row['ProductID']."'><button type='submit' name='remove'>Remove</button></form></td>";
                        
                        echo "</tr>";

                        // Add the item total to the overall total price
                        $totalPrice += $itemTotal;
                    }

                    mysqli_close($connection);
                ?>
            </tbody>
        </table>
        
        <!-- Display total price -->
        <p>Total Price: <span id="totalPrice"><?php echo '₱'.number_format($totalPrice, 2, '.', ''); ?></span></p>
    </div>

    <script>
    function updateQuantity(form, price, product_id) {
        var quantity = form.quantity.value;
        var totalPrice = quantity * price;
        document.querySelector('.itemTotal').innerText = '₱'+totalPrice.toFixed(2);
        updateTotalPrice();

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle response if needed
                console.log(xhr.responseText);
            }
        };
        xhr.send(new URLSearchParams(new FormData(form))); // Send form data as URLSearchParams
    }

    function updateTotalPrice() {
        var totalPriceElements = document.querySelectorAll('.itemTotal');
        var totalPrice = 0;
        totalPriceElements.forEach(function(element) {
            totalPrice += parseFloat(element.innerText.replace('₱', ''));
        });
        document.getElementById('totalPrice').innerText = '₱'+totalPrice.toFixed(2);
    }
    </script>

</body>
</html>
