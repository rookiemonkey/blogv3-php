<?php

    function update_category() {
        $mysqli = AdminModel::Provide_Database();

        if(isset($_POST['update_category'])) {
            $category_title = $_POST['cat_title'];
            $category_id = $_GET['update'];

            if(empty($category_title)) { 
                AdminUtilities::alert_Failed('Category title is required');
            }

            else {
                $category_title = mysqli_real_escape_string($mysqli, $category_title);
                $statement = "UPDATE categories SET cat_title = ? WHERE cat_id = ?";
                $query = $mysqli->prepare($statement);
                $query->bind_param("ss", $category_title, $category_id);
                $result = $query->execute();
                $query->close();

                if($result) { 
                    header("Location: categories.php");
                }
                
                else {  
                    AdminUtilities::alert_Failed();
                }
            }
        }
    }
?>