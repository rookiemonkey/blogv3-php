<?php

require __DIR__ . '/../../subscriber/views/comments_table.php';
require __DIR__ . '/../../subscriber/views/comments_tableOfPost.php';
require __DIR__ . '/../../subscriber/views/posts_table.php';

class SubscriberView
{
    public static function SubscriberHeader()
    {
        require __DIR__ . '/../../subscriber/views/subscriber_header.php';
    }

    public static function SubscriberFooter()
    {
        require __DIR__ . '/../../subscriber/views/subscriber_footer.php';
    }

    public static function SubscriberNavigation()
    {
        require __DIR__ . '/../../subscriber/views/subscriber_navigation.php';
    }

    public static function CategoriesTable()
    {
        read_categories();
    }

    public static function CommentsPage()
    {
        require __DIR__ . '/../../subscriber/views/comments_page.php';
    }

    public static function CommentsTable()
    {
        read_comments();
    }

    public static function CommentsTableOfPost()
    {
        read_comments_ofpost();
    }

    public static function PostsPage()
    {
        require __DIR__ . '/../../subscriber/views/posts_page.php';
    }

    public static function PostsTable()
    {
        read_posts();
    }

    public static function Post_addForm()
    {
        require __DIR__ . '/../../subscriber/views/post_add.php';
    }

    public static function Post_editForm()
    {
        require __DIR__ . '/../../subscriber/views/post_edit.php';
    }
}
