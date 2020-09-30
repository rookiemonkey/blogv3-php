<?php

function update_current_user()
{
    if (isset($_POST['update_user'])) {
        $mysqli = AdminModel::Provide_Database();

        $current_user = $_SESSION['username'];
        $user_firstname = Utility::sanitize($_POST['user_firstname']);
        $user_lastname = Utility::sanitize($_POST['user_lastname']);
        $user_username = Utility::sanitize($_POST['user_username']);
        $user_email = Utility::sanitize($_POST['user_email']);

        // prepare statement and query
        $query = $mysqli->prepare("UPDATE users SET user_firstname = ?, user_lastname = ?, user_username = ?, user_email = ? WHERE user_username = ?");

        $query->bind_param('sssss', $user_firstname, $user_lastname, $user_username, $user_email, $current_user);

        $result = $query->execute();

        $result_code = $query->errno;

        $query->close();

        if ($result) {
            SubscriberUtilities::alert_Success('Succesfully updated your details. Please relogin to update your session');
        } else if (!$result && $result_code == 1062) {
            SubscriberUtilities::alert_Failed('Username/Email already exist. Please provide a unique username and email address');
        } else {
            SubscriberUtilities::alert_Failed();
        }
    }
}
