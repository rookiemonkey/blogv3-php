<?php

    function render_authorOptions_edit($post_row) {
        $mysqli = AdminModel::Provide_Database();

        // echo the initial value of the select which is the current author
        echo "<option value='{$post_row['post_author']}' selected='selected'>{$post_row['post_author']}</option>";

        $query = $mysqli->prepare("SELECT * FROM users");
        $query->execute();
        $users = $query->get_result();
        
        while($row = $users->fetch_assoc()) {

            // else echo an ordinary option tag
            if($row['user_username'] !== $post_row['post_author']) {
                echo "<option value='{$row['user_username']}'>{$row['user_username']}</option>";
            }
        }

        $query->close();    
    }

?>