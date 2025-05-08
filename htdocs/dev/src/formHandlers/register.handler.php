<?php
include_once(__DIR__ . "/../helpers/array.helper.php");
include_once(__DIR__ . "/../database/Database.class.php");
include_once(__DIR__ . "/../helpers/login.helper.php");

try {
    $dbconn = new Database(); // connects to the database
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

    // creates all required registry variables
    $firstName = $_POST["first_name"];
    $infix = $_POST["infix"];
    $lastName = $_POST["last_name"];
    $streetName = $_POST["street_name"];
    $adress = $_POST["house_number"];
    $zipCode = $_POST["zipcode"];
    $additions = $_POST["street_name_addon"];
    $town = $_POST["city"];
    $mail = $_POST["email"];
    $password = $_POST["password"];

    $array = [
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
    $dbconn->insert("users", [
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
    
    $mail = str_replace("'", "", $mail);
    $password = str_replace("'", "", $password);

    $userdata = $dbconn->runSql("SELECT * FROM users WHERE email = :mail AND password = :pass", [":mail" => $mail, ":pass" => $password]);

    $Login->login($userdata);

    header('Location: ../../index.php'); // redirects us to the main page
    exit(); // stops the code
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}