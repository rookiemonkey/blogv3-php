<?php

class SubscriberCondition
{
    public static function Protect_Subscriber()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'subscriber') {
            header("Location: /cms/index");
        }
    }
}
