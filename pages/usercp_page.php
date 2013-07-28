<?php
    // if user page is requested, check session values
    if (!isset($_SESSION['logged']) && !isset($_SESSION['username']) || $_SESSION['isAdmin'] != "no") {
        header('Location: 404.php');
    }

    // add gameserver
    if (isset($_POST['add_gameserver'])) {
        addGameserver($_POST['new_gameserver_ip'], $_POST['new_gameserver_name']);
    }

    // delete gameserver
    if (isset($_POST['delete_gameserver'])) {
        deleteGameserver($_POST['delete_gameserver']);
    }

    // add gameserver
    if (isset($_POST['show_add_gameserver_form'])) {
        showAddGamerserverForm();
    } else {
        // Show users currently registered gameservers
        listUserGameservers($_SESSION['username']);
    }
?>