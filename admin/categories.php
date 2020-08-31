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

        <?php create_category(); ?>
        <?php delete_category(); ?>
        <?php update_category(); ?>

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