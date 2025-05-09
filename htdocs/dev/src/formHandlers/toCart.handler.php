<?php 
include_once(__DIR__ . "/../database/Database.class.php");
include_once(__DIR__ . "/../helpers/array.helper.php");
include_once(__DIR__ . "/../helpers/cart.helper.php");
include_once(__DIR__ . "/../helpers/login.helper.php");

try {
    $ArrayHelper = new ArrayHelper();
    $dbconn = new Database(); // connects to the database
    $CartHelper = new CartHelper($dbconn);
    $login = new LoginHelper();


    if ($ArrayHelper->anyNotSetOrEmpty($_POST)) { // checks if any of the variables are set
        $errorMsg = "value was invalid";
        header('Location: ../../index.php'); // redirects us back to the index page
        exit(); // stops the rest of the code from running
    }

    $Amount = $_POST['amount'];
    $ProductID = $_POST['productId'];
    $OrderID = $CartHelper->getCartID();

    if ($CartHelper->doesCartExist()) {
        $userID = $login->getUser()["ID"];

        $dbconn->insert(
            "carts",
            [
                "customer_id" => $userID
            ]
        );
    }

    $CartItem = $dbconn->select("cart_items", ["*"], ["product_id = :ProductId", "order_id = :OrderId"], [
        ":ProductId" => $ProductID,
        ":OrderId" => $OrderID
    ]);

    if (empty($CartItem) || is_null($CartItem)) 
    {
        $dbconn->insert("cart_items", 
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
            ':Amount' => $CartItem['amount'] + $Amount
         ]);
    }

    header("Location: ../../product.php?product_id=$ProductID");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}