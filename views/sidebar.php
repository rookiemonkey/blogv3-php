<?php $mysqli = Model::Provide_Database(); ?>

<div class="col-md-4">

    <?php
    if (isset($_POST['login'])) {
        Controller::login($_POST['username'], $_POST['password']);
    }

    if (!isset($_SESSION['username'])) {
    ?>
        <div class="well">
            <h4>
                Login
                <small>
                    <a href="/forgot?token=<?php echo uniqid(); ?>">
                        Forgot Password?
                    </a>
                </small>
            </h4>
            <form action="" method="POST">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Username" required>
                </div>

                <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Password" required>
                    <span class="input-group-btn">
                        <button class="btn btn-primary" name="login" type="submit">Login</button>
                    </span>
                </div>
            </form>
        </div>
    <?php
    }
    ?>

    <div class="well">
        <h4>Blog Search <small>via tags</small></h4>
        <form action="/search" method="POST">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
    </div>

    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php
                    $query = $mysqli->prepare("SELECT * FROM categories");
                    $query->execute();
                    $catogories = $query->get_result();

                    while ($row = $catogories->fetch_assoc()) {
                        $category_title = $row["cat_title"];
                        $category_id = $row["cat_id"];
                    ?>
                        <li>
                            <a href="/category/<?php echo Utility::sanitize($category_id); ?>">
                                <?php echo Utility::sanitize($category_title); ?>
                            </a>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>

    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>