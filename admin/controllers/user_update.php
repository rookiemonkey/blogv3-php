<?php

    /**
     * ROUTE: POST /admin/users.php?source=edit_user
     * DESC: update a user
     */
    function update_user() {
        global $mysqli;

        if(isset($_POST['update_user'])) {
            $user_id = intval($_GET['u_id']);
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_username = $_POST['user_username'];
            $user_role = $_POST['user_role'];
            $user_email = $_POST['user_email'];
            $user_avatar = "test+image+page";
            $user_randSalt = "test+random+salt";
            
            // prepare statement and query
            $query = $mysqli->prepare("UPDATE users SET user_firstname = ?, user_lastname = ?, user_username = ?, user_role = ?, user_email = ?, user_avatar = ?, user_randSalt = ? WHERE user_id = ?");

            $query->bind_param('ssssssss', $user_firstname, $user_lastname, $user_username, $user_role, $user_email, $user_avatar, $user_randSalt, $user_id);

            $result = $query->execute();

            $query->close();

            // check if query is successfull
            if($result) { 
                render_alert_success('Succesfully updated a user');
            }
            else { 
                render_alert_failed();
            }
        }
    }
?>