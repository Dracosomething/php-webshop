<?php
include_once("./src/database/Database.class.php");
include_once("./src/helpers/price.helper.php");
include_once("./src/helpers/description.helper.php");
include_once("./src/helpers/array.helper.php");

try {
    $dbconn = new Database();
    $PriceHelper = new PriceHelper();
    $DescriptionHelper = new DescriptionHelper();
    $ArrayHelper = new ArrayHelper();

    $sql = "SELECT * FROM products";
    $categories = $dbconn->select("categories", ["*"]);

    // for searching products and categories
    if ($_SERVER['REQUEST_METHOD'] == "GET") { // checks if there is a request method and if it is the get method
        if (isset($_GET["search"])) { // checks if the search info is set
            $recset = $dbconn->select("products", ["*"], ['`name` LIKE "%' . $_GET["search"] . '%"']); // gets every product matching the input search stuff from the database
        }
        if (isset($_GET["category"])) { // checks if category is set
            // empty variables as we need to access them on this level
            $conditions = "";
            $params = [];
            foreach ($_GET["category"] as $id) {
                $conditions .= "categorie_id = :ID_$id"; // adds an argument to the conditions
                $params[":ID_$id"] = $id; // sets set argument
                if (next($_GET["category"]) != null) { // checks if there is a next id
                    $conditions .= " OR "; // adds or for multiple conditions in the sql query
                }
            }
            $recset = $dbconn->select("products", ["*"], [$conditions], $params);
            $categoryIdArr = $_GET["category"]; // to make life easier so i dont have to constantly do $_GET["category"] to grab smth
        }
    }

    if (!isset($recset)) { // checks if recset isnt already set
        $recset = $dbconn->runSql($sql); // defoult catalogue query
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

include_once("template/head.inc.php");
?>
<main class="uk-container uk-margin uk-margin-xlarge-bottom uk-padding-large">
    <div uk-grid>
        <div class="uk-width-1-6">
            <form method="get" action="catalogue.php" id="categorie">
                <div class="uk-form-label">Categorieën</div>
                <div class="uk-form-controls">
                    <?php foreach ($categories as $category): ?>
                        <div>
                            <input id="checkbox_<?= $category["ID"] ?>" class="uk-checkbox" type="checkbox"
                                name="category[]" value="<?= $category["ID"] ?>"
                                onclick="document.getElementById('categorie').submit();" <?php
                                if (isset($categoryIdArr)) { // checcks if categoryIdArr is set
                                    if (in_array($category["ID"], $categoryIdArr)) { // checks if our id is in the array
                                        echo "checked"; // marks the box as checked
                                    }
                                }
                                ?>>
                            <label for="checkbox_<?= $category["ID"] ?>"><?= $category["name"] ?></label><br>
                        </div>
                    <?php endforeach; ?>
                </div>
            </form>
        </div>
        <div class="uk-width-1-6">
            <div class="uk-divider-vertical"></div>
        </div>
        <div class="uk-width-expand">
            <div class="uk-child-width-1-3" uk-grid>
                <!-- begin card example -->
                <!-- <a class="uk-card uk-card-home uk-card-default uk-card-small uk-card-hover uk-link-reset" href="product.php">
                            <div class="uk-card-media-top uk-align-center">
                                <img src="img/chair_beginner.png" style="width: 206px; height: 206px;" alt="" class="product-image uk-align-center">
                            </div>
                            <div class="uk-card-body uk-card-body-home">
                                <h3 class="uk-card-title">name</h3>
                                <p>description</p>
                            </div>
                            <div class="uk-card-footer">
                                <div class="uk-flex uk-flex-row">
                                    <div class="uk-flex-column uk-width-1-2"></div>
                                    <div class="uk-flex-column uk-width-1-1">
                                        <h4 class="price-text">&euro; 10,00</h4>
                                    </div>
                                </div>
                            </div>
                        </a>  -->
                <!-- einde card example -->
                <?php foreach ($recset as $product): ?>
                    <a class="uk-card uk-card-home uk-card-default uk-card-small uk-card-hover uk-link-reset"
                        href="product.php?product_id=<?= $product["ID"] ?>">
                        <div class="uk-card-media-top uk-align-center">
                            <img src=<?= $product['image'] ?> height="100" width="100" alt="" class="uk-align-center">
                        </div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title"><?= $product['name'] ?></h3>
                            <p><?= $DescriptionHelper->writeShortDescription($product['description']) ?></p>
                        </div>
                        <div class="uk-card-footer">
                            <div class="uk-flex uk-flex-row">
                                <div class="uk-flex-column uk-width-1-2"></div>
                                <div class="uk-flex-column uk-width-1-1">
                                    <h4 class="price-text">&euro; <?= $PriceHelper->parseFloatToPrice($product['price']) ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<?php
include_once("template/foot.inc.php");