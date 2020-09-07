<?php

    function register_user($inputs) {
        global $mysqli;

        $password_raw = $inputs['password'];

        $inputs['password'] = password_hash($inputs['password'], PASSWORD_BCRYPT, array('cost' => 12));

        $query = $mysqli->prepare("INSERT INTO users (user_firstname, user_lastname, user_username, user_role, user_email, user_password, user_avatar, user_randSalt, user_token) VALUES (?,?,?,?,?,?,?,?,?)");

        $query->bind_param('sssssssss', $inputs['firstname'], $inputs['lastname'], $inputs['username'], $inputs['role'], $inputs['email'], $inputs['password'], $inputs['avatar'], $inputs['randSalt'], $inputs['token']);

        $result = $query->execute();

        $query->close();

        return [
            'username' => $inputs['username'], 
            'password' => $password_raw,
            'result' => $result
        ];
    }

?>