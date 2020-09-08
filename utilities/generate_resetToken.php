<?php

    function generate_resetToken() {
        $mysqli = Model::Provide_Database();

        $email = $_POST['email'];
        $token = bin2hex(openssl_random_pseudo_bytes(50));

        if(Utility::isUserExisting($email, "null")) {
            $query = $mysqli->prepare("UPDATE users SET user_token = ? WHERE user_email = ?");
            $query->bind_param('ss', $token, $email);
            $query->execute();
            $query->close();
            return ['email' => $email, 'token' => $token];
        }

        else {
            return false;
        }
    }
?>