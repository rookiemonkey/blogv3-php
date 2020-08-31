<?php include './includes/header.php' ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include './includes/navigation.php' ?>

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
                            <form action=''>
                                <div class="form-group">
                                    <label for="cat_title">Category</label>
                                    <input type="text" class="form-control"  name="cat_title" id="cat_title"/>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Add Category"/>
                                </div>
                            </form>
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
                                    <tr>
                                        <td>Baseball</td>
                                        <td>Basketball</td>
                                    </tr>
                                    <tr>
                                        <td>Baseball</td>
                                        <td>Basketball</td>
                                    </tr>
                                                                        <tr>
                                        <td>Baseball</td>
                                        <td>Basketball</td>
                                    </tr>
                                                                        <tr>
                                        <td>Baseball</td>
                                        <td>Basketball</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

<?php include "./includes/footer.php" ?>