<?php

    /**
     * ROUTE: GET admin/comments.php?delete=:COMMENTID
     * DESC: delete a comment
     */
    function delete_comment() {
        $mysqli = Model::Provide_Database();

        if(isset($_GET['delete'])) {
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
                    header("Location: comments.php?comments_of_post={$post_id}");
                }
                else {
                    header("Location: comments.php");
                }
            }

            else {
                render_alert_failed();
            }
        }
    }
?>