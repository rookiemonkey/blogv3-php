<?php

    /**
     * ROUTE: GET /admin/users.php?subscriber=USERID
     * DESC: change role to subscriber
     */
    function update_user_toSubscriber() {
        global $mysqli;

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
                render_alert_failed();
            }
        }
    }
?>