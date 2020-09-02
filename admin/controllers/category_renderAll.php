<?php

    /**
     * read all categories available 
     * and render them as a table
     */
    function read_categories() {
        global $mysqli;

        $query = $mysqli->prepare("SELECT * FROM categories");
        $query->execute();
        $categories = $query->get_result();

        if($query->affected_rows === 0) {
?>
            <h3 class="display-4">No available categories</h3>
<?php
        }

        while($row = $categories->fetch_assoc()) {  
            $category_id = $row["cat_id"];
            $category_title = $row["cat_title"];
?>
            <tr>
                <td><?php echo $category_id; ?></td>
                <td><?php echo $category_title; ?></td>
                <td><a href="categories.php?delete=<?php echo $category_id; ?>">Delete</a></td>
                <td><a href="categories.php?update=<?php echo $category_id; ?>">Update</a></td>
            </tr>
<?php
        }

        $query->close();
    }

?>