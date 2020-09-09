<?php

function update_post()
{
    if (isset($_POST['update_post'])) {
        $mysqli = AdminModel::Provide_Database();
        $post_title = Utility::sanitize($_POST["post_title"]);
        $post_category_id = Utility::sanitize($_POST['post_category_id']);
        $post_author = Utility::sanitize($_POST['post_author']);
        $post_status = Utility::sanitize($_POST['post_status']);
        $post_tags = Utility::sanitize($_POST['post_tags']);
        $post_content = Utility::sanitize($_POST['post_content']);

        // prepare statement
        $statement = "UPDATE posts SET post_title = ?, post_category_id = ?, post_author = ?, post_status = ?, post_tags = ?, post_content = ? WHERE post_id = ?";
        $query = $mysqli->prepare($statement);

        // bind parameters
        $query->bind_param("sisssss", $post_title, $post_category_id, $post_author, $post_status, $post_tags, $post_content, $_GET['p_id']);

        // execute the query
        $result = $query->execute();

        // close the connection to the database
        $query->close();

        // check if query is successfull
        if ($result) {
            AdminUtilities::alert_Success("Post Updated succesfully");
        } else {
            AdminUtilities::alert_Failed();
        }
    }
}
