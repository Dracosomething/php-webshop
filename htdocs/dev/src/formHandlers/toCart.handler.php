<?php 
include_once(__DIR__ . "/../database/Database.class.php");
include_once(__DIR__ . "/../helpers/array.helper.php");


try {
    $ArrayHelper = new ArrayHelper();
    $dbconn = new Database(); // connects to the database

    if ($ArrayHelper->anyNotSetOrEmpty($_POST)) { // checks if any of the variables are set
        $errorMsg = "value was invalid";
        header('Location: ../../index.php'); // redirects us back to the index page
        exit(); // stops the rest of the code from running
    }

    $Amount = $_POST['amount'];
    $ProductId = $_POST['productId'];
    $CartId = 1;

    $CartItem = $dbconn->select("'cart_items'", ["*"], ["'product_id' = :ProductId", "'cart_id' = :CartId"], [
        ":ProductId" => $ProductId,
        ":CartId" => $CartId
    ]);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}