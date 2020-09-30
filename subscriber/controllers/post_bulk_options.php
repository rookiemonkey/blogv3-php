<?php

function bulk_options_posts()
{
    if (isset($_POST['checkBoxArray'])) {
        $mysqli = AdminModel::Provide_Database();
        $bulk_options = $_POST['bulkOption'];

        foreach ($_POST['checkBoxArray'] as $post_id) {

            switch ($bulk_options) {

                case 'published':
                    $option = 'published';
                    $query = $mysqli->prepare("UPDATE posts set post_status=? WHERE post_id=?");
                    $query->bind_param('si', $option, $post_id);
                    $query->execute();
                    $query->close();
                    break;

                case 'draft':
                    $option = 'draft';
                    $query = $mysqli->prepare("UPDATE posts set post_status=? WHERE post_id=?");
                    $query->bind_param('si', $option, $post_id);
                    $query->execute();
                    $query->close();
                    break;

                case 'delete':

                    // delete comments associated to the post
                    $stmnt = "DELETE FROM comments WHERE comment_post = ?";
                    $query = $mysqli->prepare($stmnt);
                    $query->bind_param("i", $post_id);
                    $query->close();

                    $stmnt = "DELETE FROM posts WHERE post_id = ?";
                    $query = $mysqli->prepare($stmnt);
                    $query->bind_param("i", $post_id);
                    $query->execute();
                    break;

                case 'clone':
                    $query = $mysqli->prepare("SELECT * FROM posts WHERE post_id = ?");
                    $query->bind_param("i", $post_id);
                    $query->execute();
                    $posts = $query->get_result();
                    $query->close();

                    while ($row = $posts->fetch_assoc()) {
                        $post_title        = $row['post_title'];
                        $post_author       = $row['post_author'];
                        $post_category_id  = $row['post_category_id'];
                        $post_status       = $row['post_status'];
                        $post_tags         = $row['post_tags'];
                        $post_content      = $row['post_content'];
                        $post_image        = $row['post_image'];
                        $post_date         = date("Y-m-d");
                        $post_comment_count = 0;
                        $post_views         = 0;
                        $post_likes         = 0;

                        $statement = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status, post_views, post_likes) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

                        $query = $mysqli->prepare($statement);
                        $query->bind_param("sssssssisii", $post_category_id, $post_title, $post_author, $post_date, $post_image, $post_content, $post_tags, $post_comment_count, $post_status, $post_views, $post_likes);

                        $query->execute();
                    }
                    break;


                case 'reset views':
                    $reset = 0;
                    $query = $mysqli->prepare("UPDATE posts SET post_views = ? WHERE post_id = ?");
                    $query->bind_param("ii", $reset, $post_id);
                    $query->execute();
                    $query->close();
                    break;

                default:
                    die();
            }
        }
    }
}
