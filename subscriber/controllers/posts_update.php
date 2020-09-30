<?php

function update_post()
{
    if (isset($_POST['update_post'])) {
        $mysqli = AdminModel::Provide_Database();
        $post_title = Utility::sanitize($_POST["post_title"]);
        $post_category_id = Utility::sanitize($_POST['post_category_id']);
        $post_status = Utility::sanitize($_POST['post_status']);
        $post_tags = Utility::sanitize($_POST['post_tags']);
        $post_content = Utility::sanitize($_POST['post_content']);
        $oldimage = Utility::sanitize(($_POST['post_oldimage']));
        $newimage = '';

        // check if user uploaded a new image
        if (strlen(($_FILES['image']['tmp_name'])) > 0) {
            $newimage = Utility::toUploadUpdate($oldimage, $_FILES, 'posts');
            if (!$newimage) {
                return null;
            }
        } else {
            $newimage = $oldimage;
        }

        // prepare statement
        $statement = "UPDATE posts SET post_title = ?, post_category_id = ?, post_status = ?, post_tags = ?, post_content = ?, post_image = ? WHERE post_id = ?";
        $query = $mysqli->prepare($statement);

        // bind parameters
        $query->bind_param("sisssss", $post_title, $post_category_id, $post_status, $post_tags, $post_content, $newimage, $_GET['p_id']);

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
