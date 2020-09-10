<?php

function register()
{
    $user_firstname = Utility::sanitize($_POST['user_firstname']);
    $user_lastname = Utility::sanitize($_POST['user_lastname']);
    $user_username = Utility::sanitize($_POST['user_username']);
    $user_email = Utility::sanitize($_POST['user_email']);
    $user_password = Utility::sanitize($_POST['user_password']);

    if (
        empty($user_firstname) ||
        empty($user_lastname) ||
        empty($user_username) ||
        empty($user_email) ||
        empty($user_password)
    ) {
        View::alert_Failed('User informations cannot be empty');
    } else if (strlen($user_password) < 8) {
        View::alert_Failed('Passwords should have a minimum of 8 charactes');
    } else if (Utility::isUserExisting($user_email, $user_username)) {
        View::alert_Failed('Username/Email already exists. Please provide a unique username and email');
    } else if (!Utility::isUserExisting($user_email, $user_username)) {
        $user_avatar = Utility::toUpload($_FILES, 'avatars');
        if (!$user_avatar) {
            $user_avatar = "https://res.cloudinary.com/promises/image/upload/v1596613153/global_default_image.png";
        }

        $inputs = [
            'firstname' => $user_firstname,
            'lastname' => $user_lastname,
            'username' => $user_username,
            'email' => $user_email,
            'password' => $user_password,
            'avatar' => $user_avatar,
            'role' => 'subscriber',
            'token' => ''
        ];

        // create the user's account
        $user_info = Utility::toCreate_User($inputs);

        // check if query is successfull
        if (!$user_info['result']) {
            View::alert_Failed('Something went wrong. Please try again');
            exit;
        }

        return [
            'username' => $user_info['username'],
            'password' => $user_info['password']
        ];
    }
}
