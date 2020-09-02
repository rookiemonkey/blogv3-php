<?php

    /**
     * create a post
     */
    function create_post() {
        global $mysqli;

        if(isset($_POST['create_post'])) {
            $post_title        = $_POST['post_title'];
            $post_author       = $_POST['post_author'];
            $post_category_id  = $_POST['post_category_id'];
            $post_status       = $_POST['post_status'];
            $post_tags         = $_POST['post_tags'];
            $post_content      = $_POST['post_content'];

            $post_image        = $_FILES['image']['name'];
            $post_image_temp   = $_FILES['image']['tmp_name'];
            $post_comment_count = 0;
            $post_views         = 0;

            $post_date         = date("Y-m-d");

            // upload the image to the server
            define("UPLOAD_LOCATION", $_SERVER['DOCUMENT_ROOT'] . "/_PHP_blog/images/$post_image");
            move_uploaded_file($post_image_temp, UPLOAD_LOCATION);

            // prepare the statement
            $statement = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $query = $mysqli->prepare($statement);

            // bind the parameters
            $query->bind_param("sssssssisi", $post_category_id, $post_title, $post_author, $post_date, $post_image, $post_content, $post_tags, $post_comment_count, $post_status, $post_views);

            // execute the query
            $result = $query->execute();

            // d=id of the newly created post
            $p_id = mysqli_insert_id($mysqli);

            // check if query is successfull
            if($result) { 
?>
                <div class='panel panel-success'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>
                            Succesfully added a post. See the post <a href=/_PHP_blog/post.php?p_id=<?php echo $p_id; ?>' style='font-weight: bold'>here.</a>
                        </h3>
                    </div>
                </div>
<?php
            }
            else { 
?>
                <div class='panel panel-danger'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Something went wrong. Please try again later</h3>
                    </div>
                </div>
<?php
            }

            // close the connection to the database
            $query->close();
        }
    }

?>