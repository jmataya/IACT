<?php
    require_once('mysql_functions.php');
    session_start();

    $redir = isset($_GET['redir']) ? $_GET['redir'] : 'index.php';
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    $redirect_url = '';

    try {
        // Check the lengths of the names.
        if (strlen($username) > 45) {
            throw new Exception('err=1');
        }
        else if (strlen($password) > 45) {
            throw new Exception('err=2');
        }

        // Connect to the MySQL database.
        $db = db_connect();

        // Check to see if the user exists.
        $user_exists = "user_exists('".$username."')";
        $result = execute_function($db, $user_exists);

        if ($result == '0') {
            throw new Exception('err=3');
        }

        // Authenticate the user.
        $authenticate_user = "authenticate_user('".$username."','".$password."')";
        $result = execute_function($db, $authenticate_user);

        if ($result == '0') {
            throw new Exception('err=3');
        }

        // The user authenticated correctly.
        $_SESSION['user'] = $username;
        $redirect_url = 'http://'.$redir;
    }
    catch (Exception $e) {
        $redirect_url = 'http://localhost/user_authentication/auth.php?redir='.$redir.'&'.$e->getMessage();
    }

    mysqli_close($db);
    header('Location: '.$redirect_url);
?>
