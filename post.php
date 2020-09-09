<?php require 'vendor/autoload.php'; ?>
<?php View::MainHeader(); ?>
<?php View::Navigation(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">

            <?php View::Post(); ?>

            <div class="well">

                <?php Controller::add_comment(); ?>
                <?php Controller::add_like(); ?>

                <h4>Leave a Comment:</h4>

                <form role="form" action="" method="POSt">
                    <div class="form-group">
                        <label for="author">Author: </label>
                        <input name="comment_author" type='text' class="form-control" id="author" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input name="comment_email" type='email' class="form-control" id="email" required>
                    </div>  
                    <div class="form-group">
                        <label for="comment">Comment: </label>
                        <textarea name="comment_content" class="form-control" rows="3" id="comment"></textarea>
                    </div>
                    <button name="create_comment" type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

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
