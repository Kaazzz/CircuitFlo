<?php
    session_start();
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css?v=<?php echo time(); ?>">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo ($username !== "Guest") ? $username : "Guest"; ?>!</h2>
        <p>This is your dashboard. </br> </br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, laboriosam. Esse ipsum culpa laboriosam, totam hic quidem recusandae eos, numquam iusto aliquid expedita est sapiente quaerat inventore voluptatem corporis aliquam.</p>
        <!-- Dashboard content goes here -->
       
        <!-- Button to view products -->
        <form action="products.php" method="GET">
            <button type="submit" class="view-products-btn">View Products</button>
        </form> <br>

        <!-- Button to view wishlist -->
        <form action="wishlist.php" method="GET">
            <button type="submit" class="view-products-btn">View Wishlist</button>
        </form> <br>

        <form action="cart.php" method="GET">
            <button type="submit" class="view-products-btn">View Cart</button>
        </form>
    </div>
 
    <footer class="footer">
        <p>Francis Wedemeyer Dayagro<br> BSCS - 2</p>
    </footer>
</body>
</html>
