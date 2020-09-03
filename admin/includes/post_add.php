<?php Posts::create(); ?>


<form action="" method="post" enctype="multipart/form-data">    
     
        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" class="form-control" name="post_title">
        </div>

        <div class="form-group">
            <label for="category" style="display: block;">Category</label>
            <select name="post_category_id" id="">
                    <?php

                        $query = $mysqli->prepare("SELECT * FROM categories");
                        $query->execute();
                        $categories = $query->get_result();

                        while($row = $categories->fetch_assoc()) {
                            echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
                        }

                        $query->close();

                    ?>
            </select>
        </div>


        <div class="form-group">
            <label for="users" style="display: block;">Users</label>
            <select name="post_author" id="">
                    <?php

                        $query = $mysqli->prepare("SELECT * FROM users");
                        $query->execute();
                        $users = $query->get_result();
                        
                        while($row = $users->fetch_assoc()) {
                            echo "<option value='{$row['user_username']}'>{$row['user_username']}</option>";
                        }

                        $query->close();

                    ?>
            </select> 
        </div>

        <div class="form-group">
            <label for="post_status" style="display: block;">Post Status</label>
            <select name="post_status" id="">
                <option value="draft">Select Options</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div>
      
        <div class="form-group">
            <label for="post_image">Post Image</label>
            <input type="file"  name="image">
        </div>

        <div class="form-group">
            <label for="post_tags">Post Tags</label>
            <input type="text" class="form-control" name="post_tags">
        </div>
      
        <div class="form-group">
            <label for="post_content">Post Content</label>
            <textarea class="form-control "name="post_content" id="body" cols="30" rows="20">
            </textarea>
        </div>
      
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
        </div>

</form>
