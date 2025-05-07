<?php
include_once(__DIR__ . "/../helpers/login.helper.php");
$login = new LoginHelper();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["id"]) && $_POST["id"] == $login->getUser()["ID"]) {
        $login->logout();
    }
}

header('Location: ../../index.php'); // redirects us to the main page
exit(); // stops the code