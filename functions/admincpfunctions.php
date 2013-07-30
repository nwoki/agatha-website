<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once 'global.php';

    function createGameserverAdminAccount($login, $password, $firstName, $lastName, $email) {
        $link = connectMysqlDb();

        // TODO check if account alreaady exists
        $query = "select id from gameserver_admins where login=\"$login\"";

        if (!mysqli_query($link, $query)) {
            echo "<div class=\"box red\">ERROR: ".mysqli_error($link)."</div>";
        } else {
            $result = mysqli_query($link, $query);

            // get id
            $row = mysqli_fetch_assoc($result);
            $out1 = $row['id'];

            if (!empty($out1)) {
                // FAIL! The account already exists
                echo "<div class=\"box red\">ERROR: Account \"$login\" already exists!</div>";
            } else {
                $query = "insert into gameserver_admins values('','$login','".md5($password)."','$firstName','$lastName','$email','".date("Y-m-d H:i:s")."','$_SESSION[username]','".date("Y-m-d H:i:s")."','$_SESSION[username]')";
                echo $query;

                if (!mysqli_query($link, $query)) {
                    echo "<div class=\"box red\">ERROR: ".mysqli_error($link)."</div>";
                } else {
                    echo "<div class=\"box green\">SUCCESS! Account for \"$login\" has been created</div>";
                }
            }
        }

        mysqli_close($con);
    }


    function deleteGameserverAdmin($gameserverAdminId) {
        // TODO delete from mysql && delete all gameservers from couch
    }


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
                        <th scope=col>Last Update</th>
                        <th scope=col>Updated By</th>
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
                <td>".$row["created"]."</td>
                <td>".$row["created_by"]."</td>
                <td>".$row["last_updated"]."</td>
                <td>".$row["last_updated_by"]."</td>
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
                        <form action=# method=post name=delete_web_admin_form>
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


    function showAddGameserverAdminForm() {
        echo "
            <div class=form>
                <h1>New Gameserver Admin</h1>
                <form action=?page=adminvalidation method=post name=add_gameserver_admin_form>
                    <input type=hidden name=add_gameserver_admin>
                    <input type=text maxlength=15 name=new_gameserver_admin_login placeholder=\"Login\">
                    <input type=password maxlength=15 name=new_gameserver_admin_password placeholder=\"Password\">
                    <input type=password maxlength=15 name=new_gameserver_admin_confirm_password placeholder=\"Confirm Password\">
                    <input type=text maxlength=20 name=new_gameserver_admin_first_name placeholder=\"First Name\">
                    <input type=text maxlength=20 name=new_gameserver_admin_last_name placeholder=\"Last Name\">
                    <input type=text maxlength=40 name=new_gameserver_admin_email placeholder=\"Email\">
                    <input type=submit value=create>
                </form>
            </div>";
    }
?>