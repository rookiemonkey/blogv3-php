<?php

    /**
     * ROUTE: GET admin/comments.php?comments_of_post=:POSTID
     * DESC: read all comments of a specific post
     *       and render them as a table
     */
     function read_comments_ofpost() {
        global $mysqli;

        // prepare statement and query
        $post = $_GET['comments_of_post'];
        $query = $mysqli->prepare("SELECT * FROM comments WHERE comment_post = ?");
        $query->bind_param("i", $_GET['comments_of_post']);
        $query->execute();
        $comments = $query->get_result();
        $query->close();

        // render a message if no available post
        if($comments->num_rows === 0) {
            render_alert("However, here are no comments for this post");
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
                    <a href='comments.php?comments_of_post=<?php echo $post ?>&approve=<?php echo $row['comment_id']; ?>'>
                        Approve
                    </a>
                </td>
                <td>
                    <a href='comments.php?comments_of_post=<?php echo $post ?>&unapprove=<?php echo $row['comment_id']; ?>'>
                        Unapprove
                    </a>
                </td>
                 <td>
                    <a href='comments.php?comments_of_post=<?php echo $post ?>&delete=<?php echo $row['comment_id']; ?>'>
                        Delete
                    </a>
                </td>
            </tr>
<?php
        }
    }
?>