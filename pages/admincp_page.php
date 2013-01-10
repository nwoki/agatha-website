<?php
    // if admin page is requested, check session values
    if (!isset($_SESSION['logged']) && !isset($_SESSION['username'])) {
        header('Location: 404.php');
    }
?>

<p>admin cp page</p>