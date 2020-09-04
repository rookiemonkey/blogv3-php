<?php

    function is_user_exisiting($email, $username) {
        global $mysqli;

        $query = $mysqli->prepare('SELECT * FROM users WHERE user_email = ? OR user_username = ?');
        $query->bind_param('ss', $email, $username);
        $query->execute();
        $users = $query->get_result();
        $query->close();
        $users->fetch_assoc();

        if($users->num_rows > 0) {
            return true;
        }

        else {
            return false;
        }
    }
?>