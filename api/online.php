<?php

    require '../vendor/autoload.php';
    $mysqli = Model::Provide_Database();
    
    /**
     * an endpoint for loadUsersOnline ajax call
     * query the database and a row for logged in users
     */
    if(isset($_GET['onlineusers'])) {
        // query number of users online
        $query = $mysqli->prepare("SELECT * FROM users_online");
        $query->execute();
        $users_online = $query->get_result();
        $query->close();
        $users_online_count = $users_online->num_rows;
        echo $users_online_count;
    }

?>