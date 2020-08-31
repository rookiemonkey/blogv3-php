<?php create_post(); ?>


<form action="" method="post" enctype="multipart/form-data">    
     
        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" class="form-control" name="post_title">
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select name="post_category_id" id="">
                <option>100</option>
            </select>
        </div>


        <div class="form-group">
            <label for="users">Users</label>
            <select name="post_author" id="">
                <option>Kevin Basina<option>
            </select> 
        </div>

        <div class="form-group">
            <select name="post_status" id="">
                <option value="draft">Post Status</option>
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
            <textarea class="form-control "name="post_content" id="" cols="30" rows="10">
            </textarea>
        </div>
      
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
        </div>

</form>
