<?php include './includes/admin_header.php' ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include './includes/admin_navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>

                        <div class='col-xs-6'>

        <?php
            // update category
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
                        die(); 
                    }
                }
            }
        ?>

        <?php
        
            // add category
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
                        die(); 
                    }
                }
            }

        ?>

                            <form action='' method='POST'>
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control"  name="cat_title" id="cat_title"/>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="add_category" value="Add"/>
                                </div>
                            </form>

                            <?php
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
                            ?>

                        </div>

        <?php

            // query the database - get all categories to render the table
            $query = $mysqli->prepare("SELECT * FROM categories");
            $query->execute();
            $categories = $query->get_result();

        ?>

                        <div class='col-xs-6'>
                            <table class='table table-hover table-bordered'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>


        <?php 
        
            // rendering the table of categories
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

        ?>   


        <?php
        
            // deleting a category
            // href='categories.php?delete={$category_id}
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
            }

        ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

<?php include "./includes/admin_footer.php" ?>