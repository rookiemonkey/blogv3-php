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
                            Categories Dashboard
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

                        <div class='col-xs-6'>

        <?php Categories::create(); ?>
        <?php Categories::delete(); ?>
        <?php Categories::update(); ?>

                            <form action='' method='POST'>
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control"  name="cat_title" id="cat_title" required/>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="add_category" value="Add"/>
                                </div>
                            </form>

        <?php update_renderForm(); ?>

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

        <?php Categories::read(); ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

<?php include "./includes/admin_footer.php" ?>