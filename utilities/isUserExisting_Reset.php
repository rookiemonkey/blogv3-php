<?php

    function isUserExisting_Reset() {
        $mysqli = Model::Provide_Database();
        
        $query = $mysqli->prepare("SELECT user_email, user_token FROM users WHERE user_email = ? AND user_token = ?");

        $query->bind_param('ss', $_GET['email'], $_GET['token']);

        $query->execute();

        $users = $query->get_result();

        $query->close();

        if($users->num_rows === 0) {
            header('Location: index');
        }
    }
?>