<?php

    function render_authorOptions_create() {
        $mysqli = Model::Provide_Database();
            
        $query = $mysqli->prepare("SELECT * FROM users");
        $query->execute();
        $users = $query->get_result();
        
        while($row = $users->fetch_assoc()) {
            echo "<option value='{$row['user_username']}'>{$row['user_username']}</option>";
        }

        $query->close();
    }

?>