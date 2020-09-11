<?php

require __DIR__ . '/../../admin/controllers/user_updateCurrent.php';
require __DIR__ . '/../../admin/controllers/user_updateCurrentPassword.php';
require __DIR__ . '/../../admin/controllers/user_updateCurrentAvatar.php';

class SubscriberProfile
{
    public static function update_Current()
    {
        if (!Utility::isLoggedIn()) {
            return null;
        }
        update_current_user();
    }

    public static function update_CurrentPassword()
    {
        if (!Utility::isLoggedIn()) {
            return null;
        }
        update_current_user_password();
    }

    public static function update_CurrentAvatar()
    {
        if (!Utility::isLoggedIn()) {
            return null;
        }
        update_current_user_avatar();
    }
}
