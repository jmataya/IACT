<?php
function authenticate_site() {
    // Start the session.
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: http://localhost/user_authentication/auth.php?redir=".currentPageUrl());
    }
}

function currentPageUrl() {
    $pageURL = '';
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } 
    else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    
    return $pageURL;
}

?>
