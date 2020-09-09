<?php

    function delete_comment() {
        $mysqli = AdminModel::Provide_Database();

        if(isset($_GET['delete'])) {

            // decrement the total num of comments of the post
            $post_id = intval($_GET['p_id']);

            $query = $mysqli->prepare("UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = ?");

            $query->bind_param('i', $post_id);

            $result = $query->execute();

            $query->close();


            // delete the comment from comment's table
            $comment_id = intval($_GET['delete']);

            $query = $mysqli->prepare("DELETE FROM comments WHERE comment_id = ?");

            $query->bind_param('i', $comment_id);

            $result = $query->execute();

            $query->close();
            

            // check if query is successfull
            if($result) { 
                // refresh the page
                if(isset($_GET['comments_of_post'])) {
                    $post_id = $_GET['comments_of_post'];
                    header("Location: /cms/admin/comments.php?comments_of_post={$post_id}");
                }
                else {
                    header("Location: /cms/admin/comments.php");
                }
            }

            else {
                AdminUtilities::alert_Failed();
            }
        }
    }
?>