<?php

    function read_posts() {
        $mysqli = AdminModel::Provide_Database();

        // prepare statement and query
        $query = $mysqli->prepare("SELECT * FROM posts");
        $query->execute();
        $posts = $query->get_result();
        $query->close();

        // render a message if no available post
        if($posts->num_rows === 0) {
            AdminUtilities::alert_NoResults("There are no available posts");
        }
        
        // loop into the results and render
        while($row = $posts->fetch_assoc()) {  
            $query = $mysqli->prepare("SELECT * FROM categories WHERE cat_id = ?");
            $query->bind_param('s', $row['post_category_id']);
            $query->execute();
            $categories = $query->get_result();
            $post_category_row = $categories->fetch_assoc();
            $query->close();

            // render delete confirmation modal
            $message = 'Are you sure you want to delete the post: '. $row['post_title'] . '?';
            $link = './posts.php?delete=' . $row['post_id'];
            AdminUtilities::alert_Modal($row['post_id'], 'delete', $message, $link);
?>
            <tr>
                <th>
                    <input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $row['post_id']; ?>'>
                </th>
                <td><?php echo $row['post_id']; ?></td>
                <td><?php echo $row['post_date']; ?></td>
                <td><?php echo $row['post_views']; ?></td>
                <td><?php echo $row['post_author']; ?></td>
                <td>
                    <a href='../post.php?p_id=<?php echo $row['post_id'] ?>'>
                        <?php echo $row['post_title']; ?>
                    </a>
                </td>
                <td><?php echo $post_category_row['cat_title']; ?></td>
                <td><?php echo $row['post_status']; ?></td>
                <td>
                    <img src='../images/<?php echo $row['post_image']; ?>' 
                alt='<?php echo $row['post_title']; ?>' width='100' />
                </td>
                <td><?php echo $row['post_tags']; ?></td>
                <td>
                    <a href="../admin/comments.php?comments_of_post=<?php echo $row['post_id'] ?>">
                        <?php echo $row['post_comment_count']; ?>
                    </a>
                </td>
                <td>
                    <a data-toggle="modal" data-target="#myModal_<?php echo $row['post_id']; ?>">
                        Delete
                    </a>
                </td>
                <td>
                    <a href='./posts.php?source=edit_post&p_id=<?php echo $row['post_id']; ?>'>
                        Edit
                    </a>
                </td>
            </tr>
<?php
        }
    }
?>
