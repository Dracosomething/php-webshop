<?php
include_once("./src/database/Database.class.php");
include_once("./src/helpers/price.helper.php");
$PriceHelper = new PriceHelper();

try {
    $dbconn = new Database();

    $productId = $_GET["product_id"] = 1;
    $sql = "SELECT * FROM products WHERE ID = $productId";
    $recset = $dbconn->select($sql)[0];
} catch (PDOException $e) {
    echo ("connection failed: " . $e->getMessage());
}

include_once("template/head.inc.php");
?>
<main>
    <div class="uk-container">
        <div class="uk-flex uk-flex-center uk-flex-wrap uk-flex-wrap-around">
            <div class="uk-flex-column"></div>
            <div class="uk-flex-column">
                <div class="uk-flex-row@xl uk-margin-xlarge-bottom"></div>
                <div class="uk-flex-row@xl">
                    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
                        <div class="uk-card-media-left uk-cover-container">
                            <img src="<?= $recset["image"] ?>" alt="" height="400" width="400">
                            <!-- <canvas height="00" width="500"></canvas> -->
                        </div>
                        <div>
                            <div class="uk-card-body">
                                <div class="uk-flex">
                                    <div class="uk-flex-row">
                                        <h2 class="uk-card-title"><?= $recset["name"] ?></h2>
                                        <p><?= $recset["description"] ?></p>
                                    </div>
                                    <div class="uk-flex-row">
                                        <div class="uk-flex-column"></div>
                                        <div class="uk-flex-column"></div>
                                        <div class="uk-flex-column">
                                            <h4 class="price-text">
                                                &euro;<?= $PriceHelper->parseFloatToPrice($recset["price"]) ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-column-1-1 uk-margin-xlarge-top">
                                <p></p>
                                <div class="uk-container uk-margin-medium-right">
                                    <div class="uk-flex uk-flex-right">
                                        <form class="uk-margin-large" name="cart">
                                            <div uk-form-custom="target: true">
                                                <input name="amount" type="number"
                                                    class="uk-form-width-xsmall uk-margin-xsmall-right" value="1"
                                                    min="1" max="50" required
                                                    oninput="enableToCartIfProductAmountGood()">
                                                <button name="toCart" type="submit"
                                                    class="uk-label uk-button uk-button-primary"><span
                                                        uk-icon="icon: cart"></span> in Winkelwagen</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-flex-row@xl uk-margin-xlarge-top"></div>
            </div>
            <div class="uk-flex-column"></div>
        </div>
    </div>
</main>
<?php
include_once("template/foot.inc.php");