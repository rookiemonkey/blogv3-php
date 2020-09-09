<?php

function add_like()
{
    $mysqli = Model::Provide_Database();

    $post_id = intval($_GET['p_id']);
    $user_id = intval($_POST['likedby']);
    $post_status = 'published';

    // check if the post is published before adding the comment
    $statement = "SELECT post_id FROM posts WHERE post_id = ? AND post_status = ?";
    $query = $mysqli->prepare($statement);
    $query->bind_param("is", $post_id, $post_status);
    $query->execute();
    $post = $query->get_result();

    if ($post->num_rows === 0) {
        View::alert_Failed("Something went wrong. Unable to add a lik for an unpublished post");
    } else {

        // check if the user already liked the post
        $isLiked = $mysqli->prepare("SELECT post_id FROM likes WHERE like_postid = ? AND like_userid = ?");
        $isLiked->bind_param('ii', $post_id, $user_id);
        $isLiked->execute();
        $results = $isLiked->get_result();
        $isLiked->close();

        // not yet liked
        if ($results->num_rows === 0) {
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
}
