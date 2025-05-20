<?php
include_once("src/database/Database.class.php");
include_once("src/helpers/cart.helper.php");
include_once("src/helpers/price.helper.php");
include_once("src/helpers/login.helper.php");
include_once("src/helpers/error.helper.php");
$ErrorHelper = new ErrorHelper();

if ($_SERVER["HTTP_REFERER"] != "http://localhost/dev/payment.php" || $_SERVER["REQUEST_METHOD"] != "POST") { // checks if the user hasnt filled the form in
    $errorMsg = "Something went wrong with refering to confirm"; // assigns the error message
    $ErrorHelper->setErrorMsg($errorMsg); // sets the error message
    header('Location: payment.php'); // redirects us back to the register page
    exit(); // stops the rest of the code from running
}

if ($_POST["bank"] == 0) {
    $errorMsg = "You have to select a bank."; // assigns the error message
    $ErrorHelper->setErrorMsg($errorMsg); // sets the error message
    header('Location: payment.php'); // redirects us back to the register page
    exit(); // stops the rest of the code from running
}

try {
    $dbconn = new Database();
    $CartHelper = new CartHelper($dbconn);
    $PriceHelper = new PriceHelper();
    $login = new LoginHelper();

    $cartID = $CartHelper->getCartID();
    $cartItems = $CartHelper->getCartItems();
    $price = $CartHelper->getCartPrise();
    $user = $login->getUser();
    $currentDate = date("Y-m-d");

    $dbconn->insert("orders", [
        "customer_id" => ":customer_id",
        "order_date" => ":order_date",
        "cart_id" => ":cart_id"
    ], [
        ":customer_id" => $user["ID"],
        ":order_date" => $currentDate,
        ":cart_id" => $cartID
    ]);

    $orderID = $dbconn->select("orders", ["ID"], [
        "customer_id = :customer_id",
        "cart_id = :cart_id"
    ], [
        ":customer_id" => $user["ID"],
        ":cart_id" => $cartID
    ]);

    foreach ($cartItems as $cartItem) {
        $id = $orderID[0]["ID"];
        $amount = $cartItem["amount"];
        $item_id = $cartItem["ID"];
        $dbconn->insert(
            "order_items",
            [
                "order_id" => ":order_id",
                "product_id" => ":productId",
                "amount" => ":amount"
            ],
            [
                ":order_id" => $id,
                ":productId" => $item_id,
                ":amount" => $amount
            ]
        );
        $dbconn->remove("cart_items", ["ID = :id"], [":id" => $item_id]);
    }

    $dbconn->remove("carts", ["ID = :id"], [":id" => $cartID]);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

include_once("template/head.inc.php");
?>

<main class="uk-container">
    <div class="uk-flex uk-flex-wrap uk-flex-wrap-around">
        <div class="uk-width-1-1 uk-margin-top">
            <div class="uk-card uk-card-default">
                <h3 class="uk-card-title uk-text-center">Bedankt voor uw bestelling</h3>
                <div class="uk-card-body">
                    <div class="uk-clearfix">
                        <div class="uk-float-left">
                            <p>U krijgt uw bestelling binnenkort binnen.</p>
                        </div>
                        <div class="uk-float-right">
                            <div class="uk-card uk-card-default uk-card-body">
                                bestelling nummer:<br>
                                <?= $cartID ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-width-1-1 uk-margin-top uk-margin-bottom">
            <div class="uk-card uk-card-default">
                <div class="uk-card-header">
                    <h3>
                        Factuur
                    </h3>
                </div>
                <div class="uk-card-body">
                    <div class="">
                        <div class="uk-width-1-1">
                            <div class="uk-align-left">
                                <p class="uk-text-bolder">Artikelen:</p>
                                <?php
                                foreach ($cartItems as $x) {
                                    if ($x['product']['categorie_id'] == 1) {
                                        echo '<p>' . $x['product']['name'] . ' (' . $x['amount'] . ')' . '<p>';
                                    } elseif ($x['product']['categorie_id'] == 2) {
                                        echo '<p>' . $x['product']['name'] . ' (' . $x['amount'] . ' uur)' . '<p>';
                                    }
                                }
                                ?>
                                <br>
                                <p class="uk-text-bolder">Verzendkosten</p>
                            </div>
                            <div class="uk-align-right">
                                <br>
                                <?php
                                foreach ($cartItems as $x) {
                                    $result = $x['product']['price'] * $x['amount'];
                                    echo '<p>&euro;' . $PriceHelper->parseFloatToPrice($result) . '</p>';
                                }
                                ?>
                                <br>
                                <p class="uk-text-bolder">&euro;0,-</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-card-footer">
                    <div class="uk-width-1-1">
                        <div class="uk-align-left uk-text-bolder">
                            <p>Totaal</p>
                        </div>
                        <div class="uk-align-right uk-text-bolder">
                            <?php
                            echo '<p>&euro;' . $price . '</p>'
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once("template/foot.inc.php");