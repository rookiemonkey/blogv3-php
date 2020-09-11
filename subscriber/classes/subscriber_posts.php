<?php

require __DIR__ . '/../../subscriber/controllers/post_bulk_options.php';
require __DIR__ . '/../../subscriber/controllers/posts_create.php';
require __DIR__ . '/../../subscriber/controllers/posts_update.php';
require __DIR__ . '/../../subscriber/controllers/posts_delete.php';

class SubscriberPosts
{
    public static function create()
    {
        if (!Utility::isLoggedIn()) {
            return null;
        }
        create_post();
    }

    public static function update()
    {
        if (!Utility::isLoggedIn()) {
            return null;
        }
        update_post();
    }

    public static function delete()
    {
        if (!Utility::isLoggedIn()) {
            return null;
        }
        delete_post();
    }

    public static function options()
    {
        if (!Utility::isLoggedIn()) {
            return null;
        }
        bulk_options_posts();
    }
}
