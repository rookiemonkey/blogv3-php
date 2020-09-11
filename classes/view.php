<?php

require __DIR__ . '../../views/search_byAuthor_admin.php';
require __DIR__ . '../../views/search_byAuthor_subscriber.php';
require __DIR__ . '../../views/search_byCategory_admin.php';
require __DIR__ . '../../views/search_byCategory_subscriber.php';
require __DIR__ . '../../views/search_byTags_admin.php';
require __DIR__ . '../../views/search_byTags_subscriber.php';
require __DIR__ . '../../views/avatar.php';
require __DIR__ . '../../views/comments.php';
require __DIR__ . '../../views/pagination.php';
require __DIR__ . '../../views/posts_subscriber.php';
require __DIR__ . '../../views/posts_admin.php';
require __DIR__ . '../../views/post_subscriber.php';
require __DIR__ . '../../views/post_admin.php';
require __DIR__ . '../../views/alert_Failed.php';
require __DIR__ . '../../views/alert_Success.php';

class View
{
    public static function MainHeader()
    {
        include "./views/header.php";
    }

    public static function MainFooter()
    {
        include "./views/footer.php";
    }

    public static function search_byAuthor()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            search_author_admin();
        } else {
            search_author_subscriber();
        }
    }

    public static function search_byCategory()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            search_category_admin();
        } else {
            search_category_subscriber();
        }
    }

    public static function search_byTags()
    {
        if (isset($_POST["submit"])) {
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                search_tags_admin();
            } else {
                search_tags_subscriber();
            }
        }
    }

    public static function Post()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            render_post_admin();
        } else {
            render_post_subscriber();
        }
    }

    public static function Posts()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            render_posts_admin();
        } else {
            render_posts_subscriber();
        }
    }

    public static function Pagination($needButtons)
    {
        return Pagination($needButtons);
    }

    public static function Comments()
    {
        if (isset($_GET['p_id'])) {
            render_comments();
        }
    }

    public static function SideBar()
    {
        include __DIR__ . "../../views/sidebar.php";
    }

    public static function Navigation()
    {
        include __DIR__ . "../../views/navigation.php";
    }

    public static function alert_Failed($message)
    {
        render_alert_failed($message);
    }

    public static function alert_Success($message)
    {
        render_alert_success($message);
    }

    public static function Avatar($dependency, $size)
    {
        render_avatar($dependency, $size);
    }
}
