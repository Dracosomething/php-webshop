<?php
include_once(__DIR__ . "/../helpers/login.helper.php");
$login = new LoginHelper();

if ($_SERVER['REQUEST_METHOD'] == "POST") { // makes shure that were using the right method
    if (isset($_POST["id"]) && $_POST["id"] == $login->getUser()["ID"]) { // checks if the sent id is set and if the sent id is equal to the user id 
        $login->logout(); // logs the user out of their account
    }
}

header('Location: ../../index.php'); // redirects us to the main page
exit(); // stops the code