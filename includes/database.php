<?php

    define("DB_HOST", "localhost");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "");
    define("DB_DBNAME", "blog");

    $mysqli = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DBNAME);

    if (!$mysqli) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    /* activate reporting */
    $driver = new mysqli_driver();
    $driver->report_mode = MYSQLI_REPORT_STRICT;

    // // commented this one since it show if there is no error in the conenction
    // echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
    // echo "Host information: " . mysqli_get_host_info($mysqli) . PHP_EOL;

?>