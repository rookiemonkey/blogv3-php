<?php require 'vendor/autoload.php'; ?>
<?php View::MainHeader(); ?>
<?php View::Navigation(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">

            <?php View::Post(); ?>
            <?php Controller::add_like(); ?>

            <?php if(Utility::isLoggedIn() && $_SESSION['role'] !== 'admin') { ?>
                <div class="well">

                    <?php Controller::add_comment(); ?>

                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="POSt">
                        <div class="form-group">
                            <textarea name="comment_content" class="form-control" rows="3" id="comment"></textarea>
                        </div>
                        <button name="create_comment" type="submit" class="btn btn-primary">Add Comment</button>
                    </form>
                </div>
            <?php } ?>

            <hr>

            <?php View::Comments(); ?>

        </div>
        
        <?php View::SideBar(); ?>

    </div>
<hr>


<?php
    if(Utility::isLoggedIn()) {
?>
    <script>
        $(document).ready(function() {
            $('#btn_like').on('click', function() {
                let userId = <?php echo Utility::sanitize($_SESSION['id']); ?>;
                let userName = "<?php echo Utility::sanitize($_SESSION['username']); ?>";

                $.ajax({
                    url: '/cms/post.php?p_id=<?php echo Utility::sanitize($_GET['p_id']) ?>',
                    type: 'POST',
                    data: { likedby: userId }
                })
            })

            $('[data-toggle="thumbsup"]').tooltip(); 
        })
    </script>
<?php
    }
?>

<?php View::MainFooter(); ?>
