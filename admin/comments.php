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
                            Comments Dashboard
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>


                        <?php

                            include './includes/comments_read.php'
                        ?>

                    </div>
                </div>


            </div>
        </div>
    </div>

<?php include "./includes/admin_footer.php" ?>