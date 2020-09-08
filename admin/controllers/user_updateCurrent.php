<?php

    function update_current_user() {
        $mysqli = AdminModel::Provide_Database();

        if(isset($_POST['update_user'])) {
            $current_user = $_SESSION['username'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_username = $_POST['user_username'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
            $user_role = 'subscriber';
            $user_avatar = "test+image+page";
            
            // prepare statement and query
            $query = $mysqli->prepare("UPDATE users SET user_firstname = ?, user_lastname = ?, user_username = ?, user_role = ?, user_email = ?, user_password = ?, user_avatar = ? WHERE user_username = ?");

            $query->bind_param('ssssssss', $user_firstname, $user_lastname, $user_username, $user_role, $user_email, $user_password, $user_avatar, $current_user);
            
            $result = $query->execute();

            $query->close();

            // check if query is successfull
            if($result) { 
                AdminUtilities::alert_Success('Succesfully updated your details. Please relogin');
            }
            else { 
                AdminUtilities::alert_Failed('');
            }
        }
    }
?>