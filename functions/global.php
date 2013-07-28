<!-- This file holds all usefull global functions -->

<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    /** connects to the database and returns the established connection */
    function connectDb($dbName) {
        $client = new couchClient("http://localhost:5984", $dbName);
        return $client;
    }


    function connectMysqlDb() {
        $mysqlDbName = "agatha";
        $mysqlDbIp = "localhost";
        $mysqlUser = "root";
        $mysqlPassword = "root";

        $conn = mysqli_connect($mysqlDbIp, $mysqlUser, $mysqlPassword, $mysqlDbName);

        // Check connection
        if (mysqli_connect_errno($conn)) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            mysqli_close($conn);
        }

        return $conn;
    }

?>