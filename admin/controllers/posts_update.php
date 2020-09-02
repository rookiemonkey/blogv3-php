<?php

    /**
     * update a post
     */
    function update_post() {
        global $mysqli;

        if(isset($_POST['update_post'])) {
            $post_title = $_POST["post_title"];
            $post_category_id = $_POST['post_category_id'];
            $post_author = $_POST['post_author'];
            $post_status = $_POST['post_status'];
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];

            // prepare statement
            $statement = "UPDATE posts SET post_title = ?, post_category_id = ?, post_author = ?, post_status = ?, post_tags = ?, post_content = ? WHERE post_id = ?";
            $query = $mysqli->prepare($statement);

            // bind parameters
            $query->bind_param("sisssss", $post_title, $post_category_id, $post_author, $post_status, $post_tags, $post_content, $_GET['p_id']);

            // execute the query
            $result = $query->execute();

            // check if query is successfull
            if($result) { 
?>
                <div class='panel panel-success'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Post Updated succesfully. See the post 
                            <a href=/_PHP_blog/post.php?p_id=<?echo $_GET['p_id']; ?>' style='font-weight: bold'>
                                here.
                            <a/>
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

            $query->close();
        }
    }

?>