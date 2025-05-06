<?php
@include_once(__DIR__."/../helpers/array.helper.php");
@include_once(__DIR__."/../database/Database.class.php");

echo "rewer";

$message = "";

try {
    $dbconn = new Database();
    $ArrayHelper = new ArrayHelper();

    $errorMsg = "";
    
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        $errorMsg = "vul a.u.b. dit formulier in";
        header('Location: ../../register.php');
        exit();
    }
    
    if ($ArrayHelper->anyNotSetOrEmpty($_POST)) {
        $errorMsg = "one of the values has not been set.";
        header('Location: ../../register.php');
        exit();
    }
    
    $firstName = $_POST["first_name"];
    $infix = $_POST["infix"];
    $lastName = $_POST["last_name"];
    $streetName = $_POST["street_name"];
    $adress = $_POST["house_number"];
    $zipCode = $_POST["zipcode"];
    $additions = $_POST["street_name_addon"];
    $town = $_POST["city"];
    $mail = "'".$_POST["email"]."'";
    $password = $_POST["password"];

    $keys = array_keys($_POST);
    $keys = $ArrayHelper->arrayToString($keys);
    $keys = str_replace("password-contr, ", "", $keys);
    $keys = str_replace(", register", "", $keys);
    $keyArray = $ArrayHelper->stringToArray($keys);
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
    header('Location: ../../index.php');
    exit();
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}