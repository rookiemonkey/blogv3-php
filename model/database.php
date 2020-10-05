<?php
ob_start();
define("DB_HOST", "remotemysql.com");
define("DB_USERNAME", "Jqy9cWVl4A");
define("DB_PASSWORD", "TXCPU3PGRh");
define("DB_DBNAME", "Jqy9cWVl4A");

function Initialize_Database()
{
    $mysqli = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DBNAME);

    $mysqli->set_charset("utf8");

    if (!$mysqli) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    return $mysqli;
}

/* activate reporting */
$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_STRICT;

    // // commented this one since it show if there is no error in the conenction
    // echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
    // echo "Host information: " . mysqli_get_host_info($mysqli) . PHP_EOL;
