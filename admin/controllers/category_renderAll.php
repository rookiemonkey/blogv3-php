<?php

    /**
     * read all categories available 
     * and render them as a table
     */
    function read_categories() {
        $mysqli = Model::Provide_Database();

        $query = $mysqli->prepare("SELECT * FROM categories");
        $query->execute();
        $categories = $query->get_result();
        $categories_count = $query->affected_rows;
        $query->close();

        if($categories_count === 0) {
            echo "<div class='alert alert-danger' role='alert'>No available categories</div>";
        }

        while($row = $categories->fetch_assoc()) {  
            $category_id = $row["cat_id"];
            $category_title = $row["cat_title"];

            // render delete confirmation modal
            $message = 'Are you sure you want to delete the ' . $category_title . ' category' . '?';
            $link = 'categories.php?delete=' . $category_id;
            render_modal($category_id, 'delete', $message, $link);
?>
            <tr>
                <td><?php echo $category_id; ?></td>
                <td><?php echo $category_title; ?></td>
                <td>
                    <a data-toggle="modal" data-target="#myModal_<?php echo $category_id; ?>">
                        Delete
                    </a>
                </td>
                <td>
                    <a href="categories.php?update=<?php echo $category_id; ?>">
                        Update
                    </a>
                </td>
            </tr>
<?php
        }
    }
?>