<?php

function create_post()
{
    if (isset($_POST['create_post'])) {
        $mysqli = AdminModel::Provide_Database();

        $post_title        = Utility::sanitize($_POST['post_title']);
        $post_author       = Utility::sanitize($_POST['post_author']);
        $post_category_id  = Utility::sanitize($_POST['post_category_id']);
        $post_status       = Utility::sanitize($_POST['post_status']);
        $post_tags         = Utility::sanitize($_POST['post_tags']);
        $post_content      = Utility::sanitize($_POST['post_content']);
        $post_comment_count = 0;
        $post_views         = 0;
        $post_likes         = 0;
        $post_date          = date("Y-m-d");

        $post_image_recreated_name = Utility::toUpload($_FILES, 'posts');
        if (!$post_image_recreated_name) {
            return null;
        }

        $statement = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status, post_views, post_likes) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

        $query = $mysqli->prepare($statement);

        $query->bind_param("sssssssisii", $post_category_id, $post_title, $post_author, $post_date, $post_image_recreated_name, $post_content, $post_tags, $post_comment_count, $post_status, $post_views, $post_likes);

        $result = $query->execute();

        $query->close();

        // check if query is successfull
        if ($result) {
            AdminUtilities::alert_Success("Succesfully added a post");
        } else {
            AdminUtilities::alert_Failed();
        }
    }
}
