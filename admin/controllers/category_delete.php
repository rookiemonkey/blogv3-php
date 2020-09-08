<?php

    /**
     * delete a category
     */
    function delete_category() {
        $mysqli = Model::Provide_Database();

        if(isset($_GET['delete'])) {
            $category_id = $_GET['delete'];
            $category_id = mysqli_real_escape_string($mysqli, $category_id);
            $stmnt = "DELETE FROM categories WHERE cat_id = ?";
            $query = $mysqli->prepare($stmnt); 
            $query->bind_param("s", $category_id);
            $result = $query->execute();
            $query->close();

            if($result) { 
                // refresh the page, alert box is working but DOM doesn't update
                header("Location: categories.php");
            }
            
            else { 
                render_alert_failed();
            }
        }
    }
?>