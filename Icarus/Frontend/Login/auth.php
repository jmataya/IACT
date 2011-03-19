<?php

/*
 * Copyright (C) 2011 IACT.
 * Based on code from FluxBB copyright (C) 2008-2011
 * and Rickard Andersson copyright (C) 2002-2008 PunBB.
 *
 * License: http://www.gnu.org/licenses/gpl.html GPL version 3 or higher.
 */

// Get the query string parameters.
$redir = isset($_GET['redir']) ? $_GET['redir'] : 'index.php';
$err = isset($_GET['err']) ? $_GET['err'] : '0';
?>
<html>
    <head>
        <link href="Style/main.css" rel="stylesheet" type="text/css" media="screen" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin" />
        <title>IACT | Icarus</title>
    </head>
    <body>
        <div id="page">
            <div id="header">
                <div id="title">
                    <div id="title_content"><br /></div>
                </div>
            </div>
            <div id="main">
                <div id="leftColumn">
                    <span id="fly">Dare to <em>fly</em></span>
                    <div id="leftSection">
                        <p>IACT Icarus is a new connection platform enabling people to connect to revolutionize healthcare. Users can:</p>
                        <ul>
                            <li>Discuss the next revolutionary ideas</li>
                            <li>Search for exciting opportunities</li>
                            <li>Meet others passionate about innovation</li>
                        </ul>
                        <p>Icarus is currently in private beta. If you're interested in trying Icarus contact <a href="mailto:icarus@iactpgh.com">icarus@iactpgh.com</a>.</p>
                    </div>
                </div>
                <div id="rightColumn">
                    <div id="passwordContainer">
                        <div id="passwordTitle">
                            <span id="passwordTitleContent">Login</span>
                        </div>
                        <div id="passwordContent">
                            <?php
                            // Initiate the form.
                            echo "<form action=\"submit_auth.php?redir=".$redir."\" enctype=\"application/x-www-form-urlencoded\" method=\"post\">";
                            if ($err == '3') {
                                echo 'Username or password is incorrect. Please try again.<br />';
                            }
                            ?>
                            <span id="username">Username</span>
                            <span id="username_textbox">
                                <input maxlength="45" name="username" size="24" type="text" />
                            </span>
                            <?php 
                            if ($err == '1') {
                                echo 'Username must be less than 45 characters.';
                            }
                            ?>
                            <span id="password">Password</span>
                            <span id="password_textbox">
                                <input maxlength="45" name="password" size="24" type="password" />
                            </span>
                            <?php
                            if ($err == '2') {
                                echo 'Password must be less than 45 characters.';   
                            }
                            ?>
                            <span id="submit_button">
                                <input type="submit" value="Submit" />
                            </span>
                            <div id="passwordFooter"><br /></div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
        </div>
    </body>
</html>
