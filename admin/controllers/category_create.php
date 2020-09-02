<?php

    /**
     * create a new category
     */
    function create_category() {
        global $mysqli;

        if(isset($_POST['add_category'])) {
            $category_title = $_POST['cat_title'];

            // validation
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
                $statement = "INSERT INTO categories (cat_title) VALUES (?)";
                $query = $mysqli->prepare($statement);
                $query->bind_param("s", $category_title);
                $result = $query->execute();

                // check if query is successfull

                if($result) { 
?>
                    <div class='panel panel-success'>
                        <div class='panel-heading'>
                            <h3 class='panel-title'>Succesfully added a category</h3>
                        </div>
                    </div>
<?php
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

                // close the connection to the database
                $query->close();
            }
        }
    }

?>