<?php

function delete_category()
{
    if (isset($_GET['delete'])) {
        $mysqli = AdminModel::Provide_Database();
        $category_id = $_GET['delete'];
        $category_id = mysqli_real_escape_string($mysqli, $category_id);

        $stmnt = "DELETE FROM categories WHERE cat_id = ?";

        $query = $mysqli->prepare($stmnt);

        $query->bind_param("s", $category_id);

        $result = $query->execute();

        $query->close();

        if ($result) {
            // refresh the page, alert box is working but DOM doesn't update
            header("Location: /admin/categories.php");
        } else {
            AdminUtilities::alert_Failed();
        }
    }
}
