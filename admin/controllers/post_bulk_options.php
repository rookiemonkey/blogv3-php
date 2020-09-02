<?php

    /**
     *  allows an admin to do certain task to multiple users
     *  such as delete, or update multiple post to publish or just a draft
     */
    function bulk_options_posts() {
        global $mysqli;
        
        if(isset($_POST['checkBoxArray'])){

            foreach ($_POST['checkBoxArray'] as $post_id) {
                $bulk_options = $_POST['bulkOption'];
                
                switch($bulk_options) {

                    case 'published':
                        $option = 'published';
                        $query = $mysqli->prepare("UPDATE posts set post_status=? WHERE post_id=?");
                        $query->bind_param('si', $option, $post_id);
                        $query->execute();
                        $query->close();
                        break;

                    case 'draft':
                        $option = 'draft';
                        $query = $mysqli->prepare("UPDATE posts set post_status=? WHERE post_id=?");
                        $query->bind_param('si', $option, $post_id);
                        $query->execute();
                        $query->close();
                        break;

                    case 'delete':
                        $stmnt = "DELETE FROM posts WHERE post_id = ?";
                        $query = $mysqli->prepare($stmnt); 
                        $query->bind_param("i", $post_id);
                        $result = $query->execute();
                        break;

                    default:
                        die();
                }
            }
        }
    }

?>