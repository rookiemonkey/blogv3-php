<?php

    AdminPosts::update();
    $mysqli = AdminModel::Provide_Database();

    if(isset($_GET['p_id'])) {
        $query = $mysqli->prepare("SELECT * FROM posts WHERE post_id = ?");
        $query->bind_param('s', $_GET['p_id']);
        $query->execute();
        $post = $query->get_result();
        $post_row = $post->fetch_assoc();
        $query->close();
        
        if(!$post_row ) { header('Location: /cms/admin/posts.php'); }

?>

    <form action="" method="post" enctype="multipart/form-data">    
        
            <div class="form-group">
                <label for="title">Post Title</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="post_title" 
                    value="<?php echo Utility::sanitize($post_row["post_title"]); ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="category" style="display: block;">Category</label>
                <select name="post_category_id">

                    <?php AdminUtilities::render_CategoryOptionsEdit($post_row); ?>

                </select>
            </div>


            <div class="form-group">
                <label for="users" style="display: block;">Author</label>    
                <select name="post_author">

                    <?php AdminUtilities::render_AuthorOptionsEdit($post_row); ?>
  
                </select>
            </div>

            <div class="form-group">
                <label for="post_status" style="display: block;">Post Status</label>    
                <select name="post_status" id="post_status">

                    <?php AdminUtilities::render_PostStatusOptionsEdit($post_row); ?>

                </select>
            </div>
        
            <div class="form-group">
                <label for="post_image">Post Image</label>
                <img 
                    width="100" 
                    src="../images/assets/<?php echo Utility::sanitize($post_row["post_image"]); ?>" 
                    alt="<?php echo Utility::sanitize($post_row["post_title"]); ?>"
                >
            </div>

            <div class="form-group">
                <label for="post_tags">Post Tags</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="post_tags"
                    value="<?php echo Utility::sanitize($post_row["post_tags"]); ?>"
                    required
                >
            </div>
        
            <div class="form-group">
                <label for="post_content">Post Content</label>
                <textarea class="form-control"name="post_content" id="body" cols="30" rows="20">
                    <?php echo Utility::sanitize($post_row["post_content"]); ?>
                </textarea>
            </div>
        
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
            </div>

    </form>

<?php
    }
?>