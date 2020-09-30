<?php

require __DIR__ . '/../../subscriber/controllers/comment_delete.php';
require __DIR__ . '/../../subscriber/controllers/comment_unapprove.php';
require __DIR__ . '/../../subscriber/controllers/comment_approve.php';

class SubscriberComments
{
    public static function delete()
    {
        if (!Utility::isLoggedIn()) {
            return null;
        }
        delete_comment();
    }

    public static function approve()
    {
        if (!Utility::isLoggedIn()) {
            return null;
        }
        approve_comment();
    }

    public static function unapprove()
    {
        if (!Utility::isLoggedIn()) {
            return null;
        }
        unapprove_comment();
    }
}
