<?php
    // if admin page is requested, check session values
    if (!isset($_SESSION['logged']) && !isset($_SESSION['username']) || $_SESSION['isAdmin'] != "yes") {
        header('Location: 404.php');
    }


    if (isset($_POST['show_add_gameserver_admin_form'])) {
        showAddGameserverAdminForm();
    } else {
        listWebAdmins();

        // need some space
        echo "<br/><br/><br/><br/>";

        listGameserverAdmins();
    }
?>
