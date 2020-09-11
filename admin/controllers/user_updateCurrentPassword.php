<?php

use GuzzleHttp\Client;

function update_current_user_password()
{
    if (isset($_POST['update_password'])) {
        $mysqli = AdminModel::Provide_Database();
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if (empty($new_password) || empty($confirm_password)) {
            View::alert_Failed('User informations cannot be empty');
            return null;
        }

        if ($new_password !== $confirm_password) {
            View::alert_Failed("Password doesn't match");
            return null;
        }

        if (strlen($new_password) < 8) {
            View::alert_Failed('Passwords should have a minimum of 8 charactes');
            return null;
        }

        $hashed_password  = password_hash($new_password, PASSWORD_BCRYPT, array('cost' => 12));

        $query = $mysqli->prepare("UPDATE users SET user_password = ? WHERE user_id = ?");

        $query->bind_param('ss', $hashed_password, $_SESSION['id']);

        $result = $query->execute();

        $query->close();

        if ($result) {
            View::alert_Success('Succesfully updated your password. You should now be able to use your new password upon next login');
        } else {
            View::alert_Failed('Failed to update the password. Please try again');
        }
    }
}
