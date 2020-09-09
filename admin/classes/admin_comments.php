<?php

require __DIR__ . '/../../admin/controllers/comment_delete.php';
require __DIR__ . '/../../admin/controllers/comment_unapprove.php';
require __DIR__ . '/../../admin/controllers/comment_approve.php';

class AdminComments
{
    public static function delete()
    {
        AdminUtilities::isAdmin();
        delete_comment();
    }

    public static function approve()
    {
        AdminUtilities::isAdmin();
        approve_comment();
    }

    public static function unapprove()
    {
        AdminUtilities::isAdmin();
        unapprove_comment();
    }
}
