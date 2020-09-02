<?php

    /**
     * update a category
     */
    function update_category() {
        global $mysqli;

        if(isset($_POST['update_category'])) {
            $category_title = $_POST['cat_title'];
            $category_id = $_GET['update'];

            if(empty($category_title)) { 
?>
                <div class='panel panel-danger'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Category field is requied</h3>
                    </div>
                </div>
<?php
            }

            else {
                // prepare statement and query
                $category_title = mysqli_real_escape_string($mysqli, $category_title);
                $statement = "UPDATE categories SET cat_title = ? WHERE cat_id = ?";
                $query = $mysqli->prepare($statement);
                $query->bind_param("ss", $category_title, $category_id);
                $result = $query->execute();

                // check if query is successfull
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
    }

?>