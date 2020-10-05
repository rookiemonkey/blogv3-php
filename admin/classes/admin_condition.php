<?php

class AdminCondition
{
    public static function Protect_Admin()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: /index");
        }
    }
}
