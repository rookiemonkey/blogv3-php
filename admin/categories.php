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

        <!-- create a category -->
        <?php create_category(); ?>

         <!-- delete a category -->
        <?php delete_category() ?>

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

                        <div class='col-xs-6'>
                            <table class='table table-hover table-bordered'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <!-- read all categories. render as table -->
                                <?php read_categories() ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

<?php include "./includes/admin_footer.php" ?>