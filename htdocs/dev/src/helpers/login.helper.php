<?php


class LoginHelper
{
    function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE)
            session_start();
    }

    public function login(mixed $userdata): bool
    {
        if (!is_null($userdata) && !empty($userdata)) {

            $_SESSION["user"] = $userdata;
            return true;
        }
        return false;
    }

    public function logout(): void
    {
        if ($this->isLoggedIn()) {
            unset($_SESSION["user"]);
        }
    }

    public function isLoggedIn(): bool
    {
        if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
            $userdata = $_SESSION["user"][0];
            if (is_array($userdata) && array_key_exists("ID", $userdata)) {
                return intval($userdata["ID"]) > 0;
            } else if (is_object($userdata) && property_exists($userdata,  "ID")) {
                return intval($userdata->ID) > 0;
            }
        }
        return false;
    }

    public function getUser(): array {
        if ($this->isLoggedIn()) {
            return $_SESSION["user"][0];
        }
        return [];
    }
}