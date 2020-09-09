<?php

    function add_comment() {
        if(
        $_POST['comment_author'] !== '' || 
        $_POST['comment_email'] !== '' || 
        $_POST['comment_content'] !== ''
        ) { 
            $mysqli = Model::Provide_Database();

            $comment_post = intval($_GET['p_id']);
            $comment_author = Utility::sanitize($_POST['comment_author']);
            $comment_email = Utility::sanitize($_POST['comment_email']);
            $comment_content = Utility::sanitize($_POST['comment_content']);
            $comment_date = date("Y-m-d");
            $comment_status = "unapproved";

            $statement = "INSERT INTO comments (comment_post, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES (?,?,?,?,?,?)";
            
            $query = $mysqli->prepare($statement);

            $query->bind_param("isssss", $comment_post, $comment_author, $comment_email, $comment_content, $comment_status, $comment_date);

            $result = $query->execute();

            $query->close();

            // check if query is successfull
            if($result) { 
                View::alert_Success("Succesfully added a comment. Once approved by admin, it will be visible on this post.");

                // increment the comment count on post
                $statement = "UPDATE posts SET post_comment_count  = post_comment_count + 1 WHERE post_id = ?";
                $query = $mysqli->prepare($statement);
                $query->bind_param("s", $comment_post);
                $result = $query->execute();
                $query->close();
            }
            else { 
                View::alert_Failed("Something went wrong. Please try again later");
            }
        }

        else {
            View::alert_Failed("Please complete your comment details");
        }
    }
?>