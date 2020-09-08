<?php

    function render_authorOptions_create() {
        $mysqli = AdminModel::Provide_Database();
            
        $query = $mysqli->prepare("SELECT * FROM users");
        $query->execute();
        $users = $query->get_result();
        
        while($row = $users->fetch_assoc()) {
            if($row['user_username'] === $_SESSION['username']) {
                echo "<option value='{$row['user_username']}' selected='selected'>{$row['user_username']}</option>";
            }
            else {
                echo "<option value='{$row['user_username']}'>{$row['user_username']}</option>";
            }
        }

        $query->close();
    }

?>