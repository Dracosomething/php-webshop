<?php
class ErrorHelper
{
    function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE)
            session_start();
    }

    public function setError(array $error): bool
    {
        if (!is_null($error) && !empty($error) && isset($error)) {
            if (!array_search("collor", $error) && !array_search("msg", $error) && !sizeof($error) == 2) {
                return false;
            }

            $_SESSION["error"] = $error;

            return true;
        }

        return false;
    }

    public function setErrorMsg(string $msg): bool
    {
        if (!is_null($msg) && !empty($msg) && isset($msg)) {
            if (is_null($_SESSION["error"]) || empty($_SESSION["error"]) || !isset($_SESSION["error"])) {
                $errorData = [
                    "msg" => "",
                    "collor" => "danger"
                ];
                $_SESSION["error"] = $errorData;
            }
            $_SESSION["error"]["msg"] = $msg;

            return true;
        }

        return false;
    }

    public function setErrorCollor(string $collor): bool
    {
        if (!is_null($collor) && !empty($collor) && isset($collor)) {
            if (is_null($_SESSION["error"]) && empty($_SESSION["error"]) && !isset($_SESSION["error"])) {
                $errorData = [
                    "msg" => "",
                    "collor" => "primary"
                ];
                $_SESSION["error"] = $errorData;
            }
            $_SESSION["error"]["collor"] = $collor;

            return true;
        }

        return false;
    }

    public function getError(): array
    {
        if (!is_null($_SESSION["error"]) && !empty($_SESSION["error"]) && isset($_SESSION["error"])) {
            return $_SESSION["error"];
        }
        return [
            "msg" => "",
            "collor" => "primary"
        ];
    }

    public function getErrorMsg(): string
    {
        if (array_key_exists("error", $_SESSION) && (!is_null($_SESSION["error"]) && !empty($_SESSION["error"]) && isset($_SESSION["error"]))) {
            if (!is_null($_SESSION["error"]["msg"]) && !empty($_SESSION["error"]["msg"]) && isset($_SESSION["error"]["msg"])) {
                return $_SESSION["error"]["msg"];
            }
        }
        return "";
    }

    public function getErrorCollor(): string
    {
        if (array_key_exists("error", $_SESSION) && (!is_null($_SESSION["error"]) && !empty($_SESSION["error"]) && isset($_SESSION["error"]))) {
            if (!is_null($_SESSION["error"]["collor"]) && !empty($_SESSION["error"]["collor"]) && isset($_SESSION["error"]["collor"])) {
                return $_SESSION["error"]["collor"];
            }
        }
        return "";
    }

    public function hasError(): bool {
        return !array_key_exists("error", $_SESSION) && (is_null($_SESSION["error"]) || empty($_SESSION["error"]) || !isset($_SESSION["error"]));
    }
}