<?php


class LoginHelper
{
    function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE)
            session_start();
    }

    /**
     * logs a user into their account
     * @param array $userdata the data of the user
     * @return bool if the user got loggedd in
     */
    public function login(array $userdata): bool
    {
        if (!is_null($userdata) && !empty($userdata)) { // checks if the data is set and is not null
            $_SESSION["user"] = $userdata; // adds the data to the current session
            return true;
        }
        return false;
    }

    /**
     * logs a user out of their account
     * @return bool if the user got logged out of their account
     */
    public function logout(): bool
    {
        if ($this->isLoggedIn()) { // checks if were logged in
            unset($_SESSION["user"]); // unsets the user data
            return true;
        }
        return false;
    }

    /**
     * checks if a user is logged in
     * @return bool if the user is logged in
     */
    public function isLoggedIn(): bool
    {
        if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) { // checks if the user data in the session is set
            $userdata = $_SESSION["user"][0]; // grabs the first key, needed becouse we are storing an array as the user data
            if (is_array($userdata) && array_key_exists("ID", $userdata)) { // checks if this is an array
                return intval($userdata["ID"]) > 0; // converts the id to an int and checks if its above 0
            }
        }
        return false;
    }

    /**
     * gets the user data
     * @return array the user data as an array
     */
    public function getUser(): array {
        if ($this->isLoggedIn()) { // checks if the user is logged in
            return $_SESSION["user"][0]; // grabs the user data
        }
        return [];
    }
}