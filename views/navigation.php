<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
    
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/cms/">Logo</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php if (Utility::isAdmin()) { ?>
                        <li>
                            <a href='/cms/admin'>
                                Admin
                            </a>
                        </li>
                <?php } ?>

                <?php if (Utility::isLoggedIn())  { ?>
                        <li>
                            <a href='/cms/api/logout.php'>
                                Logout
                            </a>
                        </li>
                <?php } ?>

                <?php if (!Utility::isLoggedIn())  { ?>
                        <li>
                            <a href='/cms/registration'>
                                Register
                            </a>
                        </li>

                        <li>
                            <a href='/cms/login'>
                                Login
                            </a>
                        </li>
                <?php } ?>

                <?php
                    if(Utility::isLoggedIn() && isset($_GET['p_id'])) {
                ?>
                        <li>
                            <a href="/cms/admin/posts.php?source=edit_post&p_id={$_GET['p_id']}">Edit Post</a>
                        </li>
                <?php
                    }
                ?>
                
            </ul>
        </div>
    </div>
</nav>