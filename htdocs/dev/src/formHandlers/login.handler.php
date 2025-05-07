<?php
include_once(__DIR__ . "/../helpers/login.helper.php");
include_once(__DIR__ . "/../database/Database.class.php");
include_once(__DIR__ . "/../helpers/array.helper.php");

try {
    $dbconn = new Database(); // conects to the database
    $ArrayHelper = new ArrayHelper(); // creates a new array helper
    $Login = new LoginHelper();

    $errorMsg = ""; // the message displayed in the error message thing on the register page

    if ($_SERVER["REQUEST_METHOD"] != "POST") { // checks if the user hasnt filled the form in
        $errorMsg = "vul a.u.b. dit formulier in";
        header('Location: ../../register.php'); // redirects us back to the register page
        exit(); // stops the rest of the code from running
    }

    if ($ArrayHelper->anyNotSetOrEmpty($_POST)) { // checks if any of the variables are set
        $errorMsg = "one of the values has not been set.";
        header('Location: ../../register.php'); // redirects us back to the register page
        exit(); // stops the rest of the code from running
    }

    $password = "'" . $_POST["password"] . "'";
    $email = "'" . $_POST["email"] . "'";

    $mail = str_replace("'", "", $email);
    $password = str_replace("'", "", $password);

    $userdata = $dbconn->select("users", ["*"], ["email = :mail", "password = :pass"], [":mail" => $mail, ":pass" => $password]);

    $Login->login($userdata);

    header('Location: ../../index.php'); // redirects us to the main page
    exit(); // stops the code
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}