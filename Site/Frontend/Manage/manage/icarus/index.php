<?php
require_once('auth_module.php');
authenticate_site();
?>
<html>
    <head>
        <title>User Authentication</title> 
    </head>
    <body>
        <h1>Hello, World!</h1>
        <a href="http://localhost/user_authentication/logout.php">Logout</a>
    </body>
</html>
