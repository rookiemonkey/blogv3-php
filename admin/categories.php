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
        
            // check if the form is submitted
            if(isset($_POST['submit'])) {
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
                                    <label for="cat_title">Category</label>
                                    <input type="text" class="form-control"  name="cat_title" id="cat_title"/>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Add Category"/>
                                </div>
                            </form>
                        </div>

        <?php

            // query the database
            $query = $mysqli->prepare("SELECT * FROM categories");
            $query->execute();
            $catogories = $query->get_result();

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
        
            // table rows
            while($row = $catogories->fetch_assoc()) {
                $category_id = $row["cat_id"];
                $category_title = $row["cat_title"];
                echo "<tr>";
                echo "<td>{$category_id}</td>";     
                echo "<td>{$category_title}</td>";   
                echo "</tr>";
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