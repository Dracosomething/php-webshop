<?php
include_once("src/database/Database.class.php");
include_once("src/helpers/cart.helper.php");
include_once("src/helpers/price.helper.php");
include_once("src/helpers/login.helper.php");


try {
    $dbconn = new Database();
    $CartHelper = new CartHelper($dbconn);
    $PriceHelper = new PriceHelper();
    $login = new LoginHelper();

    $cartID = $CartHelper->getCartID();
    $cartItems = $CartHelper->getCartItems();
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

    // foreach ($cartItems as $cartItem) {
    //     $dbconn->insert("order_items", data: 
    // [
    //     "order_id" => ":order_id"
    // ],
    // [
    //     ":order_id" => $orderID[0]["ID"]
    // ]);
    // }

    // $dbconn->remove("cart_items", [], []);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

echo '<pre>';
var_dump($user);
var_dump($cartItems);
var_dump($orderID);

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
                            echo '<p>&euro;' . $CartHelper->getCartPrise() . '</p>'
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