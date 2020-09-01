<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="./search.php" method="POST">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" type="submit" class="btn btn-default" >
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
    </div>

    <!-- Blog Categories Well -->
    <div class="well">

                    <?php
                        $query = $mysqli->prepare("SELECT * FROM categories");
                        $query->execute();
                        $catogories = $query->get_result();

                    ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    
                    <?php 
                    
                        while($row = $catogories->fetch_assoc()) {
                            $category_title = $row["cat_title"];
                            $category_id = $row["cat_id"];
                            echo "<li><a href='/_PHP_blog/category.php?c_id={$category_id}'>{$category_title}</a></li>";     
                        }

                    ?>    

                </ul>
            </div>
        </div>
    </div>


    <!-- Side Widget Well -->
    <?php include "widget.php" ?>

</div>