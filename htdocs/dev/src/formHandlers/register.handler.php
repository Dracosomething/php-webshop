<?php
include_once(__DIR__ . "/../helpers/array.helper.php");
include_once(__DIR__ . "/../database/Database.class.php");
include_once(__DIR__ . "/../helpers/login.helper.php");
include_once(__DIR__ . "/../helpers/error.helper.php");

try {
    $dbconn = new Database(); // conects to the database
    $ArrayHelper = new ArrayHelper(); // creates a new array helper
    $Login = new LoginHelper();
    $ErrorHelper = new ErrorHelper();

    $errorMsg = ""; // the message displayed in the error message thing on the register page

    if ($_SERVER["HTTP_REFERER"] != "http://localhost/dev/register.php") { // makes sure were from the correct page
        $errorMsg = "vul a.u.b. dit formulier in";
        $ErrorHelper->setErrorMsg($errorMsg); // sets the error message 
        header('Location: ../../register.php'); // redirects us back to the register page
        exit(); // stops the rest of the code from running
    }

    if ($_SERVER["REQUEST_METHOD"] != "POST") { // checks if the user hasnt filled the form in
        $errorMsg = "vul a.u.b. dit formulier in";
        $ErrorHelper->setErrorMsg($errorMsg); // sets the error message
        header('Location: ../../register.php'); // redirects us back to the register page
        exit(); // stops the rest of the code from running
    }

    if ($ArrayHelper->anyNotSetOrEmpty($_POST)) { // checks if any of the variables are set
        $errorMsg = "one of the values has not been set.";
        $ErrorHelper->setErrorMsg($errorMsg); // sets the error message
        var_dump($userdata);

        header('Location: ../../register.php'); // redirects us back to the register page
        exit(); // stops the rest of the code from running

    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "Make shure you properly input the email.";
        $ErrorHelper->setErrorMsg($errorMsg); // sets the error message
        header('Location: ../../register.php'); // redirects us back to the register page
        exit(); // stops the rest of the code from running
    }

    // creates all required registry variables
    $firstName = htmlentities($_POST["first_name"]);
    $infix = htmlentities($_POST["infix"]);
    $lastName = htmlentities($_POST["last_name"]);
    $streetName = htmlentities($_POST["street_name"]);
    $adress = htmlentities($_POST["house_number"]);
    $zipCode = htmlentities($_POST["zipcode"]);
    $additions = htmlentities($_POST["street_name_addon"]);
    $town = htmlentities($_POST["city"]);
    $mail = htmlentities($_POST["email"]);
    $password = htmlentities($_POST["password"]);

    $password = password_hash( $password, "argon2id");

    $array = [ // constructs an array for the assigning of the variables
        ":first_name" => $firstName,
        ":infix" => $infix,
        ":last_name" => $lastName,
        ":street_name" => $streetName,
        ":house_number" => $adress,
        ":zipcode" => $zipCode,
        ":street_name_addon" => $additions,
        ":city" => $town,
        ":email" => $mail,
        ":password" => $password
    ];

    // inserts the new users data into the users table in the database
    $dbconn->insert("users", 
    // creates the data with the arguments
    [
        "first_name" => ":first_name",
        "infix" => ":infix",
        "last_name" => ":last_name",
        "street_name" => ":street_name",
        "house_number" => ":house_number",
        "zipcode" => ":zipcode",
        "street_name_addon" => ":street_name_addon",
        "city" => ":city",
        "email" => ":email",
        "password" => ":password"
    ], $array);

    // grabs the userdata from the database
    $userdata = $dbconn->runSql("SELECT * FROM users WHERE email = :mail", [":mail" => $mail]);

    // logs the user into their new account
    $Login->login($userdata);

    header('Location: ../../index.php'); // redirects us to the main page
    exit(); // stops the code
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}