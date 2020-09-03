<?php

    function render_categoryOptions_create() {
        global $mysqli;
            
        $query = $mysqli->prepare("SELECT * FROM categories");
        $query->execute();
        $categories = $query->get_result();

        while($row = $categories->fetch_assoc()) {
            echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
        }

        $query->close();
    }

?>