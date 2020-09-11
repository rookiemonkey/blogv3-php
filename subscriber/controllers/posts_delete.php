<?php

function delete_post()
{
    if (isset($_GET['delete'])) {
        $mysqli = AdminModel::Provide_Database();
        $post_id = $_GET['delete'];
        $post_id = mysqli_real_escape_string($mysqli, $post_id);

        // delete comments associated to the post
        $stmnt = "DELETE FROM comments WHERE comment_post = ?";

        $query = $mysqli->prepare($stmnt);

        $query->bind_param("s", $post_id);

        $query->close();


        // proceed in deleting the post
        $stmnt = "DELETE FROM posts WHERE post_id = ?";

        $query = $mysqli->prepare($stmnt);

        $query->bind_param("s", $post_id);

        $result = $query->execute();

        $query->close();


        // check if query is successfull
        if ($result) {
            // refresh the page
            header("Location: /cms/admin/posts.php");
        } else {
            AdminUtilities::alert_Failed();
        }
    }
}
