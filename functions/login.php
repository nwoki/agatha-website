<!-- This file holds all usefull functions for the website login -->

<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require 'global.php';

    function login($username, $password) {
        $link = connectDb();
        $query = "select password from web_admins where login=\"$username\"";
        $found = false;

        $result = mysqli_query($link, $query);

        // get login and pass from database
        while( $row = mysqli_fetch_assoc($result)) {
            $out1 = $row['password'];
        }

        if (!empty($out1)) {
            // check validity of password
            if ($out1 = md5($password)) {
                // passwords match
                $_SESSION['username'] = $username;
                $_SESSION['logged'] = true;
            } else {
                // wrong pass
            }
        } else {
//             echo "user doesn't exist";
        }

        mysqli_close($link);
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

                <ul>
                    <li>Admin Panel</li>
                </ul>

                <form action=# method=post>
                    <input type=hidden name=logout value=true>
                    <input type=submit value=logout>
                </form>
            </div>";
    }


?>