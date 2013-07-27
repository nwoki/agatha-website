<!-- This file holds all usefull global functions -->

<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    /** connects to the database and returns the established connection */
    function connectDb($dbName) {
        $client = new couchClient("http://localhost:5984", $dbName);
        return $client;
    }

?>