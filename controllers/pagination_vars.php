<?php

    // initialize variables to be calculated
    $page;
    $_page1;
    $post_per_page = 5;

    if(isset($_GET['page'])) { 
        $page = $_GET['page']; 
    } else { 
        $page = 0; 
    }

    if($page === 0 || $page === 1) { 
        $page_1 = 0; 
    } else { 
        $page_1 = ($page * $post_per_page) - $post_per_page; 
    }

    // determine the number of posts rows that is published
    $post_status = 'published';
    $query = $mysqli->prepare("SELECT * FROM posts WHERE post_status = ?");
    $query->bind_param('s', $post_status);
    $query->execute();
    $results = $query->get_result();
    $query->close();
    $total_num = $results->num_rows;

    // determine the number of pages to show and round it down incase it returns
    // a float instead of an integer
    $page_last = intval(ceil($total_num / $post_per_page));

?>