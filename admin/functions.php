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

        $query->close();
    }







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

            // check if query is successfull
            if($result) { 
                // refresh the page
                header("Location: categories.php");
            }
            else { 
                echo "<div class='panel panel-danger'>";
                echo "<div class='panel-heading'>";
                echo "<h3 class='panel-title'>Something went wrong. Please try again later</h3>";
                echo "</div>";
                echo "</div>";
                die(); 
            }

            $query->close();
        }
    }





    /**
     * update a category
     */

    function update_category() {
        global $mysqli;

        if(isset($_POST['update_category'])) {
            $category_title = $_POST['cat_title'];
            $category_id = $_GET['update'];

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
                $statement = "UPDATE categories SET cat_title = ? WHERE cat_id = ?";
                $query = $mysqli->prepare($statement);
                $query->bind_param("ss", $category_title, $category_id);
                $result = $query->execute();

                // check if query is successfull
                if($result) { 
                    // refresh the page
                    header("Location: categories.php");
                }
                else { 
                    echo "<div class='panel panel-danger'>";
                    echo "<div class='panel-heading'>";
                    echo "<h3 class='panel-title'>Something went wrong. Please try again later</h3>";
                    echo "</div>";
                    echo "</div>";
                }

                $query->close();
            }
        }
    }




    /**
     * conditional render of the update form
     */
    function update_renderForm() {
        global $mysqli;

        if(isset($_GET['update']) && $_GET['update'] === '') {
            echo "<div class='panel panel-danger'>";
            echo "<div class='panel-heading'>";
            echo "<h3 class='panel-title'>Category id is requied</h3>";
            echo "</div>";
            echo "</div>";
        }

        else if (isset($_GET['update'])) { 
            include './includes/update_category.php'; 
        }
    }









    /**
     * read all posts and render them as a table
     */
    function read_posts() {
        global $mysqli;

        // prepare statement and query
        $query = $mysqli->prepare("SELECT * FROM posts");
        $query->execute();
        $posts = $query->get_result();
        
        // loop into the results and render
        while($row = $posts->fetch_assoc()) {  
            echo "<tr>";
            echo "<td>{$row['post_id']}</td>";
            echo "<td>{$row['post_date']}</td>";
            echo "<td>{$row['post_author']}</td>";
            echo "<td>{$row['post_title']}</td>";
            echo "<td>{$row['post_category_id']}</td>";
            echo "<td>{$row['post_status']}</td>";
            echo "<td><img src='../images/{$row['post_image']}.png' 
            alt='{$row['post_title']}' width='100' /></td>";
            echo "<td>{$row['post_tags']}</td>";
            echo "<td>{$row['post_comment_count']}</td>";
            echo "</tr>";
        }

        // close the connection to the database
        $query->close();
    }








    /**
     * create a post
     */
    function create_post() {
        global $mysqli;

        if(isset($_POST['create_post'])) {
            $post_title        = $_POST['post_title'];
            $post_author       = $_POST['post_author'];
            $post_category_id  = $_POST['post_category_id'];
            $post_status       = $_POST['post_status'];
            $post_tags         = $_POST['post_tags'];
            $post_content      = $_POST['post_content'];

            $post_image        = $_FILES['image']['name'];
            $post_image_temp   = $_FILES['image']['tmp_name'];

            $post_date         = date("Y-m-d");
            $post_comment_count = '4';

            // upload the image to the server
            define("UPLOAD_LOCATION", $_SERVER['DOCUMENT_ROOT'] . "/_PHP_blog/images/$post_image");
            move_uploaded_file($post_image_temp, UPLOAD_LOCATION);

            // prepare the statement
            $statement = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES (?,?,?,?,?,?,?,?,?)";
            $query = $mysqli->prepare($statement);

            // bind the parameters
            $query->bind_param("sssssssss", $post_category_id, $post_title, $post_author, $post_date, $post_image, $post_content, $post_tags, $post_comment_count, $post_status);

            // execute the query
            $result = $query->execute();

            // check if query is successfull
            if($result) { 
                echo "<div class='panel panel-success'>";
                echo "<div class='panel-heading'>";
                echo "<h3 class='panel-title'>Succesfully added a post</h3>";
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


?>