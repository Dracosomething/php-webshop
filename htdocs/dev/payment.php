<?php
include_once("src/database/Database.class.php");
include_once("src/helpers/cart.helper.php");
include_once("src/helpers/description.helper.php");
include_once("src/helpers/login.helper.php");

try {
    $dbconn = new Database();
    // set the PDO error mode to exception
    $sql = "SELECT * FROM products";
    $recset = $dbconn->runSql($sql);

    $cartID = $_POST['cart_id'];
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

include_once("template/head.inc.php");
?>

<main class="uk-container">
<section class="uk-width-1-3  uk-margin-auto uk-margin-xlarge-top uk-margin-xlarge-bottom">
      <div class="uk-card-default uk-card-small uk-flex uk-flex uk-flex-column uk-flex-between uk-padding-small uk-flex-1">
         <div class="uk-card-header">
            <h2>Betalen</h2>
         </div>
         <div class="uk-card-body uk-flex uk-flex-column uk-flex-between">
            <div class="uk-flex uk-flex-between uk-gap">
               <img src="img/IDEAL.png" class="" alt="" title="" />
               <select name="bank">
                  <option value="0">Kies uw bank</option>
                  <option value="1">Rabobank</option>
                  <option value="2">ASN Bank</option>
                  <option value="3">ING Bank</option>
                  <option value="4">Regiobank</option>
                  <option value="5">SNS Bank</option>
                  <option value="6">ABNAMRO Bank</option>
               </select>
            </div>
         </div>
         <div class="uk-card-footer">
            <div class="uk-flex uk-flex-1 uk-flex-middle uk-flex-center uk-margin-medium-top">
                <form name="order" method="post" action="confirm.php">
                    <input type="hidden" value=<?= $cartID ?> name="cart_id">
                    <input type="submit" class="uk-button uk-button-primary" value="Betalen">
                </form>
            </div>
         </div>
      </div>
   </section>
</main>

<?php
include_once("template/foot.inc.php");