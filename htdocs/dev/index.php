<?php
include("./src/database/Database.class.php");
include_once("./src/helpers/price.helper.php");
$PriceHelper = new PriceHelper();

try {
    $dbconn = new Database();
    // set the PDO error mode to exception
    $sql = "SELECT * FROM products";
    $recset = $dbconn->select($sql);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

include_once("template/head.inc.php");
?>
<main>
    <div class="uk-flex uk-flex-center">
        <h1>Welkom bij Stoelen Sleepers.</h1>
    </div>
    <br>
    <div class="uk-flex uk-flex-center">
        <h3>Haal hier de beste materialen voor beginende en profesionele Stoelen Sleepers</h3>
    </div>
    <div class="uk-container">
        <div class="uk-slider-container-offset" uk-slider="autoplay: true; autoplay-interval: 3000; active: first"
            id="slider-products">

            <div class="uk-position-relative uk-visible-toggle uk-dark" tabindex="-1">
                <div class="uk-slider-items uk-child-width-1-2@s uk-child-width-1-3@m uk-grid">
                    <?php for ($i = 0; $i < 5; $i++):
                        $product = $recset[$i]; ?>
                        <!-- begin card 1 -->
                        <div class="uk-link-reset">
                            <div class="uk-card uk-card-default uk-height-1-1">
                                <a href="product.php?product_id=<?= $product['ID'] ?>">
                                    <div class="uk-card-media-top">
                                        <img src=<?= $product['image'] ?> height="300" width="200" alt="">
                                    </div>
                                    <div class="uk-card-body">
                                        <h3 class="uk-card-title"><?= $product['name'] ?></h3>
                                        <p><?= $product['description'] ?></p>
                                    </div>
                                    <div class="">
                                        <div class="uk-flex uk-flex-row">
                                            <div class="uk-flex-column uk-width-1-1"></div>
                                            <div class="uk-flex-column uk-width-1-3">
                                                <h4
                                                    class="price-text uk-position-bottom-right uk-margin-right uk-margin-top">
                                                    &euro;<?= $PriceHelper->parseFloatToPrice($product['price']) ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- einde card 1 -->
                    <?php endfor; ?>
                </div>

                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous
                    uk-slider-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next
                    uk-slider-item="next"></a>

            </div>

            <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>

        </div>
    </div>
</main>
<?php
include_once("template/foot.inc.php");