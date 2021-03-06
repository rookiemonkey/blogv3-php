<?php

require __DIR__ . '/../../admin/controllers/user_create.php';
require __DIR__ . '/../../admin/controllers/user_delete.php';
require __DIR__ . '/../../admin/controllers/user_update.php';
require __DIR__ . '/../../admin/controllers/user_updateCurrent.php';
require __DIR__ . '/../../admin/controllers/user_updateCurrentPassword.php';
require __DIR__ . '/../../admin/controllers/user_updateCurrentAvatar.php';
require __DIR__ . '/../../admin/controllers/user_updateToAdmin.php';
require __DIR__ . '/../../admin/controllers/user_updateToSubscriber.php';

class AdminUsers
{
    public static function create()
    {
        AdminUtilities::isAdmin();
        create_user();
    }

    public static function delete()
    {
        AdminUtilities::isAdmin();
        delete_user();
    }

    public static function update()
    {
        AdminUtilities::isAdmin();
        update_user();
    }

    public static function update_Current()
    {
        update_current_user();
    }

    public static function update_CurrentPassword()
    {
        update_current_user_password();
    }

    public static function update_CurrentAvatar()
    {
        update_current_user_avatar();
    }

    public static function update_ToAdmin()
    {
        AdminUtilities::isAdmin();
        update_user_toAdmin();
    }

    public static function update_ToSubscriber()
    {
        AdminUtilities::isAdmin();
        update_user_toSubscriber();
    }
}
