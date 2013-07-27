<?php
    // if admin page is requested, check session values
    if (!isset($_SESSION['logged']) && !isset($_SESSION['username']) || $_SESSION['isAdmin'] != "yes") {
        header('Location: 404.php');
    }
?>

<p>admin cp page with session <?php echo $_SESSION['isAdmin'] ?></p>