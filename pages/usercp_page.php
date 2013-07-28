<?php
    // if user page is requested, check session values
    if (!isset($_SESSION['logged']) && !isset($_SESSION['username']) || $_SESSION['isAdmin'] != "no") {
        header('Location: 404.php');
    }

    // delete gameserver
    if (isset($_POST['delete_gameserver'])) {
        echo "deleting gameserver ".$_POST['delete_gameserver'];
        deleteGameserver($_POST['delete_gameserver']);
    }

    // Show users currently registered gameservers
    listUserGameservers($_SESSION['username']);
?>

    <!-- add gameserver button -->
    <div class="button">
        <form action="#" method="post">
            <input type="hidden" name="add_gameserver" value="true">
            <input type="submit" value="Add Gameserver">
        </form>
    </div>
