<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['uniqueid'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['uniqueid'];

// Handle add to cart functionality before any HTML output
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
    } else {
        // If the product doesn't exist, insert a new entry with a unique CartID
        $insert_cart_query = "INSERT INTO tblcart (CartID, UserID, ProductID, Quantity) 
                              VALUES (NULL, '$userID', $product_id, 1)";
        mysqli_query($connection, $insert_cart_query);
    }

    $_SESSION['alert_message'] = "Product added to cart successfully";
    $_SESSION['alert_type'] = "success";
}

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
    <style>
        /* Style for the alert box */
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #44c767; /* Default success color */
            color: white;
            border-radius: 5px;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: opacity 0.5s;
        }
        .alert.info {
            background-color: #5bc0de; /* Info color */
        }
        .alert.success {
            background-color: #5cb85c; /* Success color */
        }
        .alert.error {
            background-color: #d9534f; /* Error color */
        }
    </style>
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
// Include alert.php logic directly in products.php to display the alert message
if (isset($_SESSION['alert_message']) && isset($_SESSION['alert_type'])) {
    // Determine the CSS class based on the alert type
    $alert_class = ($_SESSION['alert_type'] === 'success') ? 'success' : 'error';
?>
    <div class="alert <?php echo $alert_class; ?>" id="alertBox">
        <p><?php echo $_SESSION['alert_message']; ?></p>
    </div>

    <script>
    // Function to initiate fade out effect
    setTimeout(function() {
        var alertBox = document.getElementById('alertBox');
        if (alertBox) {
            alertBox.style.opacity = '0';
            setTimeout(function() {
                alertBox.style.display = 'none';
            }, 600); // Fade out duration
        }
    }, 2000); // Delay before fade out starts (2 seconds)
    </script>
<?php
    // Clear the session variables after displaying the alert
    unset($_SESSION['alert_message']);
    unset($_SESSION['alert_type']);
}
?>

<?php mysqli_close($connection); ?>

</body>
</html>
