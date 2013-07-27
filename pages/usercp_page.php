<?php
    // if user page is requested, check session values
    if (!isset($_SESSION['logged']) && !isset($_SESSION['username']) || $_SESSION['isAdmin'] != "no") {
        header('Location: 404.php');
    }
?>

<p>user cp page <?php echo "with session ".$_SESSION["isAdmin"] ?></p>