<?php

    function update_post() {
        $mysqli = AdminModel::Provide_Database();

        if(isset($_POST['update_post'])) {
            $post_title = $_POST["post_title"];
            $post_category_id = $_POST['post_category_id'];
            $post_author = $_POST['post_author'];
            $post_status = $_POST['post_status'];
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];

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
            if($result) { 
                AdminUtilities::alert_Success("Post Updated succesfully");
            }
            else { 
                AdminUtilities::alert_Failed();
            }
        }
    }
?>