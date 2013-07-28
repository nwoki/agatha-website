<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once 'global.php';


    function listGameserverAdmins() {
        $link = connectMysqlDb();
        $query = "select * from gameserver_admins";

        // header
        echo "<h2>Gameserver Admins</h2>";

        // prepare table
        echo "<div id=contentPanel>
            <table id=hor-minimalist>
                <thead>
                    <tr>
                        <th scope=col>Login</th>
                        <th scope=col>First Name</th>
                        <th scope=col>Last Name</th>
                        <th scope=col>Email</th>
                        <th scope=col>Created</th>
                        <th scope=col>Created By</th>
                        <th scope=col>Last Modified</th>
                        <th scope=col>Modified By</th>
                    </tr>
                </thead>
            <tbody>";

        $result = mysqli_query($link, $query);

        while ($row = mysqli_fetch_assoc($result)) {

            echo "<tr>
                <td>".$row["login"]."</td>
                <td>".$row["first_name"]."</td>
                <td>".$row["last_name"]."</td>
                <td>".$row["email"]."</td>
                <td>
                    <div class=button>
                        <form action=# method=post>
                            <input type=hidden name=delete_gameserver_admin value=".$row["id"].">
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
                    <input type=\"hidden\" name=\"show_add_gameserver_admin_form\" value=\"true\">
                    <input type=\"submit\" value=\"Add Gameserver Admin\">
                </form>
            </div>";
    }


    function listWebAdmins() {
        $link = connectMysqlDb();
        $query = "select * from web_admins";

        // header
        echo "<h2>Web Admins</h2>";

        // prepare table
        echo "<div id=contentPanel>
             <table id=hor-minimalist>
                 <thead>
                     <tr>
                         <th scope=col>Login</th>
                         <th scope=col>First Name</th>
                         <th scope=col>Last Name</th>
                         <th scope=col>Email</th>
                     </tr>
                 </thead>
                 <tbody>";

        $result = mysqli_query($link, $query);

        while ($row = mysqli_fetch_assoc($result)) {

            echo "<tr>
                <td>".$row["login"]."</td>
                <td>".$row["first_name"]."</td>
                <td>".$row["last_name"]."</td>
                <td>".$row["email"]."</td>
                <td>
                    <div class=button>
                        <form action=# method=post>
                            <input type=hidden name=delete_web_admin value=".$row["id"].">
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
                    <input type=\"hidden\" name=\"show_add_web_admin_form\" value=\"true\">
                    <input type=\"submit\" value=\"Add Web Admin\">
                </form>
            </div>";
    }
?>