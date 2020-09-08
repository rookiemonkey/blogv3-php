<?php

    function update_user_toSubscriber() {
        $mysqli = AdminModel::Provide_Database();

        if(isset($_GET['subscriber'])) {
            // prepare statement and query
            $user_id = intval($_GET['subscriber']);
            $user_role = 'subscriber';
            $query = $mysqli->prepare("UPDATE users SET user_role = ? WHERE user_id = ?");
            $query->bind_param('si', $user_role, $user_id);
            $result = $query->execute();  
            $query->close();
            
            // check if query is successfull
            if($result) { 
                header("Location: users.php");
            }
            else { 
                AdminUtilities::alert_Failed();
            }
        }
    }
?>