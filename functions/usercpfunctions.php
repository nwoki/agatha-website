<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once 'global.php';

    require_once 'PHP-on-Couch/lib/couch.php';
    require_once 'PHP-on-Couch/lib/couchClient.php';
    require_once 'PHP-on-Couch/lib/couchDocument.php';

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
                         <th scope=col>Admin</th>

                     </tr>
                 </thead>
                 <tbody>";

        foreach ($result->rows as $row) {
            $doc = $link->asCouchDocuments()->getDoc($row->id);

            echo "<tr>
                <td>".$row->id."</td>
                <td>".$doc->get("ip")."</td>
                <td>".$doc->get("name")."</td>
                <td>".$doc->get("admin")."</td>
                <td>
                    <form action=# method=post>
                        <input type=hidden name=delete_gameserver value=$row->id>
                        <input type=submit value=Delete>
                    </form>
                </td>
                </tr>";
        }

        // close the table
        echo "</tbody></table></div>";
    }
?>