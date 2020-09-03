<?php

    /**
     * ROOUTE: GET /admin/users.php?delete=USERID
     * DESC: delete a user
     */
    function delete_user() {
        global $mysqli;

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
                render_alert_failed();
            }
        }
    }
?>