<?php

    /**
     * create a new category
     */
    function create_category() {
        $mysqli = Model::Provide_Database();

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
                $query->close();

                // check if query is successfull
                if($result) { 
                    render_alert_success('Succesfully added a category');
                }

                else { 
                    render_alert_failed();
                }
            }
        }
    }
?>