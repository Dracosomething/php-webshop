<?php
include_once(__DIR__ . "/../helpers/array.helper.php");
include_once(__DIR__ . "/../database/Database.class.php");

try {
    $dbconn = new Database(); // conects to the database
    $ArrayHelper = new ArrayHelper(); // creates a new array helper

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
    $mail = "'" . $_POST["email"] . "'";
    $password = $_POST["password"];

    $keys = array_keys($_POST); // gets all keys in the array
    $keys = $ArrayHelper->arrayToString($keys); // converts the keys array to a string
    $keys = str_replace("password-contr, ", "", $keys); // removes password-contrl from the string
    $keys = str_replace(", register", "", $keys); // removes register from the string
    $keyArray = $ArrayHelper->stringToArray($keys); // converts the string back to an array

    // inserts the new users data into the users table in the database
    $dbconn->insert("users", [
        $firstName,
        $infix,
        $lastName,
        $streetName,
        $adress,
        $zipCode,
        $additions,
        $town,
        $mail,
        $password
    ], $keyArray);
    
    header('Location: ../../index.php'); // redirects us to the main page
    exit(); // stops the code
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}