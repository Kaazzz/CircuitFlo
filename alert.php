<?php
    // Check if the alert message and type are set
    if(isset($alert_message) && isset($alert_type)){
        // Determine the CSS class based on the alert type
        $alert_class = ($alert_type === 'success') ? 'success' : 'error';
?>

<div class="alert <?php echo $alert_class; ?>">
    <p><?php echo $alert_message; ?></p>
</div>

<?php
    }
?>

<script>
    // Add a delay before starting the fade-out animation
    setTimeout(function(){
        var alert = document.querySelector('.alert');
        if(alert){
            alert.classList.add('fade-out');
        }
    }, 2000);
</script>
