<?php

require __DIR__ . '/../../admin/views/category_renderAll.php';
require __DIR__ . '/../../admin/views/comments_table.php';
require __DIR__ . '/../../admin/views/comments_tableOfPost.php';
require __DIR__ . '/../../admin/views/posts_table.php';
require __DIR__ . '/../../admin/views/users_table.php';

class AdminView
{
    public static function AdminHeader()
    {
        require __DIR__ . '../../views/admin_header.php';
    }

    public static function AdminFooter()
    {
        require __DIR__ . '../../views/admin_footer.php';
    }

    public static function AdminNavigation()
    {
        require __DIR__ . '../../views/admin_navigation.php';
    }

    public static function CategoriesTable()
    {
        AdminUtilities::isAdmin();
        read_categories();
    }

    public static function CategoriesUpdateForm()
    {
        AdminUtilities::isAdmin();
        require __DIR__ . '../../views/update_category.php';
    }

    public static function CommentsPage()
    {
        AdminUtilities::isAdmin();
        require __DIR__ . '/../../admin/views/comments_page.php';
    }

    public static function CommentsTable()
    {
        AdminUtilities::isAdmin();
        read_comments();
    }

    public static function CommentsTableOfPost()
    {
        AdminUtilities::isAdmin();
        read_comments_ofpost();
    }

    public static function PostsPage()
    {
        AdminUtilities::isAdmin();
        require __DIR__ . '/../../admin/views/posts_page.php';
    }

    public static function PostsTable()
    {
        AdminUtilities::isAdmin();
        read_posts();
    }

    public static function Post_addForm()
    {
        AdminUtilities::isAdmin();
        require __DIR__ . '/../../admin/views/post_add.php';
    }

    public static function Post_editForm()
    {
        AdminUtilities::isAdmin();
        require __DIR__ . '/../../admin/views/post_edit.php';
    }

    public static function User_addForm()
    {
        AdminUtilities::isAdmin();
        require __DIR__ . '/../../admin/views/user_add.php';
    }

    public static function User_editForm()
    {
        AdminUtilities::isAdmin();
        require __DIR__ . '/../../admin/views/user_edit.php';
    }

    public static function UsersPage()
    {
        AdminUtilities::isAdmin();
        require __DIR__ . '/../../admin/views/users_page.php';
    }

    public static function UsersTable()
    {
        AdminUtilities::isAdmin();
        read_users();
    }
}
