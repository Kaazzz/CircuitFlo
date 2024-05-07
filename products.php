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
    $sql = "SELECT * FROM tblproducts WHERE ProductName LIKE '%$search%'";
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
    <link rel="stylesheet" type="text/css" href="prod.css">
</head>
<body>

<header class="l-header">
    <nav class="nav bd-grid">
        <a href="#" class="nav__logo">CircuitFlo</a>

        <div class="nav__toggle" id="nav-toggle">
            <i class='bx bx-menu-alt-right'></i>
        </div>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item"><a href="login.php" class="nav__link">Login</a></li>
                <li class="nav__item"><a href="register.php" class="nav__link">Register</a></li>
                <li class="nav__item"><a href="#" class="nav__link">About Us</a></li>
                <li class="nav__item"><a href="#" class="nav__link">Contact Us</a></li>
            </ul>
        </div>
    </nav>
</header>

<div class="container">
    <h2>Arduino Products</h2>
    <!-- Search form -->
    <form action="" method="GET">
        <input type="text" name="search" placeholder="Search products">
        <button type="submit">Search</button>
    </form>
    <div class="products-grid">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product">
                <div class="product-image">
                    <img src="<?php echo $row['ProductImage']; ?>" alt="<?php echo $row['ProductName']; ?>">
                </div>
                <div class="product-details">
                    <h3><?php echo $row['ProductName']; ?></h3>
                    <p class="price">Price: ₱<?php echo $row['ProductPrice']; ?></p>
                    <form method='post'>
                        <input type='hidden' name='product_id' value='<?php echo $row['ProductID']; ?>'>
                        <button type='submit' name='add_to_cart'>Add to Cart</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];

    // Check if the product already exists in the user's cart
    $check_existing_query = "SELECT * FROM tblcart WHERE UserID = '$userID' AND ProductID = $product_id";
    $existing_result = mysqli_query($connection, $check_existing_query);

    if (mysqli_num_rows($existing_result) > 0) {
        // If the product exists, update the quantity instead of creating a new entry
        $update_cart_query = "UPDATE tblcart SET Quantity = Quantity + 1 
                              WHERE UserID = '$userID' AND ProductID = $product_id";
        mysqli_query($connection, $update_cart_query);

        $_SESSION['alert_message'] = "Product quantity incremented in your cart";
        $_SESSION['alert_type'] = "info";
    } else {
        // If the product doesn't exist, insert a new entry with a unique CartID
        $insert_cart_query = "INSERT INTO tblcart (CartID, UserID, ProductID, Quantity) 
                              VALUES (NULL, '$userID', $product_id, 1)";
        mysqli_query($connection, $insert_cart_query);

        $_SESSION['alert_message'] = "Product added to cart successfully";
        $_SESSION['alert_type'] = "success";
    }

    header("Location: prod.php"); // Redirect to clear POST data
}
?>

<?php include 'alert.php'; ?>

</body>
</html>
<?php mysqli_close($connection); ?>
