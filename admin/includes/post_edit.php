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
        
        if(!$post_row ) { header('Location: posts.php'); }

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

                    <?php render_categoryOptions_edit($post_row); ?>

                </select>
            </div>


            <div class="form-group">
                <label for="users" style="display: block;">Author</label>    
                <select name="post_author">

                    <?php render_authorOptions_edit($post_row); ?>
  
                </select>
            </div>

            <div class="form-group">
                <label for="post_status" style="display: block;">Post Status</label>    
                <select name="post_status" id="post_status">

                    <?php render_poststatusOptions_edit($post_row); ?>

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