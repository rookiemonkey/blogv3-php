<?php

function approve_comment()
{
    if (isset($_GET['approve'])) {
        $mysqli = AdminModel::Provide_Database();
        $comment_id = intval($_GET['approve']);

        $comment_status = 'approved';

        $query = $mysqli->prepare("UPDATE comments SET comment_status = ? WHERE comment_id = ?");

        $query->bind_param('si', $comment_status, $comment_id);

        $result = $query->execute();

        $query->close();

        // check if query is successfull
        if ($result) {
            // refresh the page
            if (isset($_GET['comments_of_post'])) {
                $post_id = $_GET['comments_of_post'];
                header("Location: /admin/comments.php?comments_of_post={$post_id}");
            } else {
                header("Location: /admin/comments.php");
            }
        } else {
            AdminUtilities::alert_Failed();
        }
    }
}
