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
                            Users Dashboard
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>


                        <?php
                            if(isset($_GET['source'])) {
                                $source = $_GET['source'];

                                switch($source) {
                                    case 'add_user':
                                        include './includes/user_add.php';
                                        break;
                                    case 'edit_user':
                                        include './includes/user_edit.php';
                                        break;
                                    default:
                                        include './includes/users_read.php';
                                }
                            }
                            
                            else { include './includes/users_read.php'; }
                        ?>

                    </div>
                </div>


            </div>
        </div>
    </div>

<?php include "./includes/admin_footer.php" ?>