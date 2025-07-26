<?php
session_start();
session_destroy(); // Destroy all sessions

// Redirect to login page with an alert
echo "<script>
    alert('You have been logged out.');
    window.location.href = 'login.php'; // Redirect to login page
</script>";
exit();
?>
