<!-- This file holds all usefull global functions -->

<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    /** connects to the database and returns the established connection */
    function connectDb() {
        $dbHost = "localhost";
        $dbName = "agatha_web";
        $dbUser = "root";
        $dbPass = "root";

        $link = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

        if (mysqli_connect_errno()) {
            echo "[connectDb] ERROR: " . mysqli_connect_error();
            mysqli_close($link);
        }

//         if (!mysql_select_db($dbName, $link)) {
//             echo "[connectDb] ERROR: " . mysql_error();
//             mysql_close($link);
//         }

        return $link;
    }

?>