<?php
// Check if the alert message and type are set
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
