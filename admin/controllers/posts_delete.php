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

        $query->execute();

        $query->close();


        // delete the image associated to the post
        $stmnt = "SELECT post_image FROM posts WHERE post_id = ?";

        $query = $mysqli->prepare($stmnt);

        $query->bind_param("s", $post_id);

        $query->execute();

        $results = $query->get_result();

        $row = $results->fetch_assoc();

        $image = $_SERVER['DOCUMENT_ROOT'] . "/cms/assets/images/posts/" . $row['post_image'];

        if (file_exists($image)) {
            unlink($image);
        }

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
