<?php
include_once("src/database/Database.class.php");
include_once("src/helpers/cart.helper.php");
include_once("src/helpers/description.helper.php");
include_once("src/helpers/login.helper.php");

try {
    $dbconn = new Database();
    $DescriptionHelper = new DescriptionHelper();
    $CartHelper = new Carthelper($dbconn);
    $login = new LoginHelper();

    // echo $CartHelper->doesCartExist() ? "true" : "false";

    if ($CartHelper->doesCartExist()) {
        $userID = $login->getUser()["ID"];

        $dbconn->insert(
            "carts",
            [
                "customer_id" => $userID
            ]
        );
    }

    $cart = $CartHelper->getFullCart();
    $cartData = $CartHelper->getCart();
    $cartID = $CartHelper->getCartID();
    $cartItems = $CartHelper->getCartItems();
    $cartSize = $CartHelper->getCartSize();
    $cartPrice = $CartHelper->getCartPrise();
} catch (PDOException $error) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

include_once("template/head.inc.php");
?>
<main class="uk-container">
    <div class=" uk-margin-bottom  uk-margin-top">
        <div class="uk-flex uk-flex-wrap uk-flex-wrap-around">
            <!-- start first card -->
            <div class="uk-flex-column uk-width-1-2 uk-margin-xlarge-right uk-margin-remove-right">
                <?php foreach ($cartItems as $item): ?>
                    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-4 uk-margin" uk-grid>
                        <div class="uk-card-media-left uk-cover-container">
                            <img src=<?= $item["product"]["image"] ?> alt="">
                        </div>
                        <div class="uk-width-1-3">
                            <div class="uk-card-body">
                                <h3 class="uk-card-title"><?= $item["product"]["name"] ?></h3>
                                <p><?= $DescriptionHelper->writeShortDescription($item["product"]["description"]) ?></p>
                            </div>
                        </div>
                        <div class="uk-width-1-4 uk-flex uk-flex-middle uk-flex-center">
                            <div class="uk-width-1-3 uk-flex uk-flex-column uk-flex-middle">
                                <form action="" name="amount" method="post">
                                    <input type="hidden" name="id" value=<?= $item["ID"] ?>>
                                    <input class="uk-input" name="amount" type="number" value=<?= $item["amount"] ?>>
                                </form>
                            </div>
                            <div class="uk-width-1-4">
                                <form action="src/formHandlers/removeCart.handler.php" name="delete" method="post">
                                    <div class="uk-inline">
                                        <input type="hidden" name="id" value=<?= $item["ID"] ?>>
                                        <a class="uk-form-icon uk-form-danger" uk-icon="icon: trash"></a>
                                        <input class="uk-input uk-form-blank uk-form-danger" type="button"
                                            aria-label="Clickable icon">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- end first card -->
            </div>
            <div class="uk-flex-column uk-margin-xlarge-left uk-width-1-3 uk-align-right">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                        <h3>
                            Overzicht
                        </h3>
                    </div>
                    <div class="uk-card-body">
                        <div class="uk-margin-remove">
                            <div class="uk-width-1-1">
                                <div class="uk-align-left">
                                    <p class="uk-margin-remove">Artikelen (<?= $cartSize ?>)</p>
                                </div>
                                <div class="uk-align-right">
                                    <p class="uk-margin-remove">&euro;<?= $cartPrice ?></p>
                                </div>
                            </div>
                            <div class="uk-width-1-1">
                                <div class="uk-align-left">
                                    <p class="uk-margin-remove">Verzendkosten</p>
                                </div>
                                <div class="uk-align-right">
                                    <p class="uk-margin-remove">&euro;0,-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uk-card-footer">
                        <div class="uk-width-1-1">
                            <div class="uk-align-left uk-text-bolder">
                                <p>Te betalen</p>
                            </div>
                            <div class="uk-align-right uk-text-bolder">
                                <p>&euro;<?= $cartPrice ?></p>
                            </div>
                        </div>
                        <div class="uk-text-center">
                            <form method="post" name="order">
                                <input type="hidden" value=<?= $login->getUser()["ID"] ?> name="user_id">
                                <input type="hidden" value=<?= $cartID ?> name="cart_id">
                                <input type="submit" value="Doorgaan naar besteling"
                                    class="uk-button uk-button-primary uk-align-right">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once("template/foot.inc.php");