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


                        <?php
                            if(isset($_GET['source'])) {
                                $source = $_GET['source'];

                                switch($source) {
                                    case 'add_post':
                                        include './includes/post_add.php';
                                        break;
                                    case 'edit_post':
                                        include './includes/post_edit.php';
                                        break;
                                    case 'read_comments';
                                        include './includes/comments_read.php';
                                        break;
                                    default:
                                        include './includes/posts_read.php';
                                }
                            }
                            
                            else { include './includes/posts_read.php'; }
                        ?>

                    </div>
                </div>


            </div>
        </div>
    </div>

<?php include "./includes/admin_footer.php" ?>