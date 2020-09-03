<?php

    /**
     * ROUTE: GET admin/comments.php
     * DESC: read all comments and render them as a table
     */
    function read_comments() {
        global $mysqli;

        // prepare statement and query
        $query = $mysqli->prepare("SELECT * FROM comments");
        $query->execute();
        $comments = $query->get_result();
        $query->close();

        // render a message if no available post
        if($comments->num_rows === 0) {
            render_alert_tablenoresult("However, there are no comments for all the posts");
        }
        
        // loop into the results and render
        while($row = $comments->fetch_assoc()) {  

            $query = $mysqli->prepare("SELECT * FROM posts WHERE post_id = ?");
            $query->bind_param('s', $row['comment_post']);
            $query->execute();
            $posts = $query->get_result();
            $post_row = $posts->fetch_assoc();
            $query->close();      
?>
            <tr>
                <td><?php echo $row['comment_id']; ?></td>
                <td><?php echo $row['comment_date']; ?></td>
                <td><?php echo $row['comment_author']; ?></td>
                <td><?php echo $row['comment_content']; ?></td>
                <td><?php echo $row['comment_email']; ?></td>
                <td>
                    <a href='../post.php?p_id=<?php echo $post_row['post_id'] ?>'>
                        <?php $post_row['post_title'] ?>
                    </a>
                </td>
                <td><?php echo $row['comment_status']; ?></td>
                <td>
                    <a href='comments.php?approve=<?php echo $row['comment_id']; ?>'>
                        Approve
                    </a>
                </td>
                <td>
                    <a href='comments.php?unapprove=<?php echo $row['comment_id']; ?>'>
                        Unapprove
                    </a>
                </td>
                <td>
                    <a href='comments.php?delete=<?php echo $row['comment_id']; ?>'>
                        Delete
                    </a>
                </td>
            </tr>
<?php
        }
    }
?>