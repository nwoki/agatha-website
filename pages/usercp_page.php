<?php
    // if user page is requested, check session values
    if (!isset($_SESSION['logged']) && !isset($_SESSION['username']) || $_SESSION['isAdmin'] != "no") {
        header('Location: 404.php');
    }


    // Show users currently registered gameservers
    listUserGameservers($_SESSION['username']);
?>
