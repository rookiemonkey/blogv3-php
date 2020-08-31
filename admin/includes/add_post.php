<?php

    if(isset($_POST['create_post'])) {
        $post_title        = $_POST['post_title'];
        $post_author       = $_POST['post_author'];
        $post_category_id  = $_POST['post_category_id'];
        $post_status       = $_POST['post_status'];
        $post_tags         = $_POST['post_tags'];
        $post_content      = $_POST['post_content'];

        $post_image        = $_FILES['image']['name'];
        $post_image_temp   = $_FILES['image']['tmp_name'];

        $post_date         = date('d-m-y');
        $post_comment_count = '4';

        // upload the image to the server
        define("UPLOAD_LOCATION", $_SERVER['DOCUMENT_ROOT'] . "/_PHP_blog/images/$post_image");
        move_uploaded_file($post_image_temp, UPLOAD_LOCATION);

        // prepare the statement
        $statement = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES (?,?,?,?,?,?,?,?,?)";
        $query = $mysqli->prepare($statement);

        // bind the parameters
        $query->bind_param("sssssssss", $post_category_id, $post_title, $post_author, $post_date, $post_image, $post_content, $post_tags, $post_comment_count, $post_status);

        // execute the query
        $result = $query->execute();

        // check if query is successfull
        if($result) { 
            echo "<div class='panel panel-success'>";
            echo "<div class='panel-heading'>";
            echo "<h3 class='panel-title'>Succesfully added a post</h3>";
            echo "</div>";
            echo "</div>";
        }
        else { 
            echo "<div class='panel panel-danger'>";
            echo "<div class='panel-heading'>";
            echo "<h3 class='panel-title'>Something went wrong. Please try again later</h3>";
            echo "</div>";
            echo "</div>";
        }

        // close the connection to the database
        $query->close();
    }

?>


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
