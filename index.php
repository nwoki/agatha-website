<?php

    $page = "";

    // get page name
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = "index";
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//IT" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="description" content="The Agatha project website" />
        <title>Agatha</title>

        <link rel="stylesheet" href="css/main.css" type="text/css" />
    </head>

    <body>
        <h1>#Agatha</h1>

        <div id="menu">
            <ul>
                <!-- HOMEPAGE -->
                <li>
                    <a href="?page=index">
                        Home<br/>
                        <span>Agatha project homepage</span>
                    </a>
                </li>

                <!-- WHAT IS IT? -->
                <li>
                    <a href="?page=whatisit">
                        What is Agatha?<br/>
                        <span>A description of the Agatha proejct</span>
                    </a>
                </li>

                <!-- ABOUT -->
                <li>
                    <a href="?page=about">
                        About<br/>
                        <span>Something about the creators of the Agatha project</span>
                    </a>
                </li>
            </ul>
        </div>
    </body>

</html>