<?php

    function render_roleOptions_edit($user_row) {
        if($user_row['user_role'] === 'subscriber') {
            echo '<option value="subscriber" selected="selected">Subscriber</option>';
            echo '<option value="admin">Admin</option>';
        }

        else if ($user_row['user_role'] === 'admin') {
            echo '<option value="admin" selected="selected">Admin</option>';
            echo '<option value="subscriber">Subscriber</option>';
        }
    }

?>