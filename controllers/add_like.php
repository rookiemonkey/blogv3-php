<?php

    function add_like() {
        $mysqli = Model::Provide_Database();
        
        $post_id = intval($_GET['p_id']);
        $user_id = intval($_POST['likedby']);

        // check if the user already liked the post
        $isLiked = $mysqli->prepare("SELECT * FROM likes WHERE like_postid = ? AND like_userid = ?");
        $isLiked->bind_param('ii', $post_id, $user_id);
        $isLiked->execute();
        $results = $isLiked->get_result();
        $isLiked->close();

        // not yet liked
        if($results->num_rows === 0) {
            // increment the post_likes col
            $add_like = $mysqli->prepare("UPDATE posts SET post_likes = post_likes + 1 WHERE post_id = ?");
            $add_like->bind_param('i', $post_id);
            $add_like->execute();
            $add_like->close();

            // save the like on likes table
            $save_like = $mysqli->prepare("INSERT INTO likes (like_postid, like_userid) VALUES (?,?)");
            $save_like->bind_param('ii', $post_id, $user_id);
            $save_like->execute();
            $save_like->close();
        }

        // already liked, remove like
        else {
            // decrement the post_likes col
            $add_like = $mysqli->prepare("UPDATE posts SET post_likes = post_likes - 1 WHERE post_id = ?");
            $add_like->bind_param('i', $post_id);
            $add_like->execute();
            $add_like->close();

            // purge the like on likes table
            $save_like = $mysqli->prepare("DELETE FROM likes WHERE like_postid = ? AND like_userid = ?");
            $save_like->bind_param('ii', $post_id, $user_id);
            $save_like->execute();
            $save_like->close();
        }
    }

?>