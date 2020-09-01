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

                <?php
                    $query = $mysqli->prepare("SELECT * FROM categories");
                    $query->execute();
                    $catogories = $query->get_result();

                    while($row = $catogories->fetch_assoc()) {
                        $category_id = $row["cat_id"];
                        $category_title = $row["cat_title"];
                        echo "<li><a href='#'>{$category_title}</a></li>";     
                    }
                ?>

                <li><a href='/_PHP_blog/admin'>Admin</a></li>
                
            </ul>
        </div>
    </div>
</nav>