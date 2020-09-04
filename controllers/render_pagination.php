<?php
    
    // should be converted to a function because of
    // variable scoping issues

    if($page > 1) {
        echo "<li class='previous'><a href='index.php?page=1'><< Start</a></li>";
    }

    for ($i = 1; $i <= $page_last; $i++) {

        if($i === $page - 1 && $page - 1 !== 0) {
            echo "<li class='previous'><a href='index.php?page={$i}'>Previous</a></li>";
        }

        else if ($i === $page + 1 && $page + 1 <= $page_last) {
            echo "<li class='next'><a href='index.php?page={$i}'>Next</a></li>";
        }

    }

    if($page < $page_last && $page_last !== 1) {
        echo "<li class='next'><a href='index.php?page={$page_last}'>Last >></a></li>";
    }
    
?>