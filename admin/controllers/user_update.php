<?php

function update_user()
{
    if (isset($_POST['update_user'])) {
        $mysqli = AdminModel::Provide_Database();

        $user_id = intval($_GET['u_id']);
        $user_firstname = Utility::sanitize($_POST['user_firstname']);
        $user_lastname = Utility::sanitize($_POST['user_lastname']);
        $user_username = Utility::sanitize($_POST['user_username']);
        $user_role = Utility::sanitize($_POST['user_role']);
        $user_email = Utility::sanitize($_POST['user_email']);

        // prepare statement and query
        $stmt = "UPDATE users SET user_firstname = ?, user_lastname = ?, user_username = ?, user_role = ?, user_email = ? WHERE user_id = ?";

        $query = $mysqli->prepare($stmt);

        $query->bind_param('sssssi', $user_firstname, $user_lastname, $user_username, $user_role, $user_email, $user_id);

        $result = $query->execute();

        $query->close();

        // check if query is successfull
        if ($result) {
            AdminUtilities::alert_Success('Succesfully updated a user');
        } else {
            AdminUtilities::alert_Failed();
        }
    }
}
