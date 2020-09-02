<?php

    /**
     * delete a category
     */
    function delete_category() {
        global $mysqli;

        if(isset($_GET['delete'])) {
            $category_id = $_GET['delete'];
            $category_id = mysqli_real_escape_string($mysqli, $category_id);
            $stmnt = "DELETE FROM categories WHERE cat_id = ?";
            $query = $mysqli->prepare($stmnt); 
            $query->bind_param("s", $category_id);
            $result = $query->execute();

            if($result) { 
                // refresh the page, alert box is working but DOM doesn't update
                header("Location: categories.php");
            }
            
            else { 
?>
                <div class='panel panel-danger'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Something went wrong. Please try again later</h3>
                    </div>
                </div>
<?php
            }

            $query->close();
        }
    }

?>