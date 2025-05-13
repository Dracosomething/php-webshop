<?php
include_once(__DIR__ . "/../database/Database.class.php");
include_once(__DIR__ . "/../helpers/array.helper.php");
include_once(__DIR__ . "/../helpers/cart.helper.php");
include_once(__DIR__ . "/../helpers/login.helper.php");

try {
    $dbconn = new Database(); // connects to the database
    $ArrayHelper = new ArrayHelper();

    if ($ArrayHelper->anyNotSetOrEmpty($_POST)) { // checks if any of the variables are set
        $errorMsg = "value was invalid";
        header('Location: ../../index.php'); // redirects us back to the index page
        exit(); // stops the rest of the code from running
    }

    $ID = $_POST["id"];

    $cartItem = $dbconn->remove("cart_items", ["ID = :ID"], [
        ":ID" => $ID
    ]);

    header("Location: ../../cart.php");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}