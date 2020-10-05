<?php

function Pagination($needButtons, $path)
{
    $mysqli = Model::Provide_Database();

    // initialize variables to be calculated
    $page;
    $_page1;
    $post_per_page = 5;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    if ($page === 1) {
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


    // render the pagination buttons if needed
    if ($needButtons) {
        // index route
        if ($path && $path === 'index') {
            if ($page > 1) {
                echo "<li class='previous'><a href='index.php?page=1'><< Start</a></li>";
            }

            for ($i = 1; $i <= $page_last; $i++) {
                if ($i === $page - 1 && $page - 1 !== 0) {
                    echo "<li class='previous'><a href='index.php?page={$i}'>Previous</a></li>";
                } else if ($i === $page + 1 && $page + 1 <= $page_last) {
                    echo "<li class='next'><a href='index.php?page={$i}'>Next</a></li>";
                }
            }

            if ($page < $page_last && $page_last !== 1) {
                echo "<li class='next'><a href='index.php?page={$page_last}'>Last >></a></li>";
            }
        }

        // search route
        if ($path && $path === 'search') {
            $search = '';

            if (isset($_POST['search'])) {
                $search = Utility::sanitize($_POST['search']);
            } else {
                $search = Utility::sanitize($_GET['search']);
            }

            if ($page > 1) {
                echo "<li class='previous'><a href='search.php?page=1&search={$search}'><< Start</a></li>";
            }

            for ($i = 1; $i <= $page_last; $i++) {
                if ($i === $page - 1 && $page - 1 !== 0) {
                    echo "<li class='previous'><a href='search.php?page={$i}&search={$search}'>Previous</a></li>";
                } else if ($i === $page + 1 && $page + 1 <= $page_last) {
                    echo "<li class='next'><a href='search.php?page={$i}&search={$search}'>Next</a></li>";
                }
            }

            if ($page < $page_last && $page_last !== 1) {
                echo "<li class='next'><a href='search.php?page={$page_last}&search={$search}'>Last >></a></li>";
            }
        }

        // author route
        if ($path && $path === 'author') {
            if ($page > 1) {
                echo "<li class='previous'><a href='/author.php?page=1&author={$_GET['author']}'><< Start</a></li>";
            }

            for ($i = 1; $i <= $page_last; $i++) {
                if ($i === $page - 1 && $page - 1 !== 0) {
                    echo "<li class='previous'><a href='/author.php?page={$i}&author={$_GET['author']}'>Previous</a></li>";
                } else if ($i === $page + 1 && $page + 1 <= $page_last) {
                    echo "<li class='next'><a href='/author.php?page={$i}&author={$_GET['author']}'>Next</a></li>";
                }
            }

            if ($page < $page_last && $page_last !== 1) {
                echo "<li class='next'><a href='/author.php?page={$page_last}&author={$_GET['author']}}'>Last >></a></li>";
            }
        }

        // category route
        if ($path && $path === 'category') {
            if ($page > 1) {
                echo "<li class='previous'><a href='/category.php?page=1&c_id={$_GET['c_id']}'><< Start</a></li>";
            }

            for ($i = 1; $i <= $page_last; $i++) {
                if ($i === $page - 1 && $page - 1 !== 0) {
                    echo "<li class='previous'><a href='/category.php?page={$i}&c_id={$_GET['c_id']}'>Previous</a></li>";
                } else if ($i === $page + 1 && $page + 1 <= $page_last) {
                    echo "<li class='next'><a href='/category.php?page={$i}&c_id={$_GET['c_id']}'>Next</a></li>";
                }
            }

            if ($page < $page_last && $page_last !== 1) {
                echo "<li class='next'><a href='/category.php?page={$page_last}&c_id={$_GET['c_id']}'>Last >></a></li>";
            }
        }
    }

    // return necessary variables needed by queries
    return [
        'page' => $page,
        'page_last' => $page_last,
        'page_1' => $page_1,
        'post_per_page' => $post_per_page
    ];
}
