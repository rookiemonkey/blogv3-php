<?php

    function delete_user() {
        $mysqli = AdminModel::Provide_Database();

        if(isset($_GET['delete'])) {
            // prepare statement and query
            $user_id = intval($_GET['delete']);
            $query = $mysqli->prepare("DELETE FROM users WHERE user_id = ?");
            $query->bind_param('i', $user_id);
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