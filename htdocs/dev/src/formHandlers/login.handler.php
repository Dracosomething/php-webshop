<?php
include_once(__DIR__ . "/../helpers/login.helper.php");
include_once(__DIR__ . "/../database/Database.class.php");
include_once(__DIR__ . "/../helpers/array.helper.php");

try {
    $dbconn = new Database(); // conects to the database
    $ArrayHelper = new ArrayHelper(); // creates a new array helper
    $Login = new LoginHelper(); // creates a login helper

    $errorMsg = ""; // the message displayed in the error message thing on the register page

    if ($_SERVER["REQUEST_METHOD"] != "POST") { // checks if the user hasnt filled the form in
        $errorMsg = "Something went wrong with login in"; // assigns the error message
        header('Location: ../../register.php'); // redirects us back to the register page
        exit(); // stops the rest of the code from running
    }

    if ($ArrayHelper->anyNotSetOrEmpty($_POST)) { // checks if any of the variables are set
        $errorMsg = "You are currently not logged in."; // assigns the error message
        header('Location: ../../register.php'); // redirects us back to the register page
        exit(); // stops the rest of the code from running
    }

    $password = $_POST["password"]; // grabs the password
    $email = $_POST["email"]; // grabs the email

    // selects the data needed to log into an account
    $userdata = $dbconn->select("users", ["*"], [ // makes shure the email and password will be the same
        "email = :mail", 
        "password = :pass"
    ], 
    [ // binds the parameters to the correct variables
        ":mail" => $email, 
        ":pass" => $password
    ]);

    $Login->login($userdata); // logs the user in to their account

    header('Location: ../../index.php'); // redirects us to the main page
    exit(); // stops the code
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}