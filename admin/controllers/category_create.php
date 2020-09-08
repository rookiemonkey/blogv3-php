<?php

    function create_category() {
        $mysqli = AdminModel::Provide_Database();

        if(isset($_POST['add_category'])) {
            $category_title = $_POST['cat_title'];

            if(empty($category_title)) { 
                AdminUtilities::alert_Failed('Category title is required');
            }

            else {
                $category_title = mysqli_real_escape_string($mysqli, $category_title);
                $statement = "INSERT INTO categories (cat_title) VALUES (?)";
                $query = $mysqli->prepare($statement);
                $query->bind_param("s", $category_title);
                $result = $query->execute();
                $query->close();

                if($result) { 
                    AdminUtilities::alert_Success('Succesfully added a category');
                }

                else { 
                    AdminUtilities::alert_Failed();
                }
            }
        }
    }
?>