<?php
    /**
    * Page used for validating info inserted by the admin from the admincp page
    */

    if (isset($_POST['add_gameserver_admin'])) {
        // get values
        $newLogin = $_POST['new_gameserver_admin_login'];
        $newPassword = $_POST['new_gameserver_admin_password'];
        $newConfirmPassword = $_POST['new_gameserver_admin_confirm_password'];
        $newFirstName = $_POST['new_gameserver_admin_first_name'];
        $newLastName = $_POST['new_gameserver_admin_last_name'];
        $newEmail = $_POST['new_gameserver_admin_email'];

        // check needed values are NOT empty (login/pass/confPass/email)
        if ($newLogin == "" || $newPassword == "" || $newConfirmPassword == "" || $newEmail == "") {
            if ($newLogin == "") {
                echo "<div class=\"box red\">'Login' required</div>";
            } else if ($newPassword == "") {
                echo "<div class=\"box red\">'Password' required</div>";
            } else if ($newConfirmPassword == "") {
                echo "<div class=\"box red\">'ConfirmPassword' required</div>";
            } else if ($newEmail == "") {
                echo "<div class=\"box red\">'Email' required</div>";
            } else if ($newPassword != $newConfirmPassword) {
                echo "<div class=\"box red\">Passwords don't match!</div>";
            }
        } else {
            // all required values have been filled. Sanitize them
            $newLogin = filter_var($newLogin, FILTER_SANITIZE_STRING);
            $newPassword = filter_var($newPassword, FILTER_SANITIZE_STRING);
            $newConfirmPassword = filter_var($newConfirmPassword, FILTER_SANITIZE_STRING);

            if ($_POST['new_gameserver_admin_first_name'] != "") {
                $newFirstName = filter_var($newFirstName, FILTER_SANITIZE_STRING);
            }

            if ($_POST['new_gameserver_admin_last_name']) {
                $newLastName = filter_var($newLastName, FILTER_SANITIZE_STRING);
            }

            $newEmail = filter_var($newEmail, FILTER_SANITIZE_EMAIL);


            // and finally validate them
            if ($newLogin == "") {
                echo "<div class=\"box red\">'Login' required</div>";
            } else if ($newPassword == "") {
                echo "<div class=\"box red\">'Password' required</div>";
            } else if ($newConfirmPassword == "") {
                echo "<div class=\"box red\">'ConfirmPassword' required</div>";
            } else if ($newEmail == "") {
                echo "<div class=\"box red\">'Email' required</div>";
            }

            // check if email is valid
            if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
                echo "<div class=\"box red\">$newEmail is not a valid email address</div>";
            } else {
                // add to database
                createGameserverAdminAccount($newLogin, $newPassword, $newFirstName, $newLastName, $newEmail);
            }
        }
    }
?>