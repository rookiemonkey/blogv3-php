<?php

    function render_authorOptions_create() {
        global $mysqli;
            
        $query = $mysqli->prepare("SELECT * FROM users");
        $query->execute();
        $users = $query->get_result();
        
        while($row = $users->fetch_assoc()) {
            echo "<option value='{$row['user_username']}'>{$row['user_username']}</option>";
        }

        $query->close();
    }

?>