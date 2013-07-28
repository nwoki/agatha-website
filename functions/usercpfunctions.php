<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once 'global.php';

    require_once 'PHP-on-Couch/lib/couch.php';
    require_once 'PHP-on-Couch/lib/couchClient.php';
    require_once 'PHP-on-Couch/lib/couchDocument.php';

    function addGameserver($ip, $name) {
        if (!isset($ip) || !isset($name)) {
            // alert user with simple js alert function
        } else {
            // add to database
            $link = connectDb("gameservers");
            $newDoc = new stdClass();
            $newDoc->ip = $ip;
            $newDoc->name = $name;
            $newDoc->admin = $_SESSION['username'];

            try {
                $response = $link->storeDoc($newDoc);
            } catch (Exception $e) {
                // just need the first part of the error msg
                $error = explode('(', $e->getMessage());
                echo "<script language=javascript>alert(\"$error[0]\")</script>";
            }
        }

        // post-redirect-get to avoid duplicate calls
//         header("Location: " . $_SERVER['REQUEST_URI']);
    }

    function deleteGameserver($gameserverId) {
        $link = connectDb("gameservers");
        $doc = $link->getDoc($gameserverId);
        $link->deleteDoc($doc);

        // post-redirect-get to avoid duplicate calls
        header("Location: " . $_SERVER['REQUEST_URI']);
    }


    function listUserGameservers($username) {
        $link = connectDb("gameservers");
        $result = $link->key($username)->getView('user_gameservers','by_login');

        // prepare table
        echo "<div id=contentPanel>
             <table id=hor-minimalist>
                 <thead>
                     <tr>
                         <th scope=col>Token</th>
                         <th scope=col>Ip</th>
                         <th scope=col>Name</th>
                     </tr>
                 </thead>
                 <tbody>";

        foreach ($result->rows as $row) {
            $doc = $link->asCouchDocuments()->getDoc($row->id);

            echo "<tr>
                <td>".$row->id."</td>
                <td>".$doc->get("ip")."</td>
                <td>".$doc->get("name")."</td>
                <td>
                    <div class=button>
                        <form action=# method=post>
                            <input type=hidden name=delete_gameserver value=$row->id>
                            <input type=submit value=Delete>
                        </form>
                    </div>
                </td>
                </tr>";
        }

        // close the table
        echo "</tbody></table></div>";

        // add gameserver button
        echo "
            <div class=\"button\">
                <form action=\"#\" method=\"post\">
                    <input type=\"hidden\" name=\"show_add_gameserver_form\" value=\"true\">
                    <input type=\"submit\" value=\"Add Gameserver\">
                </form>
            </div>";
    }


    function showAddGamerserverForm() {
        echo "
            <div class=form>
                <h1>New Gameserver</h1>
                <form action=# method=post name=add_gameserver_form onsubmit=validate()>
                    <input type=hidden name=add_gameserver>
                    <input type=text name=new_gameserver_ip placeholder=\"gameserver ip address\">
                    <input type=text name=new_gameserver_name placeholder=\"gamserver name\">
                    <input type=submit value=create>
                </form>
            </div>";
    }
?>