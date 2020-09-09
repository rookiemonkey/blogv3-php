<?php

    function read_comments() {
        $mysqli = AdminModel::Provide_Database();

        if(!isset($_GET['comments_of_post'])) {
            // prepare statement and query
            $query = $mysqli->prepare("SELECT * FROM comments");
            $query->execute();
            $comments = $query->get_result();
            $query->close();

            // render a message if no available post
            if($comments->num_rows === 0) {
                AdminUtilities::alert_NoResults("There are no comments for all the posts");
            }
            
            // loop into the results and render
            while($row = $comments->fetch_assoc()) {  

                $query = $mysqli->prepare("SELECT * FROM posts WHERE post_id = ?");
                $query->bind_param('s', $row['comment_post']);
                $query->execute();
                $posts = $query->get_result();
                $post_row = $posts->fetch_assoc();
                $query->close();  
                
                // render delete confirmation modal
                $message = 'Are you sure you want to delete the comment by "'. $row['comment_author'] . '" to ' . $post_row['post_title'] . '?';
                $link = 'comments.php?delete=' . $row['comment_id'] . '&p_id=' . $row['comment_post'];
                AdminUtilities::alert_Modal($row['comment_id'], 'delete', $message, $link);
?>
                    <td><?php echo Utility::sanitize($row['comment_id']); ?></td>
                    <td><?php echo Utility::sanitize($row['comment_date']); ?></td>
                    <td><?php echo Utility::sanitize($row['comment_author']); ?></td>
                    <td><?php echo Utility::sanitize($row['comment_content']); ?></td>
                    <td><?php echo Utility::sanitize($row['comment_email']); ?></td>
                    <td>
                        <a href='../post.php?p_id=<?php echo Utility::sanitize($post_row['post_id']); ?>'>
                            <?php echo Utility::sanitize($post_row['post_title']); ?>
                        </a>
                    </td>
                    <td><?php echo $row['comment_status']; ?></td>
                    <td>
                        <a href='comments.php?approve=<?php echo Utility::sanitize($row['comment_id']); ?>'>
                            Approve
                        </a>
                    </td>
                    <td>
                        <a href='comments.php?unapprove=<?php echo Utility::sanitize($row['comment_id']); ?>'>
                            Unapprove
                        </a>
                    </td>
                    <td>
                        <a data-toggle="modal" data-target="#myModal_<?php echo Utility::sanitize($row['comment_id']); ?>">
                            Delete
                        </a>
                    </td>
                </tr>
<?php
            }
        }
    }
?>