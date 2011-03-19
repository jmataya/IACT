<?php

// Connect to the database. This is the method that should consistently be used.
function db_connect() {
    $hostname = 'localhost';
    $db_username = 'site';
    $db_password = 'Linux$ite!';
    $db_name = 'iact_corner';

    $db = mysqli_connect(
        $hostname,
        $db_username,
        $db_password,
        $db_name
    );

    if (mysqli_connect_error()) {
        // TODO: Implement better messenging.
        throw new Exception('Unknown error. Please try again later.');
    }

    return $db;
}

// Execute a MySQL function.
function execute_function($db, $mysql_fn) {
    // Construct the query.
    $query = "SELECT ".$mysql_fn;
    $result = mysqli_query($db, $query);

    if ($result->num_rows == 0) {
        throw new Exception('Nothing returned by call.');
    }

    $function_result;
    while ($row = mysqli_fetch_assoc($result)) {
        $function_result = $row[$mysql_fn];
    }

    mysqli_free_result($result);

    return $function_result;
}

?>
