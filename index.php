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
        <link rel="stylesheet" href="css/pages.css" type="text/css" />
    </head>

    <body>
        <h1>#Agatha</h1>

        <!-- TODO make text wrap and stay inside width -->
        <div id="rightPanel">
            <img src="images/logoAgatha.png" width=100% />
            <p>asdasdasdddddddddddddddd</p>
        </div>

        <!-- MENU -->
        <div id="menu">
            <ul>
                <?php
                    // HOMEPAGE
                    // explains roughly what the project is about
                    if($page == "index") {
                        print('<li class="active">Home<br/><span class="active">Agatha project homepage</span></li>');
                    } else {
                        print('<li><a href="?page=index">Home<br/><span>Agatha project homepage</span></a></li>');
                    }

                    // SETUP
                    // explains how to setup the project (link to Github wiki, code etc)
                    if($page == "setup") {
                        print('<li class="active">Agatha setup<br/><span class="active">How to setup an Agatha node</span></li>');
                    } else {
                        print('<li><a href="?page=setup">Agatha setup<br/><span>How to setup an Agatha node</span></a></li>');
                    }

                    // USAGE
                    // explains how to use Agatha's API
                    if($page == "usage") {
                        print('<li class="active">Usage<br/><span class="active">How to use Agatha\'s API</span></li>');
                    } else {
                        print('<li><a href="?page=usage">Usage<br/><span>How to use Agatha\'s API</span></a></li>');
                    }

                    // ABOUT
                    // who wrote the code? who got the idea? contact emails and irc
                    if($page == "about") {
                        print('<li class="active">About<br/><span class="active">Something about the creators of the Agatha project</span></li>');
                    } else {
                        print('<li><a href="?page=about">About<br/><span>Something about the creators of the Agatha project</span></a></li>');
                    }
                ?>
            </ul>
        </div>

        <div id="content">
            <?php
                if (!@include ("pages/".$page."_page.php")) {
                    @include('404.php');
                }
            ?>
        </div>
  </body>

</html>