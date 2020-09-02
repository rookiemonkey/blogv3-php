<?php

    /**
     * delete a post
     */
    function delete_post() {
        global $mysqli;

        if(isset($_GET['delete'])) {
            $post_id = $_GET['delete'];
            $post_id = mysqli_real_escape_string($mysqli, $post_id);
            $stmnt = "DELETE FROM posts WHERE post_id = ?";
            $query = $mysqli->prepare($stmnt); 
            $query->bind_param("s", $post_id);
            $result = $query->execute();

            // check if query is successfull
            if($result) { 
                // refresh the page
                header("Location: posts.php");
            }
            else { 
?>
                <div class='panel panel-danger'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Something went wrong. Please try again later</h3>
                    </div>
                </div>
<?php
                die(); 
            }

            $query->close();
        }
    }

?>