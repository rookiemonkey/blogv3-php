<?php

require __DIR__ . '/../../subscriber/controllers/comment_delete.php';

class SubscriberComments
{
    public static function delete()
    {
        if (!Utility::isLoggedIn()) {
            return null;
        }
        delete_comment();
    }
}
