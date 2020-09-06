<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
    
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/_PHP_blog/">Logo</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li>
                    <a href='/_PHP_blog/admin'>
                        Admin
                    </a>
                </li>

                <li>
                    <a href='/_PHP_blog/registration'>
                        Register
                    </a>
                </li>

                <?php
                    if(isset($_SESSION['role'])) {

                        if(isset($_GET['p_id'])) {
                            $post_id = $_GET['p_id'];

                            echo "<li><a href='/_PHP_blog/admin/posts.php?source=edit_post&p_id={$post_id}'>Edit Post</a></li>";
                        }
                    }
                ?>
                
            </ul>
        </div>
    </div>
</nav>