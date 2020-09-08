<?php

    function render_categoryOptions_edit($post_row) {
        $mysqli = AdminModel::Provide_Database();
            
        $query = $mysqli->prepare("SELECT * FROM categories");
        $query->execute();
        $categories = $query->get_result();

        while($category_row = $categories->fetch_assoc()) {

            // echo a selected option tag for the current category of the post
            if($post_row['post_category_id'] == $category_row['cat_id']) {
                echo "<option value='{$category_row['cat_id']}' selected='selected'>{$category_row['cat_title']}</option>";
            }

            // else echo an ordinary option tag
            else {
                echo "<option value='{$category_row['cat_id']}'>{$category_row['cat_title']}</option>";
            }
        }

        $query->close();
    }

?>