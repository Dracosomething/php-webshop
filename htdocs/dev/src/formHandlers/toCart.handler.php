<?php
include_once(__DIR__ . "/../database/Database.class.php");
include_once(__DIR__ . "/../helpers/array.helper.php");
include_once(__DIR__ . "/../helpers/cart.helper.php");
include_once(__DIR__ . "/../helpers/login.helper.php");

try {
    $dbconn = new Database(); // connects to the database
    $ArrayHelper = new ArrayHelper();
    $CartHelper = new CartHelper($dbconn);
    $login = new LoginHelper();

    if (!$login->isLoggedIn()) {
        header("Location: ../../login.php");
        exit();
    }

    if ($ArrayHelper->anyNotSetOrEmpty($_POST)) { // checks if any of the variables are set
        $errorMsg = "value was invalid";
        header('Location: ../../index.php'); // redirects us back to the index page
        exit(); // stops the rest of the code from running
    }

    $Amount = $_POST['amount'];
    $ProductID = $_POST['productId'];
    $OrderID = $CartHelper->getCartID();

    if (!$CartHelper->doesCartExist()) {
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
    ])[0];

    if (empty($CartItem) || is_null($CartItem)) {
        $dbconn->insert(
            "cart_items",
            [
                "order_id" => ":OrderId",
                "product_id" => ":ProductId",
                "amount" => ":Amount"
            ],
            [
                ":ProductId" => $ProductID,
                ":OrderId" => $OrderID,
                ":Amount" => $Amount
            ]
        );
    } else {
        $id = $CartItem["ID"];

        $newAmount = $CartItem['amount'] + $Amount;

        if ($newAmount > 50) {
            $newAmount = 50;
        } elseif ($newAmount <= 0) {
            $newAmount = 1;
        }

        $dbconn->update("cart_items", ["amount = :Amount"], ["ID = :id"], [
            ":Amount" => $newAmount,
            ":id" => $id
        ]);
    }

    header("Location: ../../product.php?product_id=$ProductID");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}