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
                echo "<div class='panel panel-danger'>";
                echo "<div class='panel-heading'>";
                echo "<h3 class='panel-title'>Category field is requied</h3>";
                echo "</div>";
                echo "</div>";
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
                    echo "<div class='panel panel-success'>";
                    echo "<div class='panel-heading'>";
                    echo "<h3 class='panel-title'>Succesfully added a category</h3>";
                    echo "</div>";
                    echo "</div>";
                }
                else { 
                    echo "<div class='panel panel-danger'>";
                    echo "<div class='panel-heading'>";
                    echo "<h3 class='panel-title'>Something went wrong. Please try again later</h3>";
                    echo "</div>";
                    echo "</div>";
                }

                // close the connection to the database
                $query->close();
            }
        }
    }





    /**
     * read all categories and 
     * render it as a table
     */
    function read_categories() {
        global $mysqli;

        $query = $mysqli->prepare("SELECT * FROM categories");
        $query->execute();
        $categories = $query->get_result();

        while($row = $categories->fetch_assoc()) {  
            $category_id = $row["cat_id"];
            $category_title = $row["cat_title"];
            echo "<tr>";
            echo "<td>{$category_id}</td>";     
            echo "<td>{$category_title}</td>";   
            echo "<td><a href='categories.php?delete={$category_id}'>Delete</a></td>"; 
            echo "<td><a href='categories.php?update={$category_id}'>Update</a></td>";    
            echo "</tr>";
        }
    }






    

?>