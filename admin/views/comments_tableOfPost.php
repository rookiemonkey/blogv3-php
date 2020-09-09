<?php

function read_comments_ofpost()
{
    $mysqli = AdminModel::Provide_Database();

    if (isset($_GET['comments_of_post'])) {
        // prepare statement and query
        $post = $_GET['comments_of_post'];
        $query = $mysqli->prepare("SELECT * FROM comments WHERE comment_post = ?");
        $query->bind_param("i", $_GET['comments_of_post']);
        $query->execute();
        $comments = $query->get_result();
        $query->close();

        // render a message if no available post
        if ($comments->num_rows === 0) {
            AdminUtilities::alert_NoResults("There are no comments for this post");
        }

        // loop into the results and render
        while ($row = $comments->fetch_assoc()) {

            $query = $mysqli->prepare("SELECT * FROM posts WHERE post_id = ?");
            $query->bind_param('s', $row['comment_post']);
            $query->execute();
            $posts = $query->get_result();
            $post_row = $posts->fetch_assoc();
            $query->close();
?>
            <td><?php echo Utility::sanitize($row['comment_id']); ?></td>
            <td><?php echo Utility::sanitize($row['comment_date']); ?></td>
            <td><?php echo Utility::sanitize($row['comment_author']); ?></td>
            <td><?php echo Utility::sanitize($row['comment_content']); ?></td>
            <td><?php echo Utility::sanitize($row['comment_status']); ?></td>
            <td>
                <a href='../post.php?p_id=<?php echo $post_row['post_id'] ?>'>
                    <?php Utility::sanitize($post_row['post_title']); ?>
                </a>
            </td>
            <td>
                <a href='comments.php?comments_of_post=<?php echo $post ?>&approve=<?php echo Utility::sanitize($row['comment_id']); ?>'>
                    Approve
                </a>
            </td>
            <td>
                <a href='comments.php?comments_of_post=<?php echo $post ?>&unapprove=<?php echo Utility::sanitize($row['comment_id']); ?>'>
                    Unapprove
                </a>
            </td>
            <td>
                <a href='comments.php?comments_of_post=<?php echo $post ?>&delete=<?php echo Utility::sanitize($row['comment_id']); ?>'>
                    Delete
                </a>
            </td>
            </tr>
<?php
        }
    }
}
?>