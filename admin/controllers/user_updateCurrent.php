<?php

    /**
     * ROUTE: POST /admin/profile.php
     * DESC: update currently logged in user
     */
    function update_current_user() {
        global $mysqli;

        if(isset($_POST['update_user'])) {
            $current_user = $_SESSION['username'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_username = $_POST['user_username'];
            $user_role = $_POST['user_role'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
            $user_avatar = "test+image+page";
            $user_randSalt = "test+random+salt";
            
            // prepare statement and query
            $query = $mysqli->prepare("UPDATE users SET user_firstname = ?, user_lastname = ?, user_username = ?, user_role = ?, user_email = ?, user_password = ?, user_avatar = ?, user_randSalt = ? WHERE user_username = ?");

            $query->bind_param('sssssssss', $user_firstname, $user_lastname, $user_username, $user_role, $user_email, $user_password, $user_avatar, $user_randSalt, $current_user);
            
            $result = $query->execute();

            $query->close();

            // check if query is successfull
            if($result) { 
                render_alert_success('Succesfully updated your details');
            }
            else { 
                render_alert_failed();
            }
        }
    }
?>