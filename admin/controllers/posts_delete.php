<?php

    function delete_post() {
        $mysqli = AdminModel::Provide_Database();

        if(isset($_GET['delete'])) {
            $post_id = $_GET['delete'];
            $post_id = mysqli_real_escape_string($mysqli, $post_id);
            $stmnt = "DELETE FROM posts WHERE post_id = ?";
            $query = $mysqli->prepare($stmnt); 
            $query->bind_param("s", $post_id);
            $result = $query->execute();
            $query->close();

            // check if query is successfull
            if($result) { 
                // refresh the page
                header("Location: /cms/admin/posts.php");
            }
            else { 
                AdminUtilities::alert_Failed();
            }
        }
    }
?>