<?php

    Posts::update();

    if(isset($_GET['p_id'])) {
        // prepare statement and query
        $query = $mysqli->prepare("SELECT * FROM posts WHERE post_id = ?");
        $query->bind_param('s', $_GET['p_id']);
        $query->execute();
        $post = $query->get_result();
        $post_row = $post->fetch_assoc();
        $query->close();
        
        if(!$post_row ) { header('Location: posts.php'); die(); }

?>

    <form action="" method="post" enctype="multipart/form-data">    
        
            <div class="form-group">
                <label for="title">Post Title</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="post_title" 
                    value="<?php echo $post_row["post_title"]; ?>"
                >
            </div>

            <div class="form-group">
                <label for="category" style="display: block;">Category</label>
                <select name="post_category_id">
                    <?php
                    
                        $statement = "SELECT * FROM categories";
                        $query = $mysqli->prepare($statement);
                        $query->execute();
                        $categories = $query->get_result();
                    
                        while($category_row = $categories->fetch_assoc()) {

                            // echo an option tag with selected attribute
                            // for the category currently saved on the database
                            // for that post
                            if($post_row['post_category_id'] == $category_row['cat_id']) {
                                echo "<option value='{$category_row['cat_id']}' selected='selected'>{$category_row['cat_title']}</option>";
                            }

                            else {
                                echo "<option value='{$category_row['cat_id']}'>{$category_row['cat_title']}</option>";
                            }
                        }

                    ?>
                </select>
            </div>


            <div class="form-group">
                <label for="users" style="display: block;">Author</label>    
                <select name="post_author">
                    <?php

                        echo "<option value='{$post_row['post_author']}'>{$post_row['post_author']}</option>";

                        $query = $mysqli->prepare("SELECT * FROM users");
                        $query->execute();
                        $users = $query->get_result();
                        
                        while($row = $users->fetch_assoc()) {
                            if($row !== $post_row['post_author']) {
                                echo "<option value='{$row['user_username']}'>{$row['user_username']}</option>";
                            }
                        }

                        $query->close();    
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="post_status" style="display: block;">Post Status</label>    
                <select name="post_status" id="post_status">
                    <?php
                        if($post_row["post_status"] === 'draft') {
                            echo '<option value="draft" selected="selected">Draft</option>';
                            echo '<option value="published">Published</option>';
                        }

                        else if ($post_row["post_status"] === 'published') {
                            echo '<option value="published" selected="selected">Publised</option>';
                            echo '<option value="draft">Draft</option>';
                        }
                    ?>
                </select>
            </div>
        
            <div class="form-group">
                <label for="post_image">Post Image</label>
                <img 
                    width="100" 
                    src="../images/<?php echo $post_row["post_image"] ?>" 
                    alt="<?php echo $post_row["post_title"]; ?>"
                >
            </div>

            <div class="form-group">
                <label for="post_tags">Post Tags</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="post_tags"
                    value="<?php echo $post_row["post_tags"]; ?>"
                >
            </div>
        
            <div class="form-group">
                <label for="post_content">Post Content</label>
                <textarea class="form-control"name="post_content" id="body" cols="30" rows="20">
                    <?php echo $post_row["post_content"]; ?>
                </textarea>
            </div>
        
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
            </div>

    </form>

<?php
    }

?>