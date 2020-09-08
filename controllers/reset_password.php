<?php

    function password_reset() {
        $mysqli = Model::Provide_Database();

        $new = $_POST['newpassword'];
        $confirm = $_POST['confirmpassword'];
        $email = $_GET['email'];
        $token = $_GET['token'];

        // check if the token is still available
        $query = $mysqli->prepare("SELECT * FROM users WHERE user_token = ? AND user_email = ?");
        $query->bind_param('ss', $token, $email);
        $query->execute();
        $users = $query->get_result();
        $query->close();

        if($new !== $confirm) {
            View::alert_Failed("Failed. Passwords doesn't match");
        }

        else if (strlen($new) < 8) {
            View::alert_Failed('Failed. Passwords should have a minimum of 8 charactes');
        }

        else if ($users->num_rows === 0) {
            View::alert_Failed('Failed. Password is already updated');
        }

        else {
            $token = '';

            $new = password_hash($new, PASSWORD_BCRYPT, array('cost' => 12));

            $statement = "UPDATE users SET user_password = ?, user_token = ? WHERE user_email = ?";

            $query = $mysqli->prepare($statement);

            $query->bind_param("sss", $new, $token, $email);

            $query->execute();

            $query->close();

            View::alert_Success('Success! Please login using your new password');
        }
    }
?>