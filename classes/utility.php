<?php

require __DIR__ . '../../utilities/toUpload.php';
require __DIR__ . '../../utilities/toEmailContactRequest.php';
require __DIR__ . '../../utilities/toEmailPasswordReset.php';
require __DIR__ . '../../utilities/toRegisterUser.php';
require __DIR__ . '../../utilities/generate_resetToken.php';
require __DIR__ . '../../utilities/isLoggedIn.php';
require __DIR__ . '../../utilities/isUserExisting.php';
require __DIR__ . '../../utilities/isUserExisting_Reset.php';
require __DIR__ . '../../utilities/getCategoryName.php';

class Utility
{
    public static function isLoggedIn()
    {
        return isLoggedIn();
    }

    public static function isExisting_PasswordReset()
    {
        isUserExisting_Reset();
    }

    public static function toCreate_User($inputs)
    {
        return register_user($inputs);
    }

    public static function toEmail_Contact()
    {
        toEmailContactRequest();
    }

    public static function generate_resetToken()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = generate_resetToken();

            if (!$data) {
                return View::alert_Failed('Failed. Incorrect email provided');
            }

            self::toEmail_ResetPassword($data['email'], $data['token']);
        }
    }

    public static function toEmail_ResetPassword($receiver, $token)
    {
        toEmailPasswordReset($receiver, $token);
    }

    public static function isUserExisting($email, $username)
    {
        return is_user_exisiting($email, $username);
    }

    public static function getCategoryName($category_id)
    {
        getCategoryName($category_id);
    }

    public static function sanitize($string)
    {
        return stripslashes(strip_tags($string));
    }

    public static function toUpload($file, $path)
    {
        return toUpload($file, $path);
    }
}
