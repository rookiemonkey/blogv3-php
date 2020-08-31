                            <form action='' method='POST'>
                                <div class="form-group">
                                    <label for="cat_title">Update Category</label>
        <?php
            // query the database - get a category upon click of the update button
            if(isset($_GET['update'])) {
                $category_id = $_GET['update'];
                $category_id = mysqli_real_escape_string($mysqli, $category_id);
                $statement = "SELECT * FROM categories WHERE cat_id = ?";
                $query = $mysqli->prepare($statement);
                $query->bind_param("s", $category_id);
                $query->execute();
                $categories = $query->get_result();

                while($row = $categories->fetch_assoc()) {  
                    $category_id =  $row["cat_id"];
                    $category_title = $row["cat_title"];

        ?>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="cat_title" 
                                id="cat_title" 
                                value="<?php if(isset($category_title)) { echo $category_title; } ?>"
                            />
        <?php
                }
            }
        ?>

        <?php
            // display an empty input field on initial load
            if(!isset($_GET['update'])) {
                echo '<input 
                    type="text" 
                    class="form-control" 
                    name="cat_title" 
                    id="cat_title" 
                />';
            }
        ?>

                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="update_category" value="Update"/>
                                </div>
                            </form>