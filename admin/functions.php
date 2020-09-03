<?php

    // utilities
    include './utilities/isAdmin.php';
    include './utilities/setOnlineUsers.php';
    include './utilities/renderAlert_success.php';
    include './utilities/renderAlert_failed.php';
    include './utilities/renderAlert_tablenoresult.php';
    include './utilities/renderForm_updateCategory.php';











    // categories
    include './controllers/category_create.php';
    include './controllers/category_renderAll.php';
    include './controllers/category_update.php';
    include './controllers/category_delete.php';

    class Categories {
        public static function create() { isAdmin(); create_category(); }
        public static function read()   { isAdmin(); read_categories(); }
        public static function update() { isAdmin(); update_category(); }
        public static function delete() { isAdmin(); delete_category(); }
    }










    // posts
    include './controllers/post_bulk_options.php';  
    include './controllers/posts_create.php';   
    include './controllers/posts_renderAll.php';
    include './controllers/posts_update.php';
    include './controllers/posts_delete.php';

    class Posts {
        public static function create()     { create_post(); }
        public static function read()       { isAdmin(); read_posts(); }
        public static function update()     { isAdmin(); update_post(); }
        public static function delete()     { isAdmin(); delete_post(); }
    }










    // comments
    include './controllers/comments_renderAll.php';
    include './controllers/comments_renderAllOfPost.php';
    include './controllers/comment_delete.php';
    include './controllers/comment_unapprove.php';
    include './controllers/comment_approve.php';

    class Comments {
        public static function read()           { isAdmin(); read_comments(); }
        public static function read_ofPost()    { isAdmin(); read_comments_ofpost(); }
        public static function delete()         { isAdmin(); delete_comment(); }
        public static function approve()        { isAdmin(); approve_comment(); }
        public static function unapprove()      { isAdmin(); unapprove_comment(); }
    }













    // users
    include './controllers/users_renderAll.php';
    include './controllers/user_create.php';
    include './controllers/user_delete.php';
    include './controllers/user_update.php';
    include './controllers/user_updateCurrent.php';
    include './controllers/user_updateToAdmin.php';
    include './controllers/user_updateToSubscriber.php';

    class Users {
        public static function read()           { isAdmin(); read_users(); }
        public static function create()         { isAdmin(); create_user(); }
        public static function delete()         { isAdmin(); delete_user(); }
        public static function update()         { isAdmin(); update_user(); }
        public static function updateCurrent()  { update_current_user(); }
        public static function update_toAdmin() { isAdmin(); update_user_toAdmin(); }
        public static function update_toSubscriber() { 
            isAdmin(); update_user_toSubscriber(); 
        }
    }

?>