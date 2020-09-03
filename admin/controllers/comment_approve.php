<?php

    /**
     * ROUTE: admin/comments.php?approve=COMMENTID
     * DESC: approved a comment
     */
    function approve_comment() {
        global $mysqli;

        if(isset($_GET['approve'])) {
            $comment_id = intval($_GET['approve']);
            $comment_status = 'approved';
            $query = $mysqli->prepare("UPDATE comments SET comment_status = ? WHERE comment_id = ?");
            $query->bind_param('si', $comment_status, $comment_id);
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
?>
                <div class='panel panel-danger'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Something went wrong. Please try again later</h3>
                    </div>
                </div>
<?php
            }
        }
    }
?>