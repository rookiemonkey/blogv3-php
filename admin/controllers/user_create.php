<?php

   /**
    * ROUTE: POST /admin/users.php?source=add_user
    * DESC: create a user
    */
    function create_user() {
        $mysqli = Model::Provide_Database();
    
        if(isset($_POST['create_user'])) {
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_username = $_POST['user_username'];
            $user_role = $_POST['user_role'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
            $user_avatar = "test+image+page";

            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
            
            // prepare statement and query
            $query = $mysqli->prepare("INSERT INTO users (user_firstname, user_lastname, user_username, user_role, user_email, user_password, user_avatar) VALUES (?,?,?,?,?,?,?)");

            $query->bind_param('ssssssss', $user_firstname, $user_lastname, $user_username, $user_role, $user_email, $user_password, $user_avatar);

            $result = $query->execute();

            $query->close();

            // check if query is successfull
            if($result) { 
                render_alert_success('Succesfully added a user');
            }
            else { 
                render_alert_failed();
            }
        }
    }
?>