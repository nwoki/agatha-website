<!-- This file holds all usefull functions for the website login -->

<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once 'global.php';

    require_once 'PHP-on-Couch/lib/couch.php';
    require_once 'PHP-on-Couch/lib/couchClient.php';
    require_once 'PHP-on-Couch/lib/couchDocument.php';

    function login($username, $password) {
        $link = connectDb("webadmins");
        $loginFound = false;

        // get docs anche check for match
        $allDocs = $link->getAllDocs();

        foreach ($allDocs->rows as $row) {
            $doc = $link->asCouchDocuments()->getDoc($row->id);

            // check match for login and pass
            if ($doc->get("login") == $username && $doc->get("password") == md5($password)) {
                $_SESSION['username'] = $username;
                $_SESSION['isAdmin']  = "yes";
                $_SESSION['logged'] = true;
                $loginFound = true;
                break;
            }
        }

        // check amungst normal users if admin login was not found
        if (!$loginFound) {
                $link = connectDb("users");
                $loginFound = false;

                // get docs anche check for match
                $allDocs = $link->getAllDocs();

                foreach ($allDocs->rows as $row) {
                    $doc = $link->asCouchDocuments()->getDoc($row->id);

                    // check match for login and pass
                    if ($doc->get("login") == $username && $doc->get("password") == md5($password)) {
                        $_SESSION['username'] = $username;
                        $_SESSION['isAdmin']  = "no";
                        $_SESSION['logged'] = true;
                        $loginFound = true;
                        break;
                    }
                }
        }
    }


    function showLoginForm() {
        // case 1 - no data inserted. Show login form
        if (empty($username) || empty($password)) {
            // invalid info. Show login
            echo "
            <div class=login-form>
                <h1>Login</h1>
                <form action=# method=post>
                    <input type=text name=username placeholder=username>
                    <input type=password name=password placeholder=password>

                    <span>
                        <input type=checkbox name=checkbox>
                        <label for=checkbox>remember</label>
                    </span>

                    <input type=submit value=login>
                </form>
            </div>";
        }
    }


    function showLogoutForm($username) {
        echo "
            <div class=login-form>
                <h1>Hello, '".$username."'</h1>

                <form action=# method=post>
                    <!-- HACK just to get the button at the bottom until we add some info here-->
                    <br><br><br><br><br>
                    <input type=hidden name=logout value=true>
                    <input type=submit value=logout>
                </form>
            </div>";
    }


?>