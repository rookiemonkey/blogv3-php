<?php

function create_user()
{
    $mysqli = AdminModel::Provide_Database();

    if (isset($_POST['create_user'])) {
        $user_firstname = Utility::sanitize($_POST['user_firstname']);
        $user_lastname = Utility::sanitize($_POST['user_lastname']);
        $user_username = Utility::sanitize($_POST['user_username']);
        $user_role = Utility::sanitize($_POST['user_role']);
        $user_email = Utility::sanitize($_POST['user_email']);
        $user_password = Utility::sanitize($_POST['user_password']);
        $user_avatar = "https://res.cloudinary.com/promises/image/upload/v1596613153/global_default_image.png";

        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

        // prepare statement and query
        $query = $mysqli->prepare("INSERT INTO users (user_firstname, user_lastname, user_username, user_role, user_email, user_password, user_avatar) VALUES (?,?,?,?,?,?,?)");

        $query->bind_param('sssssss', $user_firstname, $user_lastname, $user_username, $user_role, $user_email, $user_password, $user_avatar);

        $result = $query->execute();

        $query->close();

        // check if query is successfull
        if ($result) {
            AdminUtilities::alert_Success('Succesfully added a user');
        } else {
            AdminUtilities::alert_Failed();
        }
    }
}
