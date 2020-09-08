<?php

    require __DIR__ . '/../../admin/controllers/post_bulk_options.php';  
    require __DIR__ . '/../../admin/controllers/posts_create.php';   
    require __DIR__ . '/../../admin/controllers/posts_update.php';
    require __DIR__ . '/../../admin/controllers/posts_delete.php';

    class AdminPosts {
        public static function create() { 
            AdminUtilities::isAdmin();
            create_post(); 
        }

        public static function update() { 
            AdminUtilities::isAdmin();
            update_post(); 
        }

        public static function delete() { 
            AdminUtilities::isAdmin();
            delete_post(); 
        }

        public static function options() { 
            AdminUtilities::isAdmin();
            bulk_options_posts();
        }
    }
?>  