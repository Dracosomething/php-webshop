<?php 
include_once(__DIR__ . "/../database/Database.class.php");
include_once(__DIR__ . "/../helpers/array.helper.php");
include_once(__DIR__ . "/../helpers/cart.helper.php");

echo "hello world";

try {
    $ArrayHelper = new ArrayHelper();
    $dbconn = new Database(); // connects to the database
    $CartHelper = new CartHelper($dbconn);

    if ($ArrayHelper->anyNotSetOrEmpty($_POST)) { // checks if any of the variables are set
        $errorMsg = "value was invalid";
        header('Location: ../../index.php'); // redirects us back to the index page
        exit(); // stops the rest of the code from running
    }

    $Amount = $_POST['amount'];
    $ProductID = $_POST['productId'];
    $OrderID = $CartHelper->getCartID();

    $CartItem = $dbconn->select("'cart_items'", ["*"], ["'product_id' = :ProductId", "'order_id' = :OrderId"], [
        ":ProductId" => $ProductId,
        ":OrderId" => $OrderID
    ]);

    if (empty($CartItem) || is_null($CartItem)) 
    {
        $dbconn->insert("'cart_items'", 
            [
            "order_id" => ":OrderId",
            "product_id" => ":ProductId",
            "amount" => ":Amount"
        ], 
            [
            ":ProductId"=> $ProductID,
            ":OrderId"=> $OrderID,
            ":Amount" => $Amount
        ]);
    } else {
        $dbconn->runSql("UPDATE `cart_items` SET `cart_items`.`amount` = :Amount", [
            ':Amount' => $CartItem['amount'] + 1
         ]);
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}