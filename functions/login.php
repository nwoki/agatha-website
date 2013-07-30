<!-- This file holds all usefull functions for the website login -->

<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once 'global.php';

    require_once 'PHP-on-Couch/lib/couch.php';
    require_once 'PHP-on-Couch/lib/couchClient.php';
    require_once 'PHP-on-Couch/lib/couchDocument.php';

    function login($username, $password) {
        $conn = connectMysqlDb();
        $query = "select password from web_admins where login=\"$username\"";
        $found = false;

        $result = mysqli_query($conn, $query);

        // get login and pass from database
        $row = mysqli_fetch_assoc($result);
        $out1 = $row['password'];

        if (!empty($out1)) {
            // check validity of password
            if ($out1 == md5($password)) {
                // passwords match
                $_SESSION['username'] = $username;
                $_SESSION['isAdmin']  = "yes";
                $_SESSION['logged'] = true;
            } else {
                // wrong pass
                echo "<div class=\"box red\">ERROR: wrong username or password</div>";
            }
        } else {
            echo "<p>webadmins empty</p>";
            // user doesn't exist. Check in gameserver admin database
            $query = "select id,password from gameserver_admins where login=\"$username\"";
            $result = mysqli_query($conn, $query);

            $row = mysqli_fetch_assoc($result);
            $out1 = $row['password'];
            $out2 = $row['id'];

            if (!empty($out1)) {
                // check validity of password
                if ($out1 == md5($password)) {
                    // passwords match
                    $_SESSION['id'] = $out2;
                    $_SESSION['username'] = $username;
                    $_SESSION['isAdmin']  = "no";
                    $_SESSION['logged'] = true;
                } else {
                    // wrong pass
                    echo "<div class=\"box red\">ERROR: wrong username or password</div>";
                }
            } else {
                echo "<div class=\"box red\">ERROR: wrong username or password</div>";
            }
        }

        mysqli_close($conn);
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