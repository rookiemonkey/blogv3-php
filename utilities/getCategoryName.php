<?php

    function getCategoryName($category_id) {
        $mysqli = Model::Provide_Database();

        $stmt = "SELECT * FROM categories WHERE cat_id = ?";
        $query = $mysqli->prepare($stmt);
        $query->bind_param('i', $category_id);
        $query->execute();
        $categories = $query->get_result();
        $row = $categories->fetch_assoc();
        $query->close();

        echo $row['cat_title'];
    }

?>