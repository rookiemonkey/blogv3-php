<?php

    function create_post() {
        $mysqli = AdminModel::Provide_Database();

        if(isset($_POST['create_post'])) {
            $post_title        = Utility::sanitize($_POST['post_title']);
            $post_author       = Utility::sanitize($_POST['post_author']);
            $post_category_id  = Utility::sanitize($_POST['post_category_id']);
            $post_status       = Utility::sanitize($_POST['post_status']);
            $post_tags         = Utility::sanitize($_POST['post_tags']);
            $post_content      = Utility::sanitize($_POST['post_content']);

            $post_image        = Utility::sanitize($_FILES['image']['name']);
            $post_image_temp   = Utility::sanitize($_FILES['image']['tmp_name']);
            $post_comment_count = 0;
            $post_views         = 0;
            $post_likes         = 0;

            $post_date         = date("Y-m-d");

            // upload the image to the server
            define("UPLOAD_LOCATION", $_SERVER['DOCUMENT_ROOT'] . "/cms/assets/images/$post_image");
            move_uploaded_file($post_image_temp, UPLOAD_LOCATION);

            // prepare the statement
            $statement = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status, post_views, post_likes) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $query = $mysqli->prepare($statement);

            // bind the parameters  
            $query->bind_param("sssssssisii", $post_category_id, $post_title, $post_author, $post_date, $post_image, $post_content, $post_tags, $post_comment_count, $post_status, $post_views, $post_likes);

            // execute the query
            $result = $query->execute();

            // close the connection to the database
            $query->close();

            // d=id of the newly created post
            $p_id = mysqli_insert_id($mysqli);

            // check if query is successfull
            if($result) { 
                AdminUtilities::alert_Success("Succesfully added a post");
            }
            else { 
                AdminUtilities::alert_Failed();
            }
        }
    }
?>