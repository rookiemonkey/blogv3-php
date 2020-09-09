<?php

function delete_user()
{
    if (isset($_GET['delete'])) {
        $mysqli = AdminModel::Provide_Database();
        $user_id = intval($_GET['delete']);

        $query = $mysqli->prepare("DELETE FROM users WHERE user_id = ?");

        $query->bind_param('i', $user_id);

        $result = $query->execute();

        $query->close();

        // check if query is successfull
        if ($result) {
            header("Location: /cms/admin/users.php");
        } else {
            AdminUtilities::alert_Failed();
        }
    }
}
